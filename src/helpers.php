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

/**
 * @param mixed $expected
 * @param mixed $actual
 *
 * @return bool
 */
function eq($expected, $actual) {
    if ($expected === $actual) {
        return true;
    }

    if (is_callable($expected)) {
        $expected = (\Closure::fromCallable($expected))();
    }

    if (is_callable($actual)) {
        $actual = (\Closure::fromCallable($actual))();
    }

    return $expected == $actual;
}

function skip() {
    throw new SkippedException;
}
