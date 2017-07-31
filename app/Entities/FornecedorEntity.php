<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Class FornecedorEntity
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="fornecedor")
 */
class FornecedorEntity extends AbstractEntity implements JsonSerializable
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
    protected $nome;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $comissao = 0.85;

    /**
     * @ORM\OneToOne(targetEntity="FantasiaEntity", mappedBy="fornecedor")
     * @var FantasiaEntity
     */
    protected $fantasia;

    public function __construct(int $id = null, string $nome, float $comissao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->comissao = $comissao;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'comissao' => $this->comissao,
            'fantasia' => [
//                'id' => $this->fantasia->getId(),
//                'valor' => $this->fantasia->getValor(),
//                'descricao' => $this->fantasia->getDescricao()
            ]
        ];
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function getComissao() : float
    {
        return $this->comissao;
    }

    public function setFantasia(FantasiaEntity $fantasia)
    {
        $this->fantasia = $fantasia;
    }

    public function getFantasia() : FantasiaEntity
    {
        return $this->fantasia;
    }

}