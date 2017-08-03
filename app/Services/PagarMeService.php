<?php

namespace App\Services;

use App\Factories\Faker\BankAccountFactoryFaker;
use App\Factories\Faker\CardFactoryFaker;
use App\Factories\Faker\CustomerFactoryFaker;
use App\Factories\Faker\RecipientFactoryFaker;
use PagarMe\Sdk\PagarMe;
use PagarMe\Sdk\SplitRule\SplitRuleCollection;

class PagarMeService implements InterfacePagarMeService
{
    /** @var BankAccountFactoryFaker  */
    protected $bankFactory;

    /** @var RecipientFactoryFaker  */
    protected $recipientFactory;

    /** @var  CustomerFactoryFaker */
    protected $customerFactory;

    /** @var CardFactoryFaker  */
    protected $cardFactory;

    /** @var  PagarMe */
    protected $pagarMe;

    public function __construct(
        BankAccountFactoryFaker $bankFactory,
        RecipientFactoryFaker $recipientFactory,
        CustomerFactoryFaker $customerFactory,
        CardFactoryFaker $cardFactory,
        PagarMe $pagarMe
    )
    {
        $this->bankFactory      = $bankFactory;
        $this->recipientFactory = $recipientFactory;
        $this->customerFactory  = $customerFactory;
        $this->cardFactory      = $cardFactory;
        $this->pagarMe          = $pagarMe;
    }

    /**
     * @param $data
     * @return \PagarMe\Sdk\Transaction\CreditCardTransaction
     */
    public function doCheckout($data)
    {
        $bankFactory        = $this->bankFactory;
        $recipientFactory   = $this->recipientFactory;
        $customerFactory    = $this->customerFactory;
        $cardFactory        = $this->cardFactory;

        $valorCentavos      = 0;
        $installments       = 1;
        $capture            = true;
        $postbackUrl        = '';
        $metadata           = [];

        $recipientMaria     = null;
        $splitrules         = new SplitRuleCollection();

        foreach($data as $fornecedor) {
            // Uma conta diferente para cada fornecedor
            $bank = $bankFactory($fornecedor['nome']);

            // Registrando os fornecedores
            $recipient = $recipientFactory($bank);

            if ($fornecedor['nome'] == 'Maria Barros') {
                $splitrules[] = $this->pagarMe->splitRule()->percentageRule(
                    15,
                    $recipient,
                    true,
                    true
                );
            } else {
                $splitrules[] = $this->pagarMe->splitRule()->percentageRule(
                    85,
                    $recipient,
                    true,
                    true
                );
            }
            $valorCentavos += $fornecedor['valor'];
        }

        // Criando um novo cliente
        $customer = $customerFactory();

        // Criando um novo cartão
        $card = $cardFactory();

        // Converte para centavos
        $valorCentavos = ($valorCentavos + InterfacePagarMeService::TAX_SHIPMENT) * 100;

        return (
            $this->pagarMe->transaction()->creditCardTransaction(
                $valorCentavos,
                $card,
                $customer,
                $installments,
                $capture,
                $postbackUrl,
                $metadata,
                ['split_rules' => $splitrules]
            )
        );
    }

}