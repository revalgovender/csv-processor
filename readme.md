# CSV Processor

> This project is a simple command line utility for processing a CSV.

I created this project to demonstrate the following skills:
1. PSR4 and PS2 standard code.
2. Code well documented, ready for automatic doc generation.
3. Use of PHPUnit.
4. Basic CSV file processing.
5. PHP7.0 standard code.

## Setup

### Requirements

- PHP 7.0

### Installation

``` bash
# install dependencies
composer install
```

## Usage

``` bash
# Usage
  php index.php <filePath>

# Arguments
  filePath              The path to the file you wish to process
```
The processed CSV will be outputted as a CSV in the "storage/" directory.

## Tests

The testing framework used in this project is callled [PHPUnit](https://phpunit.de/).
You can run the tests using the following command:
``` bash

# Run all unit tests
vendor/bin/phpunit tests/
```

## PHPDocs

You can find the generated documentation in the /output folder.