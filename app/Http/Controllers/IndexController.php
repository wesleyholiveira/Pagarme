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
        try {
            $response = $fantasiaRepository->buscar();
        } catch(\Exception $e) {
            $response = $e->getMessage();
        }

        return view('index',
            [
                'response'      => $response,
                'src'           => Helpers::asset('/bin/app.bundle.js'),
                'uri'           => Helpers::urlGenerator()->current()
            ]
        );
    }
}
