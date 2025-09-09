#!/bin/bash

# Deploy script for Laravel + Vue application
# This script implements zero-downtime deployment using symlinks

set -e  # Exit on any error

# Configuration
APP_NAME="consultaRNC"
DEPLOY_USER="consultarnc"
DEPLOY_PATH="/home/${DEPLOY_USER}/public_html"
SHARED_PATH="${DEPLOY_PATH}/shared"
RELEASES_PATH="${DEPLOY_PATH}/releases"
CURRENT_PATH="${DEPLOY_PATH}/${APP_NAME}"
KEEP_RELEASES=3

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Logging function
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

# Create release directory
RELEASE_NAME=$(date +%Y.%m.%d-%H.%M.%S) # Esto esta bien?
RELEASE_PATH="${RELEASES_PATH}/${RELEASE_NAME}"

log "Starting deployment of release: ${RELEASE_NAME}"

# Create necessary directories
log "Creating directory structure..."
mkdir -p "${RELEASES_PATH}"
mkdir -p "${SHARED_PATH}/storage/app/public"
mkdir -p "${SHARED_PATH}/storage/framework/cache"
mkdir -p "${SHARED_PATH}/storage/framework/sessions"
mkdir -p "${SHARED_PATH}/storage/framework/views"
mkdir -p "${SHARED_PATH}/storage/logs"
mkdir -p "${SHARED_PATH}/uploads"
mkdir -p "${RELEASE_PATH}"

# Extract deployment package
log "Extracting deployment package..."
if [ ! -f "/tmp/deployment.tar.gz" ]; then
    error "Deployment package not found at /tmp/deployment.tar.gz"
    exit 1
fi

tar -xzf /tmp/deployment.tar.gz -C "${RELEASE_PATH}"

# Set up shared directories and files
log "Setting up shared resources..."

# Link shared storage
if [ -d "${RELEASE_PATH}/storage" ]; then
    rm -rf "${RELEASE_PATH}/storage"
fi
ln -sf "${SHARED_PATH}/storage" "${RELEASE_PATH}/storage"

# Link uploads directory
if [ -d "${RELEASE_PATH}/public/uploads" ]; then
    rm -rf "${RELEASE_PATH}/public/uploads"
fi
ln -sf "${SHARED_PATH}/uploads" "${RELEASE_PATH}/public/uploads"

# Copy or link .env file
if [ -f "${SHARED_PATH}/.env" ]; then
    ln -sf "${SHARED_PATH}/.env" "${RELEASE_PATH}/.env"
    log "Linked production .env file"
else
    warning ".env file not found in shared directory"
    if [ -f "${RELEASE_PATH}/.env.example" ]; then
        cp "${RELEASE_PATH}/.env.example" "${SHARED_PATH}/.env"
        ln -sf "${SHARED_PATH}/.env" "${RELEASE_PATH}/.env"
        warning "Created .env from example - PLEASE CONFIGURE IT MANUALLY"
    fi
fi

# Set proper permissions
log "Setting permissions..."
find "${RELEASE_PATH}" -type f -exec chmod 644 {} \;
find "${RELEASE_PATH}" -type d -exec chmod 755 {} \;
chmod -R 775 "${SHARED_PATH}/storage"
chmod -R 775 "${SHARED_PATH}/uploads"

# Make artisan executable
if [ -f "${RELEASE_PATH}/artisan" ]; then
    chmod +x "${RELEASE_PATH}/artisan"
fi

# Laravel optimization commands
log "Running Laravel optimizations..."
cd "${RELEASE_PATH}"

# Clear and cache configurations
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Run database migrations
log "Running database migrations..."
php artisan migrate --force

# Clear and rebuild cache
php artisan cache:clear
php artisan optimize

# Create storage link if it doesn't exist
php artisan storage:link || true

# Test the new release
log "Testing new release..."
if ! php artisan --version > /dev/null 2>&1; then
    error "Laravel application test failed"
    exit 1
fi

# Backup current symlink if it exists
BACKUP_PATH=""
if [ -L "${CURRENT_PATH}" ] && [ -e "${CURRENT_PATH}" ]; then
    BACKUP_PATH=$(readlink "${CURRENT_PATH}")
    log "Current release backed up: ${BACKUP_PATH}"
fi

# Atomic switch - this is the zero-downtime moment
log "Performing atomic switch..."
ln -sfn "${RELEASE_PATH}" "${CURRENT_PATH}"

success "Atomic switch completed successfully!"

# Restart PHP-FPM gracefully
log "Restarting PHP-FPM..."
if pgrep -u "${DEPLOY_USER}" php-fpm > /dev/null; then
    pkill -USR2 -u "${DEPLOY_USER}" php-fpm || true
    sleep 2
fi

# Restart queue workers
log "Restarting queue workers..."
php artisan queue:restart || true

# Clean up old releases
log "Cleaning up old releases..."
cd "${RELEASES_PATH}"
if [ "$(ls -1 | wc -l)" -gt "${KEEP_RELEASES}" ]; then
    ls -1t | tail -n +$((KEEP_RELEASES + 1)) | xargs rm -rf
    log "Cleaned up old releases, keeping latest ${KEEP_RELEASES}"
fi

# Final verification
log "Running final verification..."
if [ -f "/tmp/health-check.sh" ]; then
    chmod +x /tmp/health-check.sh
    if /tmp/health-check.sh; then
        success "Deployment completed successfully!"
        success "Release: ${RELEASE_NAME}"
        success "Path: ${RELEASE_PATH}"
    else
        error "Health check failed after deployment"
        if [ -n "${BACKUP_PATH}" ] && [ -d "${BACKUP_PATH}" ]; then
            warning "Rolling back to previous release..."
            ln -sfn "${BACKUP_PATH}" "${CURRENT_PATH}"
            error "Rolled back to: ${BACKUP_PATH}"
        fi
        exit 1
    fi
else
    success "Deployment completed (no health check available)"
fi

log "Deployment process finished"
