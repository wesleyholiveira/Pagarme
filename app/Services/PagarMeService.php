<?php

namespace App\Services;

use PagarMe\Sdk\BankAccount\BankAccount;
use PagarMe\Sdk\PagarMe;
use PagarMe\Sdk\Recipient\Recipient;

class PagarMeService
{
    private $pagarMe;

    public function __construct(PagarMe $pagarMe)
    {
        $this->pagarMe = $pagarMe;
    }

    /**
     * @param string $bankCode
     * @param string $agenciaNumber
     * @param string $accountNumber
     * @param string $accountDigit
     * @param string $documentNumber
     * @param string $legalName
     * @param string $agenciaDigit
     * @return \PagarMe\Sdk\BankAccount\BankAccount
     */
    public function createBankAccount(
        string $bankCode,
        string $agenciaNumber,
        string $accountNumber,
        string $accountDigit,
        string $documentNumber,
        string $legalName,
        string $agenciaDigit
    ) : BankAccount
    {
        return (
            $this->pagarMe->bankAccount()->create(
                $bankCode,
                $agenciaNumber,
                $accountNumber,
                $accountDigit,
                $documentNumber,
                $legalName,
                $agenciaDigit
            )
        );
    }

    /**
     * @param BankAccount $bankAccount
     * @param string      $transferInterval
     * @param bool        $transferEnabled
     * @param bool        $automaticAnticipationEnabled
     * @param float       $anticipatableVolumePercentage
     * @return Recipient
     */
    public function createRecipient(
        BankAccount $bankAccount,
        string $transferInterval,
        int $transferDay,
        bool $transferEnabled,
        bool $automaticAnticipationEnabled,
        float $anticipatableVolumePercentage
    ) : Recipient
    {
        return (
            $this->pagarMe->recipient()->create(
                $bankAccount,
                $transferInterval,
                $transferDay,
                $transferEnabled,
                $automaticAnticipationEnabled,
                $anticipatableVolumePercentage
            )
        );
    }
}