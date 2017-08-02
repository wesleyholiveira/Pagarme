<?php

namespace App\Factories;

use App\Services\PagarMeService;
use Faker\Generator;

class BankAccountFactory
{
    private $pagarMe;
    private $faker;

    public function __construct(PagarMeService $pagarMe, Generator $faker)
    {
        $this->pagarMe = $pagarMe;
        $this->faker = $faker;
    }

    public function __invoke()
    {
        $faker          = $this->faker;
        $bankCode       = $faker->randomNumber(3);
        $agenciaNumber  = sprintf('0%d', $faker->randomNumber(4));
        $accountNumber  = $faker->randomNumber(5);
        $accountDigit   = $faker->randomDigit();
        $documentNumber = '26268738888';
        $legalName      = sprintf('Conta Teste %d', $faker->randomNumber(2));
        $agenciaDigit   = $faker->randomDigit();

        return $this->pagarMe->createBankAccount(
            $bankCode,
            $agenciaNumber,
            $accountNumber,
            $accountDigit,
            $documentNumber,
            $legalName,
            $agenciaDigit
        );
    }
}