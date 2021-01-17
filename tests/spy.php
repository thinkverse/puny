<?php

use function Puny\ok;
use function Puny\spy;
use function Puny\test;

test('The `spy` function works', function () {
    spy(function () {});
});

test('The `spy` function tracks invocations', function () {
    $spy = spy(function () {});

    $spy('Testing');

    ok(count($spy->called) === 1, '`spy` tracks number of invocations.');
    ok($spy->called[0][0] === 'Testing', '`spy` tracks arguments passed when invoking.');
});

test('The `spy` function tracks exceptions', function () {
    $spy = spy(function () {
        throw new Exception;
    });

    $spy();

    ok(count($spy->thrown) === 1, '`spy` tracks exceptions thrown.');
    ok($spy->thrown[0] instanceof Exception, '`spy` stores exceptions thrown.');
});