<?php

namespace App\Http\Controllers;

use App\Factories\FantasiaFactory;
use App\Http\Validator\FantasiaValidator;
use App\Repository\FantasiaRepository;
use App\Repository\FornecedorRepository;
use App\Repository\ImagemRepository;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use \Exception;

/**
 * Class FantasiaController
 * @package App\Http\Controllers
 */
class FantasiaController extends Controller
{
    /* @var FantasiaFactory */
    protected $fantasiaFactory;

    /* @var FantasiaRepository */
    protected $fantasia;

    /** @var FornecedorRepository */
    protected $fornecedor;

    /** @var FantasiaValidator */
    protected $fantasiaValidator;

    /** @var  ImagemRepository */
    protected $imagemRepository;

    /**
     * FantasiaController constructor.
     * @param FantasiaRepository   $fantasia
     * @param FantasiaFactory      $fantasiaFactory
     * @param FornecedorRepository $fornecedor
     * @param FantasiaValidator    $fantasiaValidator
     * @param ImagemRepository     $imagemRepository
     */
    public function __construct(
        FantasiaRepository $fantasia,
        FantasiaFactory $fantasiaFactory,
        FornecedorRepository $fornecedor,
        FantasiaValidator $fantasiaValidator,
        ImagemRepository $imagemRepository
    )
    {
        $this->fantasia = $fantasia;
        $this->fantasiaFactory = $fantasiaFactory;
        $this->fornecedor = $fornecedor;
        $this->fantasiaValidator = $fantasiaValidator;
        $this->imagemRepository = $imagemRepository;
    }

    /**
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(int $id = null)
    {
        try {

            $response = $this->fantasia->buscar($id);

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        try {
            $data = $request->all();
            $data['id'] = $data['id'] ?? 0;

            $this->fantasiaValidator->validate($data);

            $factory = $this->fantasiaFactory;
            $fornecedor = $this->fornecedor->buscar($data['fornecedorId']);
            $imagem = $this->imagemRepository->buscar($data['imagemId']);

            $fantasia = $factory($data['id'], $data['descricao'], $data['valor'], $fornecedor, $imagem);

            return response()->json(
                ['descricao' => $this->fantasia->criar($fantasia)],
                StatusCodeInterface::STATUS_CREATED
            );
        } catch (Exception $e) {
            return response()->json(
                ['descricao' => $e->getMessage()],
                $e->getCode()
            );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(Request $request)
    {
        try {
            $data = $request->all();
            $factory = $this->fantasiaFactory;
            $fantasia = $factory($data['id'], $data['descricao'], $data['valor']);
            return response()->json(
                ['descricao' => $this->fantasia->atualizar($fantasia)],
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $fantasia = $this->fantasia->buscar($id);
            return response()->json(
                ['descricao' => $this->fantasia->deletar($fantasia)],
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
