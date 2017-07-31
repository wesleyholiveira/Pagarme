<?php

namespace App\Factories;

use App\Entities\FantasiaEntity;
use App\Entities\FornecedorEntity;

class FantasiaFactory
{
    /**
     * @param int|null         $id
     * @param string           $descricao
     * @param float            $valor
     * @param FornecedorEntity $fornecedorEntity
     * @return FantasiaEntity
     */
    public function __invoke(
        int $id = null,
        string $descricao,
        float $valor,
        FornecedorEntity $fornecedorEntity
    ) : FantasiaEntity
    {
        return new FantasiaEntity($id, $descricao, $valor, $fornecedorEntity);
    }
}
