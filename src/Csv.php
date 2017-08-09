<?php
/**
 * Created by PhpStorm.
 * User: revalGovender
 * Date: 10/05/2017
 * Time: 21:22
 */

namespace Reval;

/**
 * Class Csv
 * @package Reval
 */

class Csv
{
    /**
     * @var array A list of all the numbers from each row's third column, doubled
     */
    protected $numbers = [];

    /*
    |--------------------------------------------------------------------------
    | Logic
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Process the CSV
     *
     * @param string $csv Path to CSV location.
     *
     * @return array CSV rows as an array
     */
    public function process(string $csv): array
    {
        $rows = $this->read($csv);

        // If we have errors.
        if (!$rows) {
            return ['status' => 'error', 'message' => 'Your CSV is empty or the file does not exist.'];
        }

        $csvData = [];
        $counter = 1;

        if ($csv) {
            // Loop through all rows so we can process each row.
            foreach ($rows as $row) {
                // Don't process the first row because it contains headings.
                if ($counter != 1) {
                    $thirdColumn = $this->convertStringToNumber($row[2]);
                    $row[2] = 0;
                    if ($thirdColumn > 0) {
                        $row[2] = $this->doubleAndStoreInMemory($thirdColumn);
                    }
                }
                $csvData[] = $row;
                $counter++;
            }
        }

        return $csvData;
    }

    /**
     * Convert String To Number
     *
     * Take a string and convert it to a number. If we cannot convert it to a valid number, then convert it to 0.
     *
     * @param $value
     *
     * @return int
     */
    private function convertStringToNumber(string $value): int
    {
        return intval($value);
    }

    /**
     * Double and store in memory
     *
     * @param string $column Data from column.
     *
     * @return int
     */
    private function doubleAndStoreInMemory(string $column): int
    {
        $numbers = $this->getNumbers();
        $doubleNumber = intval($column) * 2;
        $numbers[] = $doubleNumber;
        $this->setNumbers($numbers);
        return $doubleNumber;
    }

    /**
     * Read CSV
     *
     * We read a CSV using file then convert data from the CSV to an array.
     *
     * @param string $pathToCsv
     *
     * @return array
     */
    private function read(string $pathToCsv): array
    {
        if (file_exists($pathToCsv)) {
            return array_map('str_getcsv', file($pathToCsv));
        }

        return [];
    }

    /**
     * Output processed data to a new CSV file.
     *
     * @param array $csvData
     */
    public function output(array $csvData)
    {
        $fp = fopen('storage/output_' . time() . '.csv', 'w');

        $csvDataWithNewColumn = $this->addColumn($csvData, 'Height');

        foreach ($csvDataWithNewColumn as $rows) {
            fputcsv($fp, $rows);
        }

        fclose($fp);
    }

    /**
     * Add Column
     *
     * Add a new column to a data set which represents a CSV.
     *
     * @param array  $csvData
     * @param string $columnName
     *
     * @return array
     */
    private function addColumn(array $csvData, string $columnName): array
    {
        $counter = 1;
        $csvDataWithAppendedColumn = [];
        foreach ($csvData as $row) {
            if ($counter === 1) {
                $row[] = $columnName;
            } else {
                $row[] = 0;
            }
            $counter++;
            $csvDataWithAppendedColumn[] = $row;
        }

        return $csvDataWithAppendedColumn;
    }

    /*
    |--------------------------------------------------------------------------
    | Getters and Setters
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Get Numbers
     *
     * @return array
     */
    public function getNumbers(): array
    {
        return $this->numbers;
    }

    /**
     * Set Numbers
     *
     * @param array $numbers
     */
    public function setNumbers(array $numbers)
    {
        $this->numbers = $numbers;
    }
}