<?php
/**
 * Created by PhpStorm.
 * User: revalGovender
 * Date: 10/05/2017
 * Time: 21:05
 */

namespace Tests\Unit;

use Reval\Csv as Csv;

class CsvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The System Under Test
     *
     * @var Csv
     */
    protected $sut;

    public function setUp()
    {
        $this->setSut(new Csv());
    }

    /*
    |--------------------------------------------------------------------------
    | Tests
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Can we read a CSV correctly
     *
     * We expect to get the data from the CSV as an array.
     *
     * @test
     */
    public function haveWeProcessedTheCsvFileCorrectly()
    {
        // Assume.
        $expectedData = [
            ['First Name', 'Last Name', 'Age'],
            ['Reval', 'Govender', 56],
            ['Bob', 'Martin', 0],
            ['Taylor', 'Otwell', 0],
            ['Jeffrey', 'Way', 0]
        ];
        $expectedNumbers = [56];

        // Action.
        $csvData = $this->getSut()->process('storage/file.csv');

        // Assert.
        $this->assertEquals($expectedData, $csvData, 'We have not read the CSV correctly');
        $this->assertEquals(
            $expectedNumbers,
            $this->getSut()->getNumbers(),
            'We have not doubled numbers correctly'
        );
    }

    /**
     * Do we handle errors.
     *
     * We expect an error because we are giving an incorrect file path.
     *
     * @test
     */
    public function doWeHandleErrors()
    {
        // Assume.
        $expectedData = ['status' => 'error', 'message' => 'Your CSV is empty or the file does not exist.'];

        // Action.
        $csvData = $this->getSut()->process("i don't exist");

        // Assert.
        $this->assertEquals($expectedData, $csvData, 'We have not handled errors correctly');
    }

    /*
    |--------------------------------------------------------------------------
    | Getters and Setters
    |--------------------------------------------------------------------------
    |
    */

    /**
     * @return Csv
     */
    public function getSut(): Csv
    {
        return $this->sut;
    }

    /**
     * @param Csv $sut
     */
    public function setSut(Csv $sut)
    {
        $this->sut = $sut;
    }
}
