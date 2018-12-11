
# Support for multiple custom dashboards in Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alexbowers/nova-multiple-dashboard.svg?style=flat-square)](https://packagist.org/packages/alexbowers/nova-multiple-dashboard)
[![Quality Score](https://img.shields.io/scrutinizer/g/alexbowers/nova-multiple-dashboard.svg?style=flat-square)](https://scrutinizer-ci.com/g/alexbowers/nova-multiple-dashboard)
[![Total Downloads](https://img.shields.io/packagist/dt/alexbowers/nova-multiple-dashboard.svg?style=flat-square)](https://packagist.org/packages/alexbowers/nova-multiple-dashboard)


You can now add multiple custom dashboards in Laravel Nova.

Whether you want to group some cards together, have different dashboards visible depending on the logged in user, or want to provide a dashboard with your tool, Multiple Dashboards allows you to do this.

![Multiple Dashboard Example](https://github.com/alexbowers/nova-multiple-dashboard/blob/master/screenshots/example.gif?raw=true)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require alexbowers/nova-multiple-dashboard
```

## Usage

There is now a `php artisan nova:dashboard <name>` command exposed via the CLI.

If you run this, you'll get a `App/Nova/Dashboards` directory created, which will house your custom dashboards.

Dashboards have a `public $order` variable you can use to set the order they appear in the navbar. See the `Dashboard` class for more.

If you are another package creating a nova dashboard, you will need to register it using:

```php
\AlexBowers\MultipleDashboard\DashboardNova::registerDashboards(new \Your\Dashboard\Here);
```

You can register multiple at once by passing through to the `DashboardNova::registerDashboards` function.


### Security

If you discover any security related issues, please email bowersbros@gmail.com instead of using the issue tracker.

## Credits

- [Alex Bowers](https://github.com/alexbowers)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
