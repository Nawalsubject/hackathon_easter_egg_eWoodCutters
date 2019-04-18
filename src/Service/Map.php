<?php

namespace App\Service;

use App\Model\MapManager;
use App\Model\MapBackgroundManager;
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
    private $name;
    private $descr;
    private $nbRandomEggs;
    private $nbRandomMilk;
    private $nbRandomChoco;

    public function __construct(
        int $width,
        int $height,
        int $nbRandomEggs = 0,
        int $nbRandomMilk = 0,
        int $nbRandomChoco = 0,
        string $name = "Choco Map",
        string $descr = "Ma carte"
    ) {
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setName($name);
        $this->setDescr($descr);
        $this->setNbRandomEggs($nbRandomEggs);
        $this->setNbRandomMilk($nbRandomMilk);
        $this->setNbRandomChoco($nbRandomChoco);
    }
    /**
     * @return mixed
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * @param mixed $descr
     */
    public function setDescr($descr): void
    {
        $this->descr = $descr;
    }
    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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

    /**
     * @return mixed
     */
    public function getNbRandomEggs()
    {
        return $this->nbRandomEggs;
    }

    /**
     * @param mixed $nbRandomEggs
     */
    public function setNbRandomEggs($nbRandomEggs): void
    {
        $this->nbRandomEggs = $nbRandomEggs;
    }

    /**
     * @return mixed
     */
    public function getNbRandomMilk()
    {
        return $this->nbRandomMilk;
    }

    /**
     * @param mixed $nbRandomMilk
     */
    public function setNbRandomMilk($nbRandomMilk): void
    {
        $this->nbRandomMilk = $nbRandomMilk;
    }

    /**
     * @return mixed
     */
    public function getNbRandomChoco()
    {
        return $this->nbRandomChoco;
    }

    /**
     * @param mixed $nbRandomChoco
     */
    public function setNbRandomChoco($nbRandomChoco): void
    {
        $this->nbRandomChoco = $nbRandomChoco;
    }

    public function generator()
    {
        $mapBackgroundManager = new MapBackgroundManager();
        $mapBackgrounds = $mapBackgroundManager->selectAll();
        shuffle($mapBackgrounds);

        $mapBackground = $mapBackgrounds[0]['picture'];

        $mapManager = new MapManager();
        //Clean Map DB
        $mapManager->deleteAll();

        $cellManager = new CellManager();
        //Clean Cells DB
        $cellManager->deleteAll();

        $map = [
            'name' => $this->name,
            'width' => $this->width,
            'height' => $this->height,
            'background' => $mapBackground,
            'descr' => $this->descr,
            ];

        $idMap = $mapManager->insert($map);

        $this->generateCells($idMap);
    }

    public function generateCells($mapId) : bool
    {
        $cellManager = new CellManager();
        for ($col = 1; $col <= $this->width; $col++) {
            for ($row = 1; $row <= $this->height; $row++) {
                $cell = [
                    'x' => $row,
                    'y' => $col,
                    'map_id' => $mapId,
                ];
                $cellManager->insert($cell);
            }
        }

        return true;
    }

    public function fillMapContent() : bool
    {
/*
        for ($iEgg = 0 ; $iEgg < $this->nbRandomEggs; $iEgg++) {

        }*/

        return true;
    }
}
