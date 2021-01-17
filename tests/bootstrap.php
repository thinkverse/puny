<?php

use function Puny\{ok, test};

define('PUNY_BOOTSTRAPPED_TESTING', true);

test('The `bootstrap.php` file is executed', function () {
    ok(PUNY_BOOTSTRAPPED_TESTING, '`bootstrap.php` is executed.');
});