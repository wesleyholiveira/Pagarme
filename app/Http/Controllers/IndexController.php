<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    public function get(Request $request)
    {
        return view('index', ['name' => 'falae ae cuzaçço']);
    }
}