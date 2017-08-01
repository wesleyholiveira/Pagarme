<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use \JsonSerializable;

/**
 * Class ImagemEntity
 * @package App\Entities
 * @ORM\Entity
 * @ORM\Table(name="imagem")
 */
class ImagemEntity extends AbstractEntity implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $uri;

    /**
     * @ORM\OneToOne(targetEntity="FantasiaEntity", mappedBy="imagem")
     * @var FantasiaEntity
     */
    protected $fantasia;

    public function __construct(
        int $id,
        string $uri
    )
    {
        $this->id = $id;
        $this->uri = $uri;
    }

    public function jsonSerialize()
    {
        $fantasia = $this->fantasia;
        if(!isset($this->fantasia))
            $fantasia = '';

        return [
            'id' => $this->id,
            'uri' => $this->uri,
            'fantasia' => [$fantasia]
        ];
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getUri() : string
    {
        return $this->uri;
    }

    public function getFantasia() : FantasiaEntity
    {
        return $this->fantasia;
    }

}
