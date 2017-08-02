<?php

namespace App\Http\Controllers;

use App\Factories\Faker\BankAccountFactoryFaker;
use App\Factories\Faker\RecipientFactoryFaker;
use App\Http\Validator\CheckoutValidator;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use PagarMe\Sdk\PagarMeException;
use \Exception;

/**
 * Class CheckoutController
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{
    /** @var BankAccountFactoryFaker  */
    protected $bankFactory;

    /** @var RecipientFactoryFaker  */
    protected $recipientFactory;

    /** @var CheckoutValidator  */
    protected $validator;

    /**
     * CheckoutController constructor.
     * @param BankAccountFactoryFaker $bankFactory
     * @param RecipientFactoryFaker   $recipientFactory
     * @param CheckoutValidator       $validator
     */
    public function __construct(
        BankAccountFactoryFaker $bankFactory,
        RecipientFactoryFaker $recipientFactory,
        CheckoutValidator $validator
    )
    {
        $this->bankFactory      = $bankFactory;
        $this->recipientFactory = $recipientFactory;
        $this->validator        = $validator;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doCheckout(Request $request)
    {
        try {
            $bankFactory        = $this->bankFactory;
            $recipientFactory   = $this->recipientFactory;
            $validator          = $this->validator;

            $data       = $request->all();
            $recipient  = [];

            foreach($data as $fornecedor) {
                // Valida os dados para o checkout
                $validator->validate($fornecedor);

                // Uma conta diferente para cada fornecedor
                $bank = $bankFactory($fornecedor['nome']);

                // Registrando os fornecedores
                $recipient[] = $recipientFactory($bank);
            }

            return response()->json(
              ['descricao' => 'It works'],
              StatusCodeInterface::STATUS_OK
            );
        } catch(PagarMeException $e) {
            return response()->json(
                json_decode($e->getMessage()),
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        } catch(Exception $e) {
            return response()->json(
                json_decode($e->getMessage()),
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
    }
}