<?php

namespace App\Factories\Faker;

use Faker\Generator;
use PagarMe\Sdk\PagarMe;
use App\Helpers\Helpers;

class CardFactoryFaker
{
    /** @var PagarMe */
    private $pagarMe;

    /** @var Generator */
    private $faker;

    /**
     * BankAccountFactoryFaker constructor.
     * @param PagarMe $pagarMe
     * @param Generator      $faker
     */
    public function __construct(PagarMe $pagarMe, Generator $faker)
    {
        $this->pagarMe = $pagarMe;
        $this->faker = $faker;
    }

    public function __invoke()
    {
        $faker = $this->faker;

        return $this->pagarMe->card()->create(
            $faker->creditCardNumber,
            $faker->name,
            Helpers::sanitizeStr($faker->creditCardExpirationDateString)
        );
    }
}
