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
     * @return FornecedorEntity
     */
    public function __invoke(
        int $id = null,
        string $nome
    ) : FornecedorEntity
    {
        return new FornecedorEntity($id, $nome);
    }
}
