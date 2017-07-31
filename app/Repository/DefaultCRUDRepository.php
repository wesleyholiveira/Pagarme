<?php

namespace App\Repository;

use App\Entities\AbstractEntity;

/**
 * Interface DefaultCRUDRepository
 * @package App\Repository
 */
interface DefaultCRUDRepository
{
    public function buscar(int $id);
    public function criar(AbstractEntity $entidade);
    public function atualizar(AbstractEntity $entidade);
    public function deletar(AbstractEntity $entidade);
}