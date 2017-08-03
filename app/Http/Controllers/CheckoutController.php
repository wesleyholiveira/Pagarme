<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Validator\CheckoutValidator;
use App\Services\PagarMeService;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PagarMe\Sdk\PagarMeException;
use \Exception;

/**
 * Class CheckoutController
 * @package App\Http\Controllers
 */
class CheckoutController extends Controller
{
    /** @var  PagarMeService */
    protected $pagarMe;

    /** @var  CheckoutValidator */
    protected $validator;

    public function __construct(
        PagarMeService $pagarMe,
        CheckoutValidator $validator
    )
    {
        $this->pagarMe = $pagarMe;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function doCheckout(Request $request)
    {
        try {
            $data = $request->all();

            // Valida os dados de entrada
            foreach($data as $fornecedor) {
                $this->validator->validate($fornecedor);
            }

            var_dump($this->pagarMe->doCheckout($data));

            return response()->json(
              ['descricao' => 'It works'],
              StatusCodeInterface::STATUS_OK
            );
        } catch(PagarMeException $e) {
            return response()->json(
                $e->getMessage(),
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        } catch(Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }
}