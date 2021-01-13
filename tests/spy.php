<?php

use function Puny\{test, spy, ok};

test('Spy', function () {
    $spied = spy(function () {

    });

    $spied();

    ok($spied->called[0] === [], 'stores args correctly');
    ok($spied->thrown[0] === null, 'stores exceptions correctly');
});
