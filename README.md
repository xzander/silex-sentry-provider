# Silex Sentry Provider

[![Build Status](https://travis-ci.org/bthemad/silex-sentry-provider.png?branch=master)](https://travis-ci.org/moriony/silex-sentry-provider) [![Coverage Status](https://coveralls.io/repos/bthemad/silex-sentry-provider/badge.png)](https://coveralls.io/r/bthemad/silex-sentry-provider) [![Dependency Status](https://www.versioneye.com/user/projects/54db8308c1bbbda0130002ef/badge.png)](https://www.versioneye.com/user/projects/51bf5dd3f721e5000200104f)

[Sentry client](https://github.com/getsentry/raven-php) service provider for the [Silex](http://silex.sensiolabs.org/) framwork.

**Warning:** This version is compatible with Silex 2.0 and Pimple 3.0 only! For the older version use the original [repo](https://github.com/moriony/silex-sentry-provider). 

## Install via composer

Add in your ```composer.json``` the require entry for this library.
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/xzander/silex-sentry-provider"
        }
    ],
    "require": {
        "moriony/silex-sentry-provider": "2.0.*"
    },
}
```
and run ```composer install``` (or ```update```) to download all files.

If you don't need development libraries, use ```composer install --no-dev``` or ```composer update --no-dev```

## Usage

### Service registration
```php
$app->register(new Moriony\Silex\Provider\SentryServiceProvider, array(
    'sentry.options' => array(
        'dsn' => 'http://public:secret@example.com/1',
        // ... and other sentry options
    )
));
```

Here you can find [other sentry options](https://github.com/getsentry/raven-php#configuration).

###  Exception capturing
```php
$app->error(function (\Exception $e, $code) use($app) {
    // ...
    $client = $app['sentry'];
    $client->captureException($e);
    // ...
});
```

### Error handler registration
Yoc can install error handlers and shutdown function to catch fatal errors
```php
// ...
$errorHandler = $app['sentry.error_handler'];
$errorHandler->registerExceptionHandler();
$errorHandler->registerErrorHandler();
$errorHandler->registerShutdownFunction();
// ...
```

## Resources
* [Silex error handlers docs](http://silex.sensiolabs.org/doc/usage.html#error-handlers)
* [Raven-php code and docs](https://github.com/getsentry/raven-php)
