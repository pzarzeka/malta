<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Game as GameService;

class Game extends Command
{
    protected $signature = "game:play";
    protected $description = "Maltese game";

    public function handle()
    {
        $service = new GameService();
        $service->play();
    }

}