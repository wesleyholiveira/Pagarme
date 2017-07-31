<?php

namespace App\Http\Controllers;

use App\Repository\FantasiaRepository;
use App\Helpers\Helpers;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    public function get(FantasiaRepository $fantasiaRepository)
    {
        return view('index',
            [
                'fantasias'     => $fantasiaRepository->buscar(),
                'src'           => Helpers::asset('/bin/app.bundle.js')]
        );
    }
}
