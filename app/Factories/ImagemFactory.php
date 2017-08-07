<?php
namespace App\Factories;

use App\Entities\FantasiaEntity;
use App\Entities\ImagemEntity;

class ImagemFactory
{
    /**
     * @param int|null         $id
     * @param string           $uri
     * @return ImagemEntity
     */
    public function __invoke(
        int $id = null,
        string $uri
    ) : ImagemEntity
    {
        return new ImagemEntity($id, $uri);
    }
}
