<?php

namespace App\Factories\Faker;

use PagarMe\Sdk\BankAccount\BankAccount;
use App\Services\PagarMeService;
use Faker\Generator;
use Faker\Provider\Biased;

class RecipientFactoryFaker
{
    /** @var PagarMeService */
    private $pagarMe;

    /** @var Generator */
    private $faker;

    public function __construct(PagarMeService $pagarMe, Generator $faker)
    {
        $this->pagarMe = $pagarMe;
        $this->faker = $faker;
        $this->faker->addProvider(new Biased($faker));
    }

    public function __invoke(BankAccount $bankAccount)
    {
        $faker                          = $this->faker;
        $transferInterval               = 'monthly';
        $transferDay                    = $faker->biasedNumberBetween(1, 31);
        $transferEnabled                = true;
        $automaticAnticipationEnabled   = $faker->randomElement([true, false]);
        $anticipatableVolumePercentage  = $faker->randomFloat(2, 0, 100);

        return $this->pagarMe->createRecipient(
            $bankAccount,
            $transferInterval,
            $transferDay,
            $transferEnabled,
            $automaticAnticipationEnabled,
            $anticipatableVolumePercentage
        );
    }
}