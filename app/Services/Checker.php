<?php


namespace App\Services;


use App\Models\Matrix;

class Checker
{
    public $matrix;
    public $firstColumn;
    public $lines = [];
    public $patterns = [];
    public $winners = [];
    private $winnerService;

    /**
     * Checker constructor.
     *
     * @param Matrix $matrix
     */
    public function __construct(Matrix $matrix)
    {
        $this->matrix = $matrix;
        $this->firstColumn = $this->getFirstColumnIndexes();
        $this->winnerService = new WinnersService();
    }

    /**
     * Function sets indexes of first column
     *
     * @return array
     */
    public function getFirstColumnIndexes()
    {
        $return = [];
        for ($i = 0; $i < $this->matrix->rows; $i++) {
            $return[] = $i;
        }

        return $return;
    }

    /**
     * Function generates every lines where we can find a pattern (win)
     */
    public function generateLines()
    {
        $this->generateLinesHorizontally();
        $this->generateLinesDiagonally();
    }

    /**
     * Function generates lines with indexes numbers in matrix rows
     */
    public function generateLinesHorizontally()
    {
        foreach ($this->firstColumn as $item) {
            $return = [];
            for ($i = 0; $i < $this->matrix->columns; $i++) {
                $key = $item + $i * $this->matrix->rows;
                if (array_key_exists($key, $this->matrix->matrix)) {
                    $return[] = $key;
                }
            }
            $this->lines[] = $return;
        }
    }

    /**
     * Function generates diagonally lines with indexes numbers in matrix
     */
    public function generateLinesDiagonally()
    {
        $max = $this->matrix->rows;
        if ($max < $this->matrix->columns) {
            $max = $this->matrix->columns;
        }

        $return = [];
        $index = $this->firstColumn[0];
        for ($i = 0; $i < $max; $i++) {
            if ($i < $this->matrix->rows) {
                $index = $i * ($this->matrix->rows + 1);
            } else {
                $index = $index + $this->matrix->rows - 1;
            }
            $return[] = $index;
        }
        $this->lines[] = $return;

        $return = [];
        $index = end($this->firstColumn);
        for ($i = 1; $i < $max+1; $i++) {
            if ($i <= $this->matrix->rows) {
                $index = $i * ($this->matrix->rows - 1);
            } else {
                $index = $index + ($this->matrix->rows + 1);
            }
            $return[] = $index;
        }
        $this->lines[] = $return;
    }

    /**
     * Function generates patterns with symbols for every generated lines
     */
    public function generatePatterns()
    {
        foreach ($this->lines as $line) {
            $this->patterns[] = $this->getPattern($line);
        }
    }

    /**
     * Function generate pattern with symbol for one line
     *
     * @param $line
     *
     * @return array
     */
    public function getPattern($line)
    {
        $return = [];
        foreach ($line as $item) {
            $return[] = strval($this->matrix->matrix[$item]);
        }

        return $return;
    }

    /**
     * Function check wins
     */
    public function checkWin()
    {
        $this->generateLines();
        $this->generatePatterns();
        $this->checkPatterns();
        $this->winnerService->setWinners($this->winners);
    }

    /**
     * Function check generated patterns
     */
    public function checkPatterns()
    {
        foreach ($this->lines as $line) {
            $win = $this->checkPattern($line);
            if ($win > 2) {
                $key = $this->generatePatternKey($line);
                $this->winners[$key] = $win;
            }
        }
    }

    /**
     * Function check win for one pattern
     *
     * @param $line
     *
     * @return int
     */
    public function checkPattern($line)
    {
        $repeater = 1;
        $pattern = $this->getPattern($line);
        foreach ($pattern as $key => $item) {
            if (array_key_exists($key+1, $pattern) && $pattern[$key] === $pattern[$key+1]) {
                $repeater++;
            } else {
                break;
            }
        }

        return $repeater;
    }

    /**
     * Function implode symbols in one string
     *
     * @param $pattern
     *
     * @return string
     */
    public function generatePatternKey($pattern)
    {
        return implode(' ', $pattern);
    }

    /**
     * Display game stats
     */
    public function displayWinner()
    {
        $gameStats = $this->winnerService->getGameStats();
        $gameStats['board'] = implode(', ', $this->matrix->matrix);

        echo json_encode($gameStats, JSON_PRETTY_PRINT);
    }

}