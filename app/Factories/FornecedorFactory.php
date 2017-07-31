<?php

namespace App\Factories;

use App\Entities\FornecedorEntity;

/**
 * Class FornecedorFactory
 * @package App\Factories
 */
class FornecedorFactory
{
    /**
     * @param int|null $id
     * @param string   $nome
     * @param float    $comissao
     * @return FornecedorEntity
     */
    public function __invoke(
        int $id = null,
        string $nome,
        float $comissao
    ) : FornecedorEntity
    {
        return new FornecedorEntity($id, $nome, $comissao);
    }
}