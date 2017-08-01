<?php

namespace App\Http\Controllers;

use App\Factories\ImagemFactory;
use App\Repository\FantasiaRepository;
use App\Repository\ImagemRepository;
use App\Http\Validator\ImagemValidator;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use \Exception;

/**
 * Class ImagemController
 * @package App\Http\Controllers
 */
class ImagemController extends Controller
{
    /** @var ImagemFactory  */
    protected $imagemFactory;

    /** @var ImagemRepository  */
    protected $imagemRepository;

    /** @var  ImagemValidator */
    protected $imagemValidator;

    /**
     * ImagemController constructor.
     * @param ImagemFactory $imagemFactory
     * @param ImagemRepository $imagemRepository
     */
    public function __construct(
        ImagemFactory $imagemFactory,
        ImagemRepository $imagemRepository,
        ImagemValidator $imagemValidator
    )
    {
        $this->imagemFactory = $imagemFactory;
        $this->imagemRepository = $imagemRepository;
        $this->imagemValidator = $imagemValidator;
    }

    /**
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(int $id = null)
    {
        try {

            $response = $this->imagemRepository->buscar($id);

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

            $this->imagemValidator->validate($data);

            $factory = $this->imagemFactory;
            $imagem = $factory($data['id'], $data['uri']);

            return response()->json(
                ['descricao' => $this->imagemRepository->criar($imagem)],
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

            $this->imagemValidator->validate($data);

            $factory = $this->imagemFactory;
            $imagem = $factory($data['id'], $data['uri']);
            return response()->json(
                ['descricao' => $this->imagemRepository->atualizar($imagem)],
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
            $imagem = $this->imagemRepository->buscar($id);
            return response()->json(
                ['descricao' => $this->imagemRepository->deletar($imagem)],
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
