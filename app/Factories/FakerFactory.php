<?php

namespace App\Factories;

use Faker\Factory;

class FakerFactory
{
    public function __invoke()
    {
        return Factory::create();
    }
}