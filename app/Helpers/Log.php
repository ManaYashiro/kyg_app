<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log as Logger;

class Log
{
    public static function info(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('info', $subject, $details, $pretty);
    }

    public static function error(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('error', $subject, $details, $pretty);
    }

    public static function warning(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('warning', $subject, $details, $pretty);
    }

    public static function emergency(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('emergency', $subject, $details, $pretty);
    }

    public static function alert(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('alert', $subject, $details, $pretty);
    }

    public static function critical(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('critical', $subject, $details, $pretty);
    }

    public static function notice(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('notice', $subject, $details, $pretty);
    }

    public static function debug(string $subject, mixed $details = null, bool $pretty = false): void
    {
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details, JSON_PRETTY_PRINT);
        }

        self::prettyLog('debug', $subject, $details, $pretty);
    }

    private static function prettyLog(string $level, string $subject, mixed $details = '', bool $pretty = false): void
    {
        if ($pretty) {
            Logger::info('******************** START: ' . $subject . ' *********************');
        } else {
            Logger::$level($subject . "：");
        }
        if ($details) {
            Logger::$level($details);
        }
        if ($pretty) {
            Logger::info('********************  END: ' . $subject . '  *********************');
        }
        Logger::info(PHP_EOL);
    }
}
