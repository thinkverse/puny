<p align="center">
    <img src="./docs/sneak.png" width="375">
</p>

---

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
