<?php

namespace App\Http\Controllers;

use App\Factories\BankAccountFactory;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use App\Services\PagarMeService;
use PagarMe\Sdk\PagarMeException;

/**
 * Class CheckoutController
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{
    /**
     * @param Request        $request
     * @param PagarMeService $pagarMe
     * @return string
     */
    public function doCheckout(
        Request $request,
        BankAccountFactory $bankFactory,

        PagarMeService $pagarMe
    )
    {
        try {
            $data = $request->all();
            var_dump($data);
            return response()->json(
              ['descricao' => 'It works'],
              StatusCodeInterface::STATUS_OK
            );
        } catch(PagarMeException $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}