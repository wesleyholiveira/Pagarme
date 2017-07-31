<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FantasiaEntity
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="fantasia")
 */
class FantasiaEntity extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    protected $descricao;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $valor;

    /**
     * @ORM\OneToOne(targetEntity="FornecedorEntity", inversedBy="fantasia")
     * @var FornecedorEntity
     */
    protected $fornecedor;

    public function __construct(
        int $id = null,
        string $descricao,
        float $valor,
        FornecedorEntity $fornecedor
    )
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->fornecedor = $fornecedor;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getDescricao() : string
    {
        return $this->descricao;
    }

    public function getValor() : float
    {
        return $this->valor;
    }

    public function getFornecedor() : FornecedorEntity
    {
        return $this->fornecedor;
    }

}
