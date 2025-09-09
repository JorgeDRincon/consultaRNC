#!/bin/bash

# Rollback script for Laravel application
# Quickly rollback to the previous release in case of deployment issues

set -e

# Configuration
APP_NAME="consultaRNC"
DEPLOY_USER="consultarnc"
DEPLOY_PATH="/home/${DEPLOY_USER}/public_html"
RELEASES_PATH="${DEPLOY_PATH}/releases"
CURRENT_PATH="${DEPLOY_PATH}/${APP_NAME}"

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

# Show usage information
show_usage() {
    echo "Usage: $0 [OPTIONS]"
    echo ""
    echo "Options:"
    echo "  -t, --target RELEASE    Rollback to specific release (e.g., 20241201-120000)"
    echo "  -p, --previous          Rollback to previous release (default)"
    echo "  -l, --list              List available releases"
    echo "  -f, --force             Force rollback without confirmation"
    echo "  -h, --help              Show this help message"
    echo ""
    echo "Examples:"
    echo "  $0                      # Rollback to previous release with confirmation"
    echo "  $0 --previous --force   # Rollback to previous release without confirmation"
    echo "  $0 --target 20241201-120000  # Rollback to specific release"
    echo "  $0 --list              # Show available releases"
}

# List available releases
list_releases() {
    log "Available releases:"
    
    if [ ! -d "${RELEASES_PATH}" ]; then
        error "Releases directory not found: ${RELEASES_PATH}"
        return 1
    fi
    
    local current_release=""
    if [ -L "${CURRENT_PATH}" ] && [ -e "${CURRENT_PATH}" ]; then
        current_release=$(basename "$(readlink "${CURRENT_PATH}")")
    fi
    
    local count=0
    for release in $(ls -1t "${RELEASES_PATH}" 2>/dev/null || true); do
        count=$((count + 1))
        local status=""
        local marker=""
        
        if [ "${release}" = "${current_release}" ]; then
            status=" (current)"
            marker="→ "
        elif [ ${count} -eq 2 ] && [ -n "${current_release}" ]; then
            status=" (previous)"
            marker="  "
        else
            marker="  "
        fi
        
        echo -e "${marker}${release}${status}"
    done
    
    if [ ${count} -eq 0 ]; then
        warning "No releases found"
        return 1
    fi
    
    return 0
}

# Get previous release
get_previous_release() {
    if [ ! -d "${RELEASES_PATH}" ]; then
        error "Releases directory not found: ${RELEASES_PATH}"
        return 1
    fi
    
    local current_release=""
    if [ -L "${CURRENT_PATH}" ] && [ -e "${CURRENT_PATH}" ]; then
        current_release=$(basename "$(readlink "${CURRENT_PATH}")")
    fi
    
    local releases=($(ls -1t "${RELEASES_PATH}" 2>/dev/null || true))
    
    if [ ${#releases[@]} -lt 2 ]; then
        error "Not enough releases available for rollback"
        return 1
    fi
    
    # Find the previous release (skip current if it matches)
    for release in "${releases[@]}"; do
        if [ "${release}" != "${current_release}" ]; then
            echo "${release}"
            return 0
        fi
    done
    
    error "No previous release found"
    return 1
}

# Validate release exists
validate_release() {
    local release="$1"
    
    if [ -z "${release}" ]; then
        error "Release name cannot be empty"
        return 1
    fi
    
    local release_path="${RELEASES_PATH}/${release}"
    
    if [ ! -d "${release_path}" ]; then
        error "Release not found: ${release}"
        return 1
    fi
    
    if [ ! -f "${release_path}/artisan" ]; then
        error "Invalid Laravel release (no artisan): ${release}"
        return 1
    fi
    
    return 0
}

# Perform rollback
perform_rollback() {
    local target_release="$1"
    local force="$2"
    
    log "Preparing rollback to: ${target_release}"
    
    # Validate target release
    if ! validate_release "${target_release}"; then
        return 1
    fi
    
    local release_path="${RELEASES_PATH}/${target_release}"
    local current_release=""
    
    if [ -L "${CURRENT_PATH}" ] && [ -e "${CURRENT_PATH}" ]; then
        current_release=$(basename "$(readlink "${CURRENT_PATH}")")
    fi
    
    # Check if already on target release
    if [ "${current_release}" = "${target_release}" ]; then
        warning "Already on release: ${target_release}"
        return 0
    fi
    
    # Confirmation prompt (unless forced)
    if [ "${force}" != "true" ]; then
        echo ""
        warning "This will rollback the application to: ${target_release}"
        if [ -n "${current_release}" ]; then
            warning "Current release: ${current_release}"
        fi
        echo ""
        read -p "Are you sure you want to continue? (y/N): " -n 1 -r
        echo ""
        if [[ ! $REPLY =~ ^[Yy]$ ]]; then
            log "Rollback cancelled by user"
            return 0
        fi
    fi
    
    log "Starting rollback process..."
    
    # Test the target release
    log "Testing target release..."
    cd "${release_path}"
    
    if ! php artisan --version > /dev/null 2>&1; then
        error "Target release failed basic test"
        return 1
    fi
    
    # Perform atomic switch
    log "Performing atomic rollback..."
    ln -sfn "${release_path}" "${CURRENT_PATH}"
    
    success "Atomic rollback completed!"
    
    # Clear caches
    log "Clearing application caches..."
    cd "${CURRENT_PATH}"
    php artisan config:clear || true
    php artisan route:clear || true
    php artisan view:clear || true
    php artisan cache:clear || true
    
    # Restart PHP-FPM gracefully
    log "Restarting PHP-FPM..."
    if pgrep -u "${DEPLOY_USER}" php-fpm > /dev/null; then
        pkill -USR2 -u "${DEPLOY_USER}" php-fpm || true
        sleep 2
    fi
    
    # Restart queue workers
    log "Restarting queue workers..."
    php artisan queue:restart || true
    
    # Run health check if available
    log "Running health check..."
    if [ -f "/tmp/health-check.sh" ]; then
        chmod +x /tmp/health-check.sh
        if /tmp/health-check.sh; then
            success "Health check passed after rollback"
        else
            warning "Health check failed after rollback - manual intervention may be required"
        fi
    else
        warning "Health check script not available"
    fi
    
    success "Rollback completed successfully!"
    success "Current release: ${target_release}"
    success "Path: ${release_path}"
    
    return 0
}

# Main function
main() {
    local target_release=""
    local force="false"
    local list_only="false"
    local use_previous="true"
    
    # Parse command line arguments
    while [[ $# -gt 0 ]]; do
        case $1 in
            -t|--target)
                target_release="$2"
                use_previous="false"
                shift 2
                ;;
            -p|--previous)
                use_previous="true"
                shift
                ;;
            -l|--list)
                list_only="true"
                shift
                ;;
            -f|--force)
                force="true"
                shift
                ;;
            -h|--help)
                show_usage
                exit 0
                ;;
            *)
                error "Unknown option: $1"
                show_usage
                exit 1
                ;;
        esac
    done
    
    # Handle list option
    if [ "${list_only}" = "true" ]; then
        list_releases
        return $?
    fi
    
    # Determine target release
    if [ "${use_previous}" = "true" ] && [ -z "${target_release}" ]; then
        log "Finding previous release..."
        target_release=$(get_previous_release)
        if [ $? -ne 0 ]; then
            error "Could not determine previous release"
            log "Available releases:"
            list_releases
            return 1
        fi
    fi
    
    if [ -z "${target_release}" ]; then
        error "No target release specified"
        show_usage
        return 1
    fi
    
    # Perform rollback
    perform_rollback "${target_release}" "${force}"
    return $?
}

# Execute main function with all arguments
main "$@"
