<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FantasiaEntity
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="fantasia")
 */
class FantasiaEntity extends AbstractEntity implements \JsonSerializable
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

    /**
     * @ORM\OneToOne(targetEntity="ImagemEntity", inversedBy="fantasia")
     * @var ImagemEntity
     */
    protected $imagem;

    public function __construct(
        int $id = null,
        string $descricao,
        float $valor,
        FornecedorEntity $fornecedor,
        ImagemEntity $imagem
    )
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->fornecedor = $fornecedor;
        $this->imagem = $imagem;
    }

    public function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'descricao'     => $this->descricao,
            'valor'         => $this->valor,
            'fornecedor'    => [
                'id'        => $this->fornecedor->getId(),
                'nome'      => $this->fornecedor->getNome()
            ],
            'imagem'        => [
                'id'        => $this->imagem->getId(),
                'uri'       => $this->imagem->getUri()
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
    public function getDescricao() : string
    {
        return $this->descricao;
    }

    /**
     * @return float
     */
    public function getValor() : float
    {
        return $this->valor;
    }

    /**
     * @return FornecedorEntity
     */
    public function getFornecedor() : FornecedorEntity
    {
        return $this->fornecedor;
    }

    /**
     * @param ImagemEntity $imagem
     * @return ImagemEntity
     */
    public function setImagem(ImagemEntity $imagem)
    {
        return $this->imagem = $imagem;
    }

    /**
     * @return ImagemEntity
     */
    public function getImagem() : ImagemEntity
    {
        return $this->imagem;
    }

}
