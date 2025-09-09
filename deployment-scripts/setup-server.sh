#!/bin/bash

# Server setup script for ConsultaRNC deployment
# Run this script ONCE on the production server to prepare for deployments

set -e

# Configuration
DEPLOY_USER="consultarnc"
DEPLOY_PATH="/home/${DEPLOY_USER}/public_html"
DOMAIN="consultarnc.com.do"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

log() {
    echo -e "${BLUE}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1"
}

error() {
    echo -e "${RED}[ERROR]${NC} $1" >&2
}

success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

# Check if running as correct user
check_user() {
    if [ "$(whoami)" != "${DEPLOY_USER}" ]; then
        error "This script must be run as user: ${DEPLOY_USER}"
        error "Current user: $(whoami)"
        exit 1
    fi
    success "Running as correct user: ${DEPLOY_USER}"
}

# Create directory structure
create_directories() {
    log "Creating directory structure..."
    
    mkdir -p "${DEPLOY_PATH}/releases"
    mkdir -p "${DEPLOY_PATH}/shared/storage/app/public"
    mkdir -p "${DEPLOY_PATH}/shared/storage/framework/cache"
    mkdir -p "${DEPLOY_PATH}/shared/storage/framework/sessions"
    mkdir -p "${DEPLOY_PATH}/shared/storage/framework/views"
    mkdir -p "${DEPLOY_PATH}/shared/storage/logs"
    mkdir -p "${DEPLOY_PATH}/shared/uploads"
    mkdir -p "${DEPLOY_PATH}/scripts"
    
    success "Directory structure created"
}

# Set proper permissions
set_permissions() {
    log "Setting permissions..."
    
    chmod 755 "${DEPLOY_PATH}"
    chmod 755 "${DEPLOY_PATH}/releases"
    chmod 755 "${DEPLOY_PATH}/shared"
    chmod -R 775 "${DEPLOY_PATH}/shared/storage"
    chmod -R 775 "${DEPLOY_PATH}/shared/uploads"
    chmod 755 "${DEPLOY_PATH}/scripts"
    
    success "Permissions set correctly"
}

# Setup SSH keys
setup_ssh() {
    log "Setting up SSH configuration..."
    
    mkdir -p ~/.ssh
    chmod 700 ~/.ssh
    
    if [ ! -f ~/.ssh/authorized_keys ]; then
        touch ~/.ssh/authorized_keys
    fi
    chmod 600 ~/.ssh/authorized_keys
    
    success "SSH configuration ready"
    warning "Remember to add your GitHub Actions public key to ~/.ssh/authorized_keys"
}

# Create environment file template
create_env_template() {
    log "Creating environment file template..."
    
    if [ ! -f "${DEPLOY_PATH}/shared/.env" ]; then
        # Copy from project root if available, otherwise create comprehensive template
        if [ -f "env.production.example" ]; then
            cp env.production.example "${DEPLOY_PATH}/shared/.env"
            success "Copied comprehensive .env template from env.production.example"
        else
            cat > "${DEPLOY_PATH}/shared/.env" << 'EOF'
# Production Environment Configuration
# Copy this file to .env in your production server and configure the values

# Application
APP_NAME="ConsultaRNC"
APP_ENV=production
APP_KEY=base64:GENERATE_THIS_KEY_WITH_ARTISAN
APP_DEBUG=false
APP_TIMEZONE=America/Santo_Domingo
APP_URL=https://consultarnc.com.do

# Logging
LOG_CHANNEL=daily
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error
LOG_DAILY_DAYS=14

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=consultarnc_production
DB_USERNAME=consultarnc_user
DB_PASSWORD=YOUR_STRONG_DATABASE_PASSWORD_HERE

# Session & Cache
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.consultarnc.com.do

CACHE_STORE=file
CACHE_PREFIX=consultarnc

# Queue
QUEUE_CONNECTION=database

# Mail Configuration (for notifications, password resets, etc.)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@consultarnc.com.do
MAIL_FROM_NAME="${APP_NAME}"

# File Storage
FILESYSTEM_DISK=local

# Security
BCRYPT_ROUNDS=12

# Sanctum (API Authentication)
SANCTUM_STATEFUL_DOMAINS=consultarnc.com.do,www.consultarnc.com.do

# Vite (Asset Building)
VITE_APP_NAME="${APP_NAME}"

# RNC Data Configuration
RNC_DATA_URL="https://dgii.gov.do/app/media/contribuyentes/rnc.zip"
RNC_IMPORT_BATCH_SIZE=1000
RNC_IMPORT_TIMEOUT=300

# Performance Optimization
OPTIMIZE_CONFIG=true
OPTIMIZE_ROUTES=true
OPTIMIZE_VIEWS=true

# Monitoring & Health Checks
HEALTH_CHECK_ENABLED=true
HEALTH_CHECK_SECRET=your-health-check-secret-here

# Rate Limiting
RATE_LIMIT_API=60
RATE_LIMIT_WEB=1000

# CORS Configuration
CORS_ALLOWED_ORIGINS=https://consultarnc.com.do,https://www.consultarnc.com.do
CORS_ALLOWED_METHODS="GET,POST,PUT,DELETE,OPTIONS"
CORS_ALLOWED_HEADERS="Content-Type,Authorization,X-Requested-With"

# Contact Information
CONTACT_EMAIL=info@consultarnc.com.do
CONTACT_PHONE=+1-809-XXX-XXXX
CONTACT_ADDRESS="Santo Domingo, República Dominicana"

# Maintenance Mode
MAINTENANCE_SECRET=your-maintenance-secret-here
EOF
            success "Created comprehensive .env template"
        fi
        
        chmod 600 "${DEPLOY_PATH}/shared/.env"
        success "Environment template created at ${DEPLOY_PATH}/shared/.env"
        warning "IMPORTANT: Configure the .env file with your production values!"
    else
        success "Environment file already exists"
    fi
}

# Install deployment scripts
install_scripts() {
    log "Installing deployment scripts..."
    
    # Copy scripts if they exist in current directory
    for script in deploy.sh health-check.sh rollback.sh; do
        if [ -f "deployment-scripts/${script}" ]; then
            cp "deployment-scripts/${script}" "${DEPLOY_PATH}/scripts/"
            chmod +x "${DEPLOY_PATH}/scripts/${script}"
            success "Installed ${script}"
        else
            warning "Script not found: deployment-scripts/${script}"
        fi
    done
}

# Create health check endpoint (optional)
create_health_endpoint() {
    log "Creating health check configuration..."
    
    cat > "${DEPLOY_PATH}/shared/health-check.php" << 'EOF'
<?php
// Simple health check endpoint
// Add this to your Laravel routes or use as standalone

header('Content-Type: application/json');

$checks = [
    'status' => 'ok',
    'timestamp' => date('c'),
    'version' => '1.0.0',
    'environment' => 'production'
];

// Add more checks as needed
$checks['database'] = 'ok'; // Implement DB check
$checks['storage'] = is_writable(__DIR__ . '/storage') ? 'ok' : 'error';

http_response_code(200);
echo json_encode($checks, JSON_PRETTY_PRINT);
EOF

    success "Health check endpoint created"
}

# Verify PHP and required extensions
check_php() {
    log "Checking PHP configuration..."
    
    if ! command -v php &> /dev/null; then
        error "PHP is not installed or not in PATH"
        exit 1
    fi
    
    local php_version=$(php -r "echo PHP_VERSION;")
    log "PHP Version: ${php_version}"
    
    # Check required extensions
    local required_extensions=("mbstring" "xml" "ctype" "json" "pdo" "mysql")
    for ext in "${required_extensions[@]}"; do
        if php -m | grep -q "^${ext}$"; then
            success "PHP extension '${ext}' is installed"
        else
            error "Required PHP extension '${ext}' is missing"
        fi
    done
}

# Check web server configuration
check_webserver() {
    log "Checking web server configuration..."
    
    if [ -d "/etc/nginx" ]; then
        success "Nginx detected"
        warning "Make sure your Nginx configuration points to: ${DEPLOY_PATH}/consultaRNC/public"
    elif [ -d "/etc/apache2" ] || [ -d "/etc/httpd" ]; then
        success "Apache detected"
        warning "Make sure your Apache configuration points to: ${DEPLOY_PATH}/consultaRNC/public"
    else
        warning "Web server not detected or not standard installation"
    fi
}

# Create backup script
create_backup_script() {
    log "Creating backup script..."
    
    cat > "${DEPLOY_PATH}/scripts/backup.sh" << 'EOF'
#!/bin/bash
# Database backup script

BACKUP_DIR="/home/consultarnc/backups"
DATE=$(date +%Y%m%d_%H%M%S)

mkdir -p "${BACKUP_DIR}"

# Backup database
mysqldump -u consultarnc_user -p consultarnc_production > "${BACKUP_DIR}/db_${DATE}.sql"

# Backup uploads
tar -czf "${BACKUP_DIR}/uploads_${DATE}.tar.gz" -C /home/consultarnc/public_html/shared uploads/

# Keep only last 7 days of backups
find "${BACKUP_DIR}" -name "*.sql" -mtime +7 -delete
find "${BACKUP_DIR}" -name "*.tar.gz" -mtime +7 -delete

echo "Backup completed: ${DATE}"
EOF

    chmod +x "${DEPLOY_PATH}/scripts/backup.sh"
    success "Backup script created"
}

# Main setup function
main() {
    log "Starting server setup for ConsultaRNC deployment..."
    log "Deploy user: ${DEPLOY_USER}"
    log "Deploy path: ${DEPLOY_PATH}"
    log "Domain: ${DOMAIN}"
    
    check_user
    create_directories
    set_permissions
    setup_ssh
    create_env_template
    install_scripts
    create_health_endpoint
    check_php
    check_webserver
    create_backup_script
    
    success "Server setup completed successfully!"
    echo ""
    echo "🔧 CRITICAL NEXT STEPS:"
    echo "1. 📝 Configure ${DEPLOY_PATH}/shared/.env with your REAL production values:"
    echo "   - APP_KEY: Generate with 'php artisan key:generate --show'"
    echo "   - DB_DATABASE: Your actual database name"
    echo "   - DB_USERNAME: Your actual database user"
    echo "   - DB_PASSWORD: Your actual database password"
    echo "   - MAIL_USERNAME: Your actual email"
    echo "   - MAIL_PASSWORD: Your actual email password"
    echo ""
    echo "2. 🔑 Add your GitHub Actions SSH public key to ~/.ssh/authorized_keys"
    echo "3. 🌐 Configure your web server to point to ${DEPLOY_PATH}/consultaRNC/public"
    echo "4. 🔐 Set up your GitHub repository secrets:"
    echo "   - SSH_PRIVATE_KEY: Your SSH private key"
    echo "   - SSH_HOST: consultarnc.com.do"
    echo "   - SSH_USER: consultarnc"
    echo "5. 🧪 Test the deployment process"
    echo ""
    echo "📋 Useful commands:"
    echo "- Edit config: nano ${DEPLOY_PATH}/shared/.env"
    echo "- Health check: ${DEPLOY_PATH}/scripts/health-check.sh"
    echo "- Manual deployment: ${DEPLOY_PATH}/scripts/deploy.sh"
    echo "- Rollback: ${DEPLOY_PATH}/scripts/rollback.sh"
    echo "- Backup: ${DEPLOY_PATH}/scripts/backup.sh"
    echo ""
    echo "⚠️  Remember: The .env file contains sensitive information!"
    echo "   Make sure it has proper permissions (600) and is not publicly accessible."
}

# Execute main function
main "$@"
