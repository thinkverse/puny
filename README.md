# Puny

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Writing your first test](#writing-your-first-test)
    * [Checking things are okay](#checking-things-are-okay)
    * [Skipping tests](#skipping-tests)
    * [Spying on functions](#spying-on-functions)
* [Why does Puny exist?](#why-does-puny-exist)

## Installation

To install Puny, run the following command in your project:

```bash
composer require ryangjchandler/puny --dev
```

## Usage

To run Puny, use the following command:

```bash
./vendor/bin/puny
```

This command will invoke Puny and attempt to run all of your tests. Puny assumes that your test files are found **inside of a `tests` folder in the root of your project**.

If this folder cannot be found, Puny will print an error in the terminal.

### Writing your first test

If you haven't already, create a `tests` folder in the root of your project. Go ahead and create a new PHP file too.

You can call this file whatever you want, Puny doesn't really care.

To write your first test, import the `Puny\test` function at the top of your file and invoke the function, passing in 2 arguments. The first argument should be the name of your test, the second argument should be the test handler itself (any `callable` type).

> It is a good practice with Puny to use the fully-qualified name (FQN) of the class you are testing as the name of the test.

```php
use function Puny\{test, ok};
use App\Support\StringFormatter;

test(StringFormatter::class, function () {
    $upper = StringFormatter::upper('example');

    ok($upper === 'EXAMPLE', 'correctly transforms to uppercase');
});
```

### Checking things are okay

You can use the `ok` function to check whether or not something correct (okay). The first argument to this function is a `bool`, testing the condition in question. The second argument is the specific scenario you are testing.

> Ensure the scenario is clear as it will be used to indicate failures when running your tests.

```php
ok(1 + 2 === 3, 'math is good');
```

### Skipping tests

You can skip a test by invoking the `skip` function. Under the hood, this function throws a `SkippedException` that will force the test to be marked as skipped.

```php
test('Example', function () {
    skip();
});
```

### Spying on functions

You can spy on a function / callable via the `spy` function. This helper wraps the provided `callable` and allows you to perform checks on the number of times it has been called, the arguments provided and whether any exceptions were thrown.

```php
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
```

## Why does Puny exist?
