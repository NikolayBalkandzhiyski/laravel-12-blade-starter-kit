<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel 12 Blade Starter Kit

A simple, clean starter kit for Laravel 12 applications using Blade templates and traditional form-based authentication.

## Features

- 🔐 Complete authentication system (login, register, logout)
- 🔪 Blade templating with well-organized components
- 🎨 TailwindCSS styling with AlpineJS for interactivity
- 📱 Responsive layouts out-of-the-box
- 🏗️ Simple, clean architecture following Laravel best practices

## Installation

### Option 1: New Laravel Project

You can install this starter kit when creating a new Laravel application using the `--using` flag with the Laravel installer:

```
laravel new my-app --using=nikolaybalkandzhiyski/laravel-12-blade-starter-kit
```

### Option 2: Existing Laravel Project

To install into an existing Laravel 12 application:

1. Require the package via Composer:

```
composer require nikolaybalkandzhiyski/laravel-12-blade-starter-kit
```

2. Run the installation command:

```
php artisan blade-kit:install
```

## Post-Installation Setup

After installation, you'll need to:

1. Set up your database connection in `.env`

2. Run migrations:
```
php artisan migrate
```

3. Install and build frontend assets:
```
npm install
npm run dev
```

## Usage

### Authentication

The starter kit includes complete authentication with:
- Login (`/login`)
- Registration (`/register`)
- Logout
- Dashboard page for authenticated users (`/`)

### Components

The kit provides a set of Blade components:
- `<x-application-logo>` - Main application logo
- `<x-auth-session-status>` - Displays session status messages
- `<x-dropdown>` and `<x-dropdown-link>` - For dropdown menus
- `<x-input-error>` - Displays validation errors
- `<x-input-label>` - Form input labels
- `<x-nav-link>` - Navigation links with active state
- `<x-primary-button>` - Primary action button
- `<x-text-input>` - Text input fields

### Layouts

- `app.blade.php` - Main authenticated layout with navigation
- `guest.blade.php` - Layout for unauthenticated pages

### Customization

#### Styling

This starter kit uses TailwindCSS. You can customize the design by:

1. Modifying the Tailwind configuration in `tailwind.config.js`
2. Updating component classes in the Blade component files
3. Adding custom CSS in `resources/css/app.css`

#### Views

All views are located in `resources/views`. You can:
- Modify `layouts/app.blade.php` to change the main layout
- Update authentication views in the `auth` directory
- Customize the dashboard page in `dashboard.blade.php`

#### Routes

Routes are defined in `routes/web.php`. You can add additional routes or modify existing ones to fit your needs.

## What's Included

- **Authentication Controllers**: Login, Registration, and Logout
- **Dashboard Controller**: For the main authenticated page
- **Blade Components**: Common UI components like buttons, inputs, dropdown menus
- **Layouts**: App and Guest layouts for different contexts
- **TailwindCSS Configuration**: Ready to use with sensible defaults
- **AlpineJS Integration**: For client-side interactivity
