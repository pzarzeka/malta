<?php


namespace App\Models;


class Matrix
{

    /**
     * @var int
     */
    public $columns;

    /**
     * @var int
     */
    public $rows;

    /**
     * @var array
     */
    public $matrix;

    /**
     * Matrix constructor.
     *
     * @param $columns
     * @param $rows
     */
    public function __construct($columns, $rows)
    {
        $this->columns = $columns;
        $this->rows = $rows;
    }

    /**
     * Print matrix on console
     */
    public function printMatrix()
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = $i; $j < $this->columns * $this->rows; $j+=$this->rows) {
                echo $this->matrix[$j];
                echo "\t\t";
            }
            echo "\n";
        }
    }

}