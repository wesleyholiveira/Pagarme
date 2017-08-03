<?php

namespace App\Factories\Faker;

use PagarMe\Sdk\BankAccount\BankAccount;
use Faker\Generator;
use PagarMe\Sdk\PagarMe;

class RecipientFactoryFaker
{
    /** @var PagarMe */
    private $pagarMe;

    /** @var Generator */
    private $faker;

    public function __construct(PagarMe $pagarMe, Generator $faker)
    {
        $this->pagarMe = $pagarMe;
        $this->faker = $faker;
    }

    public function __invoke(BankAccount $bankAccount)
    {
        $faker                          = $this->faker;
        $transferInterval               = 'daily';
        $transferDay                    = '0';
        $transferEnabled                = true;
        $automaticAnticipationEnabled   = $faker->randomElement([true, false]);
        $anticipatableVolumePercentage  = $faker->randomFloat(2, 0, 100);

        return $this->pagarMe->recipient()->create(
            $bankAccount,
            $transferInterval,
            $transferDay,
            $transferEnabled,
            $automaticAnticipationEnabled,
            $anticipatableVolumePercentage
        );
    }
}