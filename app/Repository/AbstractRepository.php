<?php

namespace App\Repository;

use \Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Entities\AbstractEntity;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Fig\Http\Message\StatusCodeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
abstract class AbstractRepository extends EntityRepository implements DefaultCRUDRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->em = $em;
        parent::__construct($em, $class);
    }

    /**
     * Retorna todas as entidades por ID.
     * @param int $id
     * @return object|AbstractEntity
     * @throws NotFoundHttpException
     */
    public function buscar(int $id = null)
    {
        $response = null;

        if (isset($id) && is_integer($id)) {
            $response = $this->find($id);
        } else {
            $response = $this->findAll();
        }

        if (empty($response)) {
            throw new NotFoundHttpException(
                'Nenhum registro encontrado.',
                null,
                StatusCodeInterface::STATUS_NOT_FOUND
            );
        }

        return $response;
    }

    /**
     * Cria uma nova entidade.
     * @param AbstractEntity $entidade
     * @return string
     * @throws Exception
     */
    public function criar(AbstractEntity $entidade)
    {
        try {
            $em = $this->em;
            $em->persist($entidade);
            $em->flush();
            return 'Recurso criado com sucesso';
        } catch(ForeignKeyConstraintViolationException $e) {
            throw new Exception(
                'Chave estrangeira inválida',
                StatusCodeInterface::STATUS_BAD_REQUEST
            );
        }
    }

    /**
     * Atualiza a entidade
     * @param AbstractEntity $entidade
     * @return string
     * @throws Exception
     */
    public function atualizar(AbstractEntity $entidade)
    {
        try {
            $em = $this->em;
            $em->merge($entidade);
            $em->flush();
            return 'Recurso alterado com sucesso.';
        } catch(ForeignKeyConstraintViolationException $e) {
            throw new Exception(
                $e->getMessage(),
                StatusCodeInterface::STATUS_BAD_REQUEST
            );
        } catch(EntityNotFoundException $e) {
            throw new Exception(
                'Nao foi possivel encontrar a entidade com os parametros passados.',
                StatusCodeInterface::STATUS_BAD_REQUEST
            );
        } catch(Exception $e) {
            throw new Exception(
                sprintf('Ocorreu um erro: %d', $e->getCode()),
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Deleta a entidade.
     * @param AbstractEntity $entidade
     * @return string
     * @throws Exception
     */
    public function deletar(AbstractEntity $entidade)
    {
        try {
            $em = $this->em;
            $em->remove($entidade);
            $em->flush();
            return 'Recurso deletado com sucesso';
        } catch(ForeignKeyConstraintViolationException $e) {
            throw new Exception(
                'Operaçao nao permitida',
                StatusCodeInterface::STATUS_BAD_REQUEST
            );
        } catch(Exception $e) {
            throw new Exception(
              sprintf('Ocorreu um erro: %d', $e->getCode()),
              StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
    }

}