<?php

namespace App\Factories;

use App\Entities\FantasiaEntity;
use App\Entities\FornecedorEntity;
use App\Entities\ImagemEntity;

class FantasiaFactory
{
    /**
     * @param int|null         $id
     * @param string           $descricao
     * @param float            $valor
     * @param FornecedorEntity $fornecedorEntity
     * @param ImagemEntity     $imagemEntity
     * @return FantasiaEntity
     */
    public function __invoke(
        int $id = null,
        string $descricao,
        float $valor,
        FornecedorEntity $fornecedorEntity,
        ImagemEntity $imagemEntity
    ) : FantasiaEntity
    {
        return new FantasiaEntity($id, $descricao, $valor, $fornecedorEntity, $imagemEntity);
    }
}
