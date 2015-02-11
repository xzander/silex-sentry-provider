<?php
namespace Moriony\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class SentryServiceProvider implements ServiceProviderInterface
{
    const SENTRY = 'sentry';
    const SENTRY_OPTIONS = 'sentry.options';
    const SENTRY_ERROR_HANDLER = 'sentry.error_handler';

    const OPT_DSN = 'dsn';
    const OPT_SEND_ERRORS_LAST = 'send_errors_last';

    protected static $defaultOptions = array(
        self::OPT_DSN => null,
        self::OPT_SEND_ERRORS_LAST => false,
    );

    /**
     * @param Container $container An Container instance
     */
    public function register(Container $container)
    {
        $defaultOptions = self::$defaultOptions;

        $container[self::SENTRY] = function () use ($container, $defaultOptions) {
            $options = array_merge($defaultOptions, $container[SentryServiceProvider::SENTRY_OPTIONS]);
            return new \Raven_Client($options[SentryServiceProvider::OPT_DSN], $options);
        };

        $container[self::SENTRY_ERROR_HANDLER] = function() use ($container, $defaultOptions) {
            $options = array_merge($defaultOptions, $container[SentryServiceProvider::SENTRY_OPTIONS]);
            return new \Raven_ErrorHandler($container[SentryServiceProvider::SENTRY],
                                           $options[SentryServiceProvider::OPT_SEND_ERRORS_LAST]);
        };
    }
}
