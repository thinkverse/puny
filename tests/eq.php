<?php

use function Puny\{test, eq, ok};

test('The `eq` function works', function () {
    eq(2, 1 + 1, '`eq` works.');
});

test('The `eq` function works with array', function () {
    eq([2], [1 + 1], '`eq` works.');
});

test('The `eq` function works with callable', function () {
    eq(fn () => 2, fn () => 1 + 1, '`eq` works.');
});

test('The `eq` function works with function', function () {
    eq(ceil(1.2), 2.0, '`eq` works.');
});
