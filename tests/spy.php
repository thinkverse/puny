<?php

use function Puny\{test, spy, ok};

test('Spy', function () {
    $spied = spy(function () {

    });

    $spied();

    ok($spied->called[0] === [], 'stores args correctly');
    ok($spied->thrown[0] === null, 'stores exceptions correctly');
});

test('Example', function () {
    $spied = spy(function ($out) {
        return $out;
    });

    ok(count($spied->called) === 0, 'not yet called');

    $result = $spied('Hello');

    ok($spied->called[0] === ['Hello'], 'args stored correctly');
    ok($result === 'Hello', 'returns result correctly');

    $exception = spy(function () {
        throw new Exception;
    });

    $exception();

    ok(count($exception->thrown) === 1, 'exceptions stored correctly');
    ok($exception->thrown[0] instanceof Exception, 'exceptions stored are objects');
});
