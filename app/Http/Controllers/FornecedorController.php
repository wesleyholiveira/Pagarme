<?php

namespace App\Http\Controllers;

use App\Factories\FornecedorFactory;
use App\Http\Validator\FornecedorValidator;
use App\Repository\FornecedorRepository;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use \Exception;

/**
 * Class FornecedorController
 * @package App\Http\Controllers
 */
class FornecedorController extends Controller
{
    /* @var FornecedorFactory */
    protected $fornecedorFactory;

    /* @var FornecedorRepository */
    protected $fornecedor;

    /** @var FornecedorValidator */
    protected $fornecedorValidator;

    /**
     * FornecedorController constructor.
     * @param FornecedorRepository $fornecedor
     * @param FornecedorFactory    $fornecedorFactory
     * @param FornecedorValidator $fornecedorValidator
     */
    public function __construct(
        FornecedorRepository $fornecedor,
        FornecedorFactory $fornecedorFactory,
        FornecedorValidator $fornecedorValidator
    )
    {
        /** @var FornecedorRepository */
        $this->fornecedor = $fornecedor;

        /** @var FornecedorFactory */
        $this->fornecedorFactory = $fornecedorFactory;

        /** @var FornecedorValidator */
        $this->fornecedorValidator = $fornecedorValidator;
    }

    /**
     * Processa as requisicoes via GET referente ao fornecedor.
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(int $id = null)
    {
        try {

            $response = $this->fornecedor->buscar($id);

            return response()->json(
                $response,
                StatusCodeInterface::STATUS_OK
            );
        } catch (Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    /**
     * Processa as requisiçoes via POST referente ao fornecedor.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        try {
            $data = $request->all();
            $data['id'] = $data['id'] ?? 0;

            $this->fornecedorValidator->validate($data);

            $factory = $this->fornecedorFactory;
            $fornecedor = $factory($data['id'], $data['nome']);

            return response()->json(
                ['descricao' => $this->fornecedor->criar($fornecedor)],
                StatusCodeInterface::STATUS_CREATED
            );
        } catch (Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode() ?? 500
            );
        }
    }

    /**
     * Processa as requisiçoes via PUT referente ao fornecedor.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(Request $request)
    {
        try {
            $data = $request->all();

            $this->fornecedorValidator->validate($data);

            $factory = $this->fornecedorFactory;
            $fornecedor = $factory($data['id'], $data['nome']);
            return response()->json(
                ['descricao' => $this->fornecedor->atualizar($fornecedor)],
                StatusCodeInterface::STATUS_OK
            );
        } catch(Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    /**
     * Processa as requisiçoes via DELETE referente ao fornecedor.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $fornecedor = $this->fornecedor->buscar($id);
            return response()->json(
                ['descricao' => $this->fornecedor->deletar($fornecedor)],
                StatusCodeInterface::STATUS_OK
            );
        } catch(Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

}
