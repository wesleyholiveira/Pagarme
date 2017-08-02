<?php

namespace App\Factories\Faker;

use App\Services\PagarMeService;
use Faker\Generator;
use Faker\Provider\pt_BR\Person;

class BankAccountFactoryFaker
{
    /** @var PagarMeService */
    private $pagarMe;

    /** @var Generator */
    private $faker;

    /**
     * BankAccountFactoryFaker constructor.
     * @param PagarMeService $pagarMe
     * @param Generator      $faker
     */
    public function __construct(PagarMeService $pagarMe, Generator $faker)
    {
        $this->pagarMe = $pagarMe;
        $this->faker = $faker;
        $this->faker->addProvider(new Person($faker));
    }

    public function __invoke(string $name)
    {
        $faker          = $this->faker;
        $bankCode       = $faker->randomNumber(3);
        $agenciaNumber  = sprintf('0%d', $faker->randomNumber(4));
        $accountNumber  = $faker->randomNumber(5);
        $accountDigit   = $faker->randomDigit();
        $documentNumber = $faker->cpf(false);
        $legalName      = sprintf('%s', $name);
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