<?php

namespace Puny;

use Puny\Exceptions\NotOkException;
use Puny\Exceptions\SkippedException;
use Puny\Support\Spy;

function test(string $name, \Closure $callback) {
    Puny::register($name, $callback);
}

function ok(bool $check, string $id) {
    if (! $check) {
        throw new NotOkException($id);
    }

    return true;
}

function okay(bool $check, string $id) {
    return ok($check, $id);
}

function spy(callable $callback) {
    return new Spy($callback);
}

function skip() {
    throw new SkippedException;
}
