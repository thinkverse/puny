<?php

use function Puny\{test, ok, okay};

test('The `ok` function works', function () {
    ok(true, '`ok` works.');
});

test('The `okay` function works', function () {
    okay(true, '`okay` works.');
});
