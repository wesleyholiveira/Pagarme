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
     * @ORM\OneToOne(targetEntity="FantasiaEntity", mappedBy="fornecedor")
     * @var FantasiaEntity
     */
    protected $fantasia;

    /**
     * FornecedorEntity constructor.
     * @param int|null $id
     * @param string $nome
     */
    public function __construct(int $id = null, string $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'nome'          => $this->nome,
            'fantasia'      => [
                'id'        => $this->fantasia->getId(),
                'valor'     => $this->fantasia->getValor(),
                'descricao' => $this->fantasia->getDescricao()
            ]
        ];
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNome() : string
    {
        return $this->nome;
    }

    /**
     * @param FantasiaEntity $fantasia
     */
    public function setFantasia(FantasiaEntity $fantasia)
    {
        $this->fantasia = $fantasia;
    }

    /**
     * @return FantasiaEntity
     */
    public function getFantasia() : FantasiaEntity
    {
        return $this->fantasia;
    }

}
