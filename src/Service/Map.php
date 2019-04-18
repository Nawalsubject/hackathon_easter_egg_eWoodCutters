<?php

namespace App\Service;

use App\Model\CellManager;

/**
 * Class Map
 */
class Map
{
    /**
     *
     */
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        $this->setHeight($height);
        $this->setWidth($width);
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        if ($width <= 0) {
            $width=10;
        }
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        if ($height <= 0) {
            $height=10;
        }
        $this->height = $height;
    }

    public function generator()
    {
    }
}
