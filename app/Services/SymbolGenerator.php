<?php


namespace App\Services;


use App\Models\Matrix;

class SymbolGenerator
{

    /**
     * @var Matrix
     */
    public $matrix;

    /**
     * @var array
     */
    private $symbols = [9, 10, 'J', 'Q', 'K', 'A', 'cat', 'dog', 'monkey', 'bird'];

    /**
     * SymbolGenerator constructor.
     *
     * @param Matrix $matrix
     */
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
    }

    /**
     * Function generate random symbol for every ceil in array
     */
    function generateSymbolsForMatrix()
    {
        for ($i = 0; $i < $this->matrix->rows * $this->matrix->columns; $i++) {
            $this->matrix->matrix[$i] = $this->getRandomSymbol();
        }
    }

    /**
     * Function return random element from $symbols
     *
     * @return string|integer
     */
    private function getRandomSymbol()
    {
        return $this->symbols[array_rand($this->symbols)];
    }

}