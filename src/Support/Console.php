<?php

namespace Puny\Support;

final class Console
{
    const FOREGROUND = [
        'green' => '32'
    ];

    public static function write(string $output)
    {
        static::reset();
        echo $output.PHP_EOL;
    }

    public static function info(string $output)
    {
        echo "\e[0;32m{$output}".PHP_EOL;
        static::reset();
    }

    public static function warning(string $output)
    {
        echo "\e[0;33m{$output}".PHP_EOL;
        static::reset();
    }

    public static function error(string $output)
    {
        echo "\e[0;31m{$output}".PHP_EOL;
        static::reset();
        exit(1);
    }

    public static function reset()
    {
        echo "\e[0m";
    }
}
