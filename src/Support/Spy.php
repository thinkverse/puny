<?php

namespace Puny\Support;

use Closure;

final class Spy
{
    private Closure $callback;

    public array $called = [];

    public array $thrown = [];

    public function __construct(callable $callback)
    {
        $this->callback = \Closure::fromCallable($callback);
    }

    public function __invoke(...$args)
    {
        $this->called[] = $args;

        try {
            $result = ($this->callback)(...$args);

            $this->thrown[] = null;
        } catch (\Throwable $e) {
            $this->thrown[] = $e;
        }

        return $result ?? null;
    }
}
