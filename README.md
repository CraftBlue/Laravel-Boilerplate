# Craft Blue's Laravel Boilerplate

TODO: Documentation and default packaging isn't finalized.

* Bootstrap 4
* Font Awesome

<p align="center">
    <a href="https://packagist.org/packages/craftblue/laravel-boilerplate"><img src="https://poser.pugx.org/craftblue/laravel-boilerplate/v/stable" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/craftblue/laravel-boilerplate"><img src="https://poser.pugx.org/craftblue/laravel-boilerplate/v/unstable" alt="Latest Unstable Version"></a>
    <a href="https://travis-ci.org/craftblue/laravel-boilerplate"><img src="https://travis-ci.org/craftblue/laravel-boilerplate.svg?branch=master" alt="Build Status"></a>
    <a href="https://styleci.io/repos/84470262"><img src="https://styleci.io/repos/84470262/shield?branch=master" alt="StyleCI"></a>
    <a href="https://packagist.org/packages/craftblue/laravel-boilerplate"><img src="https://poser.pugx.org/craftblue/laravel-boilerplate/license" alt="License"></a>
    <a href="https://packagist.org/packages/craftblue/laravel-boilerplate"><img src="https://poser.pugx.org/craftblue/laravel-boilerplate/downloads" alt="Total Downloads"></a>
    <!--<a href="https://insight.sensiolabs.com/projects/f21891ce-4b48-4507-aa4b-a25474571473" alt="medal"><img src="https://insight.sensiolabs.com/projects/f21891ce-4b48-4507-aa4b-a25474571473/mini.png"></a>-->
</p>

We built a boilerplate Laravel 5.5 application to ensure web applications built by [Craft Blue](https://www.craftblue.com)
maintain a consistent set of standards for ourselves and our clients. It comes pre-configured with
libraries such as auth, rate limiting, Passport, and Horizon.

## Navigation

* Requirements
* Initial Setup and Configuration
* Default Config Values
* Additional Composer Packages Included
* Authentication
* User Access Control (ACL)
* Pre-Configured Passport API Server
* Rate Limiting
* Suggested Package Usage
* Suggested Additions

## Requirements ##

* Ubuntu 16.04 LTS - It's our preferred OS and all instructions below are based on Ubuntu commands.
* PHP 7.1 (for utilizing  Laravel Horizon)

## Initial Setup and Configuration ##

1. Ensure your hosting machine is up to date. For example, `apt-get update && apt-get upgrade` for Ubuntu.
1. Our configuration defaults require you to install and configure `supervisor` for monitoring your queues, `beanstalk` for handling Laravel queues, and `redis` for session management.
1. You will need to globally install `composer`, `nodejs`, and `npm`. It's recommended that you install a newer version of `nodejs` than may otherwise be a default. This prevents issues when running `npm`.
1. You will want to first copy `.env.example` to `.env` and adjust values as needed.
1. You will need to run `php artisan key:generate` to generate your own unique application key.
1. Run `composer update`.
1. Run `npm install`.
1. Follow any additional instructions provided on [Laravel 5.5 Server Requirements](https://laravel.com/docs/5.5#server-requirements).
1. Follow any additional instructions provided on [Laravel 5.5 Configuration](https://laravel.com/docs/5.5#configuration)
1. 
1. We always suggest installing `fail2ban` on your server and disabling root SSH logins.
1. We always suggest installing `monit` on your server to monitor processes such as nginx, apache, php-fpm, mysql, supervisor, fail2ban, etc.


## Default Config Values ##

* Redis has been chosen as the default cache.
* Redis has been chosen as the default session storage.
* Beanstalk has been chosen as the default queue handler.
* MySQL has been chosen as the default database. Substitute your server  MariaDB if you'd like.
* File has been chosen as the default storage disk. You may wish to swap this out for Amazon S3.

## Additional Composer Packages Included ##

We've included the following non-standard packages in our composer.json file by default.

These decisions were made to not only simplify development, but improve overall application security.

* **debugging** [varryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
* **development** [itsgoingd/clockwork](https://github.com/itsgoingd/clockwork) The server-side component of Clockword, a chrome extension for speeding up PHP development.
* **forms** [laravelcollective/html](https://github.com/LaravelCollective/html)
* **logging** [jenssegers/agent](https://github.com/jenssegers/agent) For enhanced logging of user agent strings as well as robot detection
* **logging** [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) For adding the ability to log user interactions with the admin/API for accountability, record keeping, or trace history.
* **rate limiting** [GrahamCampbell/Laravel-Throttle]() for more full featured throttling API requests
* **scalability** [webpatser/laravel-uuid](https://github.com/webpatser/laravel-uuid) For UUID generation to support a global UUID lookup table
* **security** [padosoft/laravel-composer-security](https://github.com/padosoft/laravel-composer-security) For auditing the currently installed composer packages for security vulnerabilities tracked by SensioLabs Security Checker. Reports will be sent via email based on configuration params in `.env` values `SECURITY_CHECK_SUBJECT_SUCCESS`, `SECURITY_CHECK_SUBJECT_ALARM`, `SECURITY_CHECK_MESSAGE_FROM`, `SECURITY_CHECK_MESSAGE_FROM_NAME`, `SECURITY_CHECK_MAIL_VIEW_NAME`, `SECURITY_CHECK_LOG_FILE_PATH`.
* **security** [DavidePastore/composer-audit](https://github.com/DavidePastore/composer-audit) For auditing the currently installed composer packages for security vulneratibilities tracked by SensioLabs Security Checker.
* **security** [Roave/SecurityAdvisories]() Prevents you from adding vulnerable dependencies to composer.
* **sessions** [predis/predis]() for Laravel cache support via Redis.

## Automation with Travis CI ##

https://www.fastfwd.com/continuous-integration-laravel-travis-ci/
https://gist.github.com/gilbitron/5cac0ac5fa07e9b354ac

## Authentication ##

We have already performed the necessary handling for setup of user authentication as outlined on Laravel's [Authentication](https://laravel.com/docs/5.5/authentication) page.

If you completed the section entitled *Initial Setup and Configuration*, all migrations should have already ran and you're good to go.


## Access Control (ACL)

Access control is managed by the [`spatie/laravel-permission`](https://github.com/spatie/laravel-permission) library.

Defaults roles have been added for `user`, `admin`, and `superadmin`.

Default permissions have been added for ``.


## Pre-Configured Passport API Server ##

Laravel Passport has been pre-configured to give you OAUTH2 client/server functionality.

TODO: You still need to generate your own keys.


## Organizing and Creating Routes ##

You can organize routes into individual, role based files.

You can do this by including your route file in `app/Providers/RouteServiceProvider.php`. If you add a new route file to the `routes/` directory (i.e. `routes/admin.php`), you would add the following to `RouteServiceProvider.php`:

```php
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
     	Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'))
             ->group(base_path('routes/admin.php'));
    }
```


## Suggested Package Usageg ##

Some of the packages we default to may be non-trivial to you. 

* We recommend using __ for form generation.
* We 


## Suggested Additions ##

Below, we've outlined a number of popular repositories we would suggest looking at to fulfill specific needs in your application.

Please do your own due diligence and investigate what library is best suited for your application. These are simply recommendations.

* **analytics** [spatie/laravel-analytics]() if you need to integrate Google Analytics results into an admin dashboard.
* **API clients** [artisaninweb/laravel-soap](https://github.com/artisaninweb/laravel-soap) if you need to build clients to interact with SOAP APIs.
* **authentication**: [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth) if your modern, framework based frontend needs to consume your backend API.
* **authentication**: [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors) if your application needs to support making CORs requests.
* **authentication**:[laravel/socialite]() for implementing social logins (i.e. Twitter, Facebook, Google, Github).
* **backups**: [spatie/laravel-backup]() for backing up the entirety of your Laravel application and giving you the ability to store remotely in the cloud (i.e. Amazon S3)
* **billing**: [thephpleague/omnipay]() for handling custom payments across a large number of popular payment gateways.
* **documentation**: [dingo/blueprint]() for generating and managing documentation of your app.
* **ecommerce** [Crinsane/LaravelShoppingcart]() if you need to build a custom shopping card. May still be buggy.
* **event management** [Attendize/Attendize]() a ticket selling and event management platform
* **fraud detection** [ilanco/laravel-maxmind-minfraud]() for integration with the popular MaxMind Minfraud API for detecting credit card fraud.
* **fraud detection** [pablumfication/laravel-sift-science]() for integration with Sift Science for detecting credit card fraud.
* **geocoding** [geocoder-php/GeocoderLaravel]() for interacting with a huge selection of geocoder based APIs such as Google Maps or MaxMind.
* **geocoding** [geoip2/geoip2 ~2.1]() for interacting with the MaxMind API, required by `Torann/laravel-geoip`.
* **geocoding** [Torann/laravel-geoip]() for checking a user's IP address for additional metadata or to blacklist based on country of origin.
* **geography** [webpatser/laravel-countries]() if you want access to a relatively in-depth country metadata database table and helper methods. 
* **graphing and charting** [ConsoleTVs/Charts]]() Multi-library chart package to create interactive charts from 13+ different chart libraries.
* **graphing and charting** [kevinkhill/lavacharts]() if you need to interact with Google Charts to build charts.
* **notifications (push) ** [pusher/pusher-php-server](https://github.com/pusher/pusher-http-php) if interacting with Pusher via Laravel Broadcast.
* **notifications (SMS)** [aloha/laravel-twilio]() if you need to build an SMS or VOIP solution such as SMS verification or mobile phone verification.
* **notifications (user)** [prologuephp/alerts]() if you need to build a user notification system such as global site messaging.
* **recaptcha** [anhskohbo/no-captcha](https://github.com/anhskohbo/no-captcha) if you need to implement Google's No CAPTCHA RECAPTA into web forms.
* **sitemaps** [Laravelium/laravel-sitemap]() for generating a sitemap to submit to Google Webmaster Tools.
* **validation** [inacho/php-credit-card-validator]() if you need to handle validation of credit card numbers (i.e. the luhn algorithm).
* **validation**: [laravel-ardent/ardent]() for self-validating, secure and smart models via Eloquent ORM.

Looking for something else? We suggest you check out a list of popular resources on [TimothyDJones/awesome-laravel](https://github.com/TimothyDJones/awesome-laravel).

#### Official Laravel Libraries ####

* **[Laravel Spark](https://spark.laravel.com/) - If you need to integrate with a payment API to provide subscription based billing to your SaaS application. This is a paid repository which handles all of the nitty-gritty scaffolding required for a SaaS application.
* **[Laravel Cashier](https://laravel.com/docs/5.5/billing) - If you need to integrate with a payment API but don't need the subscription services associated with Laravel Spark.
* **[Laravel Dusk](https://laravel.com/docs/5.5/dusk) - Laravel Dusk provides an expressive, easy-to-use browser automation and testing API.
* **[Laravel Echo](https://laravel.com/docs/5.5/broadcasting) - If you need to implement Websockets (push notification)s into your system. Requires [pusher/pusher-php-server](https://github.com/pusher/pusher-http-php).

#### Improving Application Security #### 

One of the most overlooked places to find security holes in a growing application are within it's open source dependencies. 
Several services exist which can track and monitor your dependencies and their current versions for known vulnerabilities.
We highly recommend and setting up 

##### Composer.json #####

* [Roave/SecurityAdvisories]() Add to your composer 

##### NPM #####

* [Node Security Platform - monitor](https://nodesecurity.io/) Subscribe and ensure that every Github pull request is audited for vulnerabilities in your current npm includes found in your `package.json` file.
* [DependencyCI](https://dependencyci.com/) If you are creating an open source project, there's no reason not to use Dependency CI for auditing dependencies for vulnerabilities.
* [Libraries.io](https://libraries.io/)

## License ##
This repository is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
