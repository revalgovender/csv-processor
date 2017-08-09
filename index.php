<?php

require "vendor/autoload.php";

use Reval\Csv as Csv;

// Declare variables.
$csvFilePath = '';

// Check if user has provided a path to a CSV file.
if (isset($argv[1]) && $argv[1]) {
    // Get CSV path.
    $csvFilePath = $argv[1];
    // Process CSV.
    $csv = new Csv();
    $result = $csv->process($csvFilePath);
    // Check for errors.
    if (isset($result['status']) && $result['status'] === 'error') {
        echo $result['message'];
    } else {
        $csv->output($result);
        echo 'We have processed the CSV file. Check your file';
    }
} else {
    echo 'You have not provided valid arguments';
}
