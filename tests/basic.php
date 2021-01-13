<?php

use function Puny\{test, ok, skip};

test('Basic arithmetic', function () {
    ok(1 + 2 === 3, '1 + 2 === 3');
});

test('Skipping', function () {
    skip();
});
