<?php


namespace App\Services;


use App\Models\Matrix;

class Game
{

    /**
     * Main function responsible for the game
     */
    public function play()
    {
        $matrix = new Matrix(5, 3);

        $generator = new SymbolGenerator($matrix);
        $generator->generateSymbolsForMatrix();

        // I used it for checking matrix and wins
        $matrix->printMatrix();

        $checker = new Checker($matrix);
        $checker->checkWin();
        $checker->displayWinner();
    }

}