<?php


namespace App\Services;


class WinnersService
{
    /**
     * @var int
     */
    public $betAmount = 100;

    /**
     * @var int
     */
    public $totalWin = 0;

    /**
     * @var array
     */
    public $winners = [];

    public function __construct($betAmount = 100)
    {
        $this->setBetAmount($betAmount);
    }

    /**
     * @return int
     */
    public function getBetAmount(): int
    {
        return $this->betAmount;
    }

    /**
     * @param int $betAmount
     */
    public function setBetAmount(int $betAmount): void
    {
        $this->betAmount = $betAmount;
    }

    /**
     * @return int
     */
    public function getTotalWin(): int
    {
        return $this->totalWin;
    }

    /**
     * @param int $totalWin
     */
    public function setTotalWin(int $totalWin): void
    {
        $this->totalWin = $totalWin;
    }

    /**
     * @return array
     */
    public function getWinners(): array
    {
        return $this->winners;
    }

    /**
     * @param array $winners
     */
    public function setWinners(array $winners): void
    {
        $this->winners = $winners;
    }

    /**
     * Function sums total win
     */
    public function calculateWinner()
    {
        foreach ($this->winners as $pattern => $winner) {
            switch ($winner) {
                case 3:
                    $multiplier = 0.2;
                    break;
                case 4:
                    $multiplier = 2;
                    break;
                case 5:
                    $multiplier = 10;
                    break;
                default:
                    $multiplier = 0;
                    break;
            }
            $this->totalWin += $multiplier * $this->betAmount;
        }
    }

    /**
     * Function returns game's statistics
     *
     * @return array
     */
    public function getGameStats()
    {
        $this->calculateWinner();

        $gameStats = [
            'board' => null,
            'paylines' => $this->winners,
            'bet_amount' => $this->betAmount,
            'total_win' => $this->totalWin,
        ];

        return $gameStats;
    }

}