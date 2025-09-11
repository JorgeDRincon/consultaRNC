#!/bin/bash

# Health check script for Laravel application
# Verifies that the deployment was successful and the application is working

set -e

# Configuration
APP_NAME="consultaRNC"
DEPLOY_USER="consultarnc"
DEPLOY_PATH="/home/${DEPLOY_USER}/public_html"
CURRENT_PATH="${DEPLOY_PATH}/${APP_NAME}"
DOMAIN="consultarnc.com.do"
TIMEOUT=30

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Logging functions
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

# Health check functions
check_file_structure() {
    log "Checking file structure..."
    
    # Debug information
    log "Checking path: ${CURRENT_PATH}"
    log "Directory listing:"
    ls -la "$(dirname ${CURRENT_PATH})" || true
    
    if [ ! -L "${CURRENT_PATH}" ]; then
        error "Application symlink does not exist: ${CURRENT_PATH}"
        error "Directory contents:"
        ls -la "$(dirname ${CURRENT_PATH})" || true
        return 1
    fi
    
    if [ ! -e "${CURRENT_PATH}" ]; then
        error "Application symlink is broken: ${CURRENT_PATH}"
        return 1
    fi
    
    local real_path=$(readlink "${CURRENT_PATH}")
    if [ ! -d "${real_path}" ]; then
        error "Application directory does not exist: ${real_path}"
        return 1
    fi
    
    success "File structure is correct"
    return 0
}

check_laravel_installation() {
    log "Checking Laravel installation..."
    
    cd "${CURRENT_PATH}"
    
    # Check if artisan exists and is executable
    if [ ! -f "artisan" ] || [ ! -x "artisan" ]; then
        error "Artisan command not found or not executable"
        return 1
    fi
    
    # Check Laravel version
    if ! php artisan --version > /dev/null 2>&1; then
        error "Laravel artisan command failed"
        return 1
    fi
    
    local version=$(php artisan --version 2>/dev/null)
    success "Laravel installation OK: ${version}"
    return 0
}

check_environment_config() {
    log "Checking environment configuration..."
    
    cd "${CURRENT_PATH}"
    
    # Check .env file
    if [ ! -f ".env" ]; then
        error ".env file not found"
        return 1
    fi
    
    # Check if app key is set
    if ! grep -q "APP_KEY=base64:" .env; then
        error "APP_KEY not properly set in .env"
        return 1
    fi
    
    # Test config loading
    if ! php artisan config:show app.name > /dev/null 2>&1; then
        error "Configuration loading failed"
        return 1
    fi
    
    success "Environment configuration OK"
    return 0
}

check_database_connection() {
    log "Checking database connection..."
    
    cd "${CURRENT_PATH}"
    
    # Test database connection
    if ! timeout ${TIMEOUT} php artisan migrate:status > /dev/null 2>&1; then
        error "Database connection or migration check failed"
        return 1
    fi
    
    success "Database connection OK"
    return 0
}

check_storage_permissions() {
    log "Checking storage permissions..."
    
    cd "${CURRENT_PATH}"
    
    # Check if storage is writable
    local storage_path=$(readlink -f storage 2>/dev/null || echo "storage")
    
    if [ ! -d "${storage_path}" ]; then
        error "Storage directory not found: ${storage_path}"
        return 1
    fi
    
    if [ ! -w "${storage_path}" ]; then
        error "Storage directory is not writable: ${storage_path}"
        return 1
    fi
    
    # Test writing to storage
    local test_file="${storage_path}/health-check-test"
    if ! echo "test" > "${test_file}" 2>/dev/null; then
        error "Cannot write to storage directory"
        return 1
    fi
    rm -f "${test_file}"
    
    success "Storage permissions OK"
    return 0
}

check_web_response() {
    log "Checking web response..."
    
    # Check if the site responds
    local http_code
    local https_url="https://${DOMAIN}"
    local http_url="http://${DOMAIN}"
    
    # Try HTTPS first
    http_code=$(curl -s -o /dev/null -w "%{http_code}" --connect-timeout ${TIMEOUT} "${https_url}" 2>/dev/null || echo "000")
    
    if [ "${http_code}" = "200" ]; then
        success "HTTPS response OK (${http_code}): ${https_url}"
        return 0
    fi
    
    # Fallback to HTTP
    http_code=$(curl -s -o /dev/null -w "%{http_code}" --connect-timeout ${TIMEOUT} "${http_url}" 2>/dev/null || echo "000")
    
    if [ "${http_code}" = "200" ]; then
        success "HTTP response OK (${http_code}): ${http_url}"
        return 0
    fi
    
    error "Web response failed. HTTP code: ${http_code}"
    return 1
}

check_assets() {
    log "Checking static assets..."
    
    cd "${CURRENT_PATH}"
    
    # Check if build directory exists
    if [ ! -d "public/build" ]; then
        warning "Build directory not found: public/build"
        return 1
    fi
    
    # Check if manifest file exists
    if [ ! -f "public/build/manifest.json" ]; then
        warning "Vite manifest not found: public/build/manifest.json"
        return 1
    fi
    
    success "Assets check OK"
    return 0
}

check_php_processes() {
    log "Checking PHP processes..."
    
    local php_processes=$(pgrep -u "${DEPLOY_USER}" php-fpm | wc -l)
    
    if [ "${php_processes}" -eq 0 ]; then
        warning "No PHP-FPM processes found for user ${DEPLOY_USER}"
        return 1
    fi
    
    success "PHP processes OK (${php_processes} processes)"
    return 0
}

# Main health check execution
main() {
    log "Starting health check for ${APP_NAME}..."
    log "Domain: ${DOMAIN}"
    log "Path: ${CURRENT_PATH}"
    
    local failed_checks=0
    local total_checks=8
    
    # Run all health checks
    check_file_structure || ((failed_checks++))
    check_laravel_installation || ((failed_checks++))
    check_environment_config || ((failed_checks++))
    check_database_connection || ((failed_checks++))
    check_storage_permissions || ((failed_checks++))
    check_web_response || ((failed_checks++))
    check_assets || ((failed_checks++))
    check_php_processes || ((failed_checks++))
    
    # Summary
    local passed_checks=$((total_checks - failed_checks))
    
    log "Health check completed"
    log "Passed: ${passed_checks}/${total_checks}"
    
    if [ "${failed_checks}" -eq 0 ]; then
        success "All health checks passed! 🎉"
        success "Application is healthy and ready to serve traffic"
        return 0
    elif [ "${failed_checks}" -le 2 ]; then
        warning "Health check completed with ${failed_checks} warnings"
        warning "Application may still be functional"
        return 0
    else
        error "Health check failed with ${failed_checks} critical issues"
        error "Application may not be functioning properly"
        return 1
    fi
}

# Execute main function
main "$@"
