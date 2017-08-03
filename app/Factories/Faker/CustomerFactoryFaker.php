<?php

namespace App\Factories\Faker;

use App\Helpers\Helpers;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\Address as AddressFaker;
use PagarMe\Sdk\Customer\Customer;
use PagarMe\Sdk\Customer\Address;
use PagarMe\Sdk\Customer\Phone;
use Faker\Generator;

class CustomerFactoryFaker
{
    /** @var Generator */
    private $faker;

    /**
     * BankAccountFactoryFaker constructor.
     * @param Generator      $faker
     */
    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
        $this->faker->addProvider(new Person($faker));
        $this->faker->addProvider(new AddressFaker($faker));
    }

    public function __invoke()
    {
        $faker = $this->faker;
        return new Customer(
            [
                'name' => $faker->name,
                'email' => $faker->email,
                'document_number' => $faker->cpf(false),
                'address' => new Address([
                    'street'        => $faker->streetName,
                    'street_number' => $faker->randomNumber(2),
                    'neighborhood'  => 'centro',
                    'zipcode'       => '14870720',
                    'complementary' => '',
                    'city'          => $faker->city,
                    'state'         => $faker->stateAbbr(),
                    'country'       => 'Brasil'
                ]),
                'phone' => new Phone([
                    'ddd'    => '15',
                    'number' => sprintf("9%d", $faker->randomNumber(8))
                ]),
                'born_at' => sprintf('%d%d%d',
                    $faker->biasedNumberBetween(1, 31),
                    $faker->biasedNumberBetween(1, 12),
                    $faker->biasedNumberBetween(1930, date('Y'))
                ),
                'sex' => $faker->randomElement(['M', 'F'])
            ]
        );
    }
}