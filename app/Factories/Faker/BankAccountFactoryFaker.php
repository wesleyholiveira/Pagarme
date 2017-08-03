<?php

namespace App\Factories\Faker;

use Faker\Generator;
use Faker\Provider\pt_BR\Person;
use PagarMe\Sdk\PagarMe;

class BankAccountFactoryFaker
{
    /** @var PagarMe */
    private $pagarMe;

    /** @var Generator */
    private $faker;

    /**
     * BankAccountFactoryFaker constructor.
     * @param PagarMe       $pagarMe
     * @param Generator      $faker
     */
    public function __construct(PagarMe $pagarMe, Generator $faker)
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

        return $this->pagarMe->bankAccount()->create(
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