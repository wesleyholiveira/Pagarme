<?php

namespace App\Services;

interface InterfacePagarMeService
{
    const TAX_SHIPMENT = 42.00;

    public function doCheckout($data);
}