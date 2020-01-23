<?php

namespace App\Http\Controllers;

use App\Models\Matrix;
use App\Services\SymbolGenerator;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function test()
    {
//        return view('index');
        $matrix = new Matrix(5, 5);
        $matrix->createMatrix();

        $generator = new SymbolGenerator($matrix);
        $generator->generateSymbolsForMatrix();

//        $matrix->printMatrix();

    }
}
