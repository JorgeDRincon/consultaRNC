<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 🚀 Development Setup

This project includes automatic linting and formatting configuration. For an optimal development experience, install the following VS Code extensions:

### 📋 Required Extensions

#### JavaScript/Vue.js:

-   **ESLint** (`dbaeumer.vscode-eslint`) - Linting and auto-fix for JavaScript/Vue
-   **Vue Language Features (Volar)** (`Vue.volar`) - Complete Vue 3 support

#### PHP/Laravel:

-   **PHP Intelephense** (`bmewburn.vscode-intelephense-client`) - IntelliSense and error detection
-   **Laravel Pint** (`open-southeners.laravel-pint`) - Automatic PHP formatting
-   **Laravel Blade Snippets** (`onecentlin.laravel-blade`) - Blade template support

#### Utilities:

-   **Tailwind CSS IntelliSense** (`bradlc.vscode-tailwindcss`) - CSS class autocompletion

### ⚙️ Automatic Configuration

The project includes pre-defined configuration that:

✅ **Automatically formats** code on save (Ctrl+S)  
✅ **Detects errors** in real-time while you type  
✅ **Applies consistent** code standards  
✅ **Uses 4-space** indentation

### 🛠️ Available Scripts

#### Frontend (JavaScript/Vue):

```bash
npm run lint        # Check linting errors
npm run lint:fix    # Fix errors automatically
```

#### Backend (PHP):

```bash
composer run lint   # Format PHP code with Laravel Pint
```

### 🔧 Quick Installation

1. **Clone the repository**
2. **Install dependencies**: `composer install && npm install`
3. **Install the extensions** listed above in VS Code
4. **Restart VS Code**
5. **Start developing!** Code will be formatted automatically

### 📏 Code Standards

-   **Indentation**: 4 spaces
-   **Quotes**: Single (`'`) in JavaScript/Vue
-   **PHP**: Laravel standards (PSR-12)
-   **Vue**: Multi-word component names recommended

## 🤖 Continuous Integration

This project uses GitHub Actions to automatically enforce code quality standards on every pull request.

### 🔍 Automated Checks

**Format Check** (Fast - runs on every PR):

-   ✅ ESLint formatting for JavaScript/Vue files
-   ✅ Laravel Pint formatting for PHP files
-   ❌ **Blocks merge if formatting issues are found**

**Code Quality Check** (Comprehensive - runs on main branches):

-   ✅ Full linting and formatting verification
-   ✅ Frontend and backend tests
-   ✅ Build verification
-   ✅ Database migrations test

### 🚫 Pull Request Requirements

Your PR will be **automatically blocked** if:

-   Code is not properly formatted
-   ESLint errors are present
-   Laravel Pint formatting is needed
-   Tests are failing

### 🔧 Fixing CI Failures

If the Format Check fails:

```bash
# Fix JavaScript/Vue formatting
npm run lint:fix

# Fix PHP formatting
composer run lint

# Commit and push changes
git add .
git commit -m "fix: apply code formatting"
git push
```

The GitHub Action will automatically re-run and should pass! ✅

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
