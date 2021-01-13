<?php

namespace Puny;

use Puny\Exceptions\NotOkException;
use Puny\Exceptions\SkippedException;
use Puny\Support\Console;

final class Puny
{
    private static $instance = null;

    private string $root;

    private static array $tests = [];

    public function setRoot(string $path)
    {
        $this->root = $path;

        return $this;
    }

    public function run(string $path)
    {
        if ($path) {
            $this->setRoot($path);
        }

        if (! is_dir($this->root)) {
            Console::error("The tests directory does not exist ({$this->root}).");
            exit(1);
        }

        $files = scandir($this->root);

        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            require_once $this->root.'/'.$file;
        }

        $errors = [];

        foreach (static::$tests as $name => $callback) {
            try {
                $callback();

                Console::info("\xE2\x9C\x94 {$name}");
            } catch (\Throwable $e) {
                if ($e instanceof SkippedException) {
                    Console::warning("\xE2\x9A\xA0 {$name}");
                    continue;
                }

                if (! $e instanceof NotOkException) {
                    throw $e;
                }

                Console::error("\xF0\x90\x84\x82 {$name} > {$e->getMessage()}");
            }
        }
    }

    public static function register(string $test, \Closure $callback)
    {
        self::$tests[$test] = $callback;
    }

    public static function instance(): self
    {
        return static::$instance ??= new self;
    }
}
