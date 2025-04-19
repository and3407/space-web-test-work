<?php

namespace App\Modules\SpaceWebApi;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger as MonologLogger;

class SpaceWebLogger
{
    private const string NAME = 'spaceWebApi';
    private const string PATH = './logs/logs.log';

    /**
     * @param array<mixed> $context
     */
    public static function info(string $message, array $context = []): void
    {
        $log = new MonologLogger(self::NAME);
        $log->pushHandler(new StreamHandler(self::PATH, Level::Info));

        $log->info($message, $context);
    }

    /**
     * @param array<mixed> $context
     */
    public static function error(string $message, array $context = []): void
    {
        $log = new MonologLogger(self::NAME);
        $log->pushHandler(new StreamHandler(self::PATH, Level::Error));

        $log->error($message, $context);
    }
}