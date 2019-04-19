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
    private $nbRandomMonster;

    public function __construct(
        int $width,
        int $height,
        int $nbRandomEggs = 0,
        int $nbRandomMilk = 0,
        int $nbRandomChoco = 0,
        int $nbRandomMonster = 0,
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
        $this->setNbRandomMonster($nbRandomMonster);
    }

    /**
     * @return mixed
     */
    public function getNbRandomMonster()
    {
        return $this->nbRandomMonster;
    }

    /**
     * @param mixed $nbRandomMonster
     */
    public function setNbRandomMonster($nbRandomMonster): void
    {
        $this->nbRandomMonster = $nbRandomMonster;
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
        $this->fillMapContent();
    }

    private function generateCells($mapId) : bool
    {
        $cellManager = new CellManager();
        for ($col = 1; $col <= $this->width; $col++) {
            for ($row = 1; $row <= $this->height; $row++) {
                $cell = [
                    'x' => $col,
                    'y' => $row,
                    'map_id' => $mapId,
                ];
                $cellManager->insert($cell);
            }
        }

        return true;
    }

    private function fillMapContent() : bool
    {
        $cellManager = new CellManager();

        // Ajout du Super Egg
        $xpos = rand(1, $this->width);
        $ypos = rand(1, $this->height);

        $cell=$cellManager->selectOneByXY($xpos, $ypos);
        $cellContent = [
            'id' => $cell['id'],
            'content_type_id' =>5
        ];
        $cellManager->updateContent($cellContent);

        //Add random placement Monster
        for ($iMonster = 0; $iMonster < $this->nbRandomMonster; $iMonster++) {
            $xpos = rand(1, $this->width);
            $ypos = rand(1, $this->height);

            $cell=$cellManager->selectOneByXY($xpos, $ypos);
            $cellContent = [
                'id' => $cell['id'],
                'content_type_id' =>4,
            ];

            $cellManager->updateContent($cellContent);
        }


        //Add random placement eggs
        for ($iEgg = 0; $iEgg < $this->nbRandomEggs; $iEgg++) {
            $xpos = rand(1, $this->width);
            $ypos = rand(1, $this->height);

            $cell=$cellManager->selectOneByXY($xpos, $ypos);
            $cellContent = [
                'id' => $cell['id'],
                'content_type_id' =>1
            ];

            $cellManager->updateContent($cellContent);
        }

        //Add random placement milk
        for ($iMilk = 0; $iMilk < $this->nbRandomMilk; $iMilk++) {
            $xpos = rand(1, $this->width);
            $ypos = rand(1, $this->height);

            $cell=$cellManager->selectOneByXY($xpos, $ypos);
            $cellContent = [
                'id' => $cell['id'],
                'content_type_id' =>2
            ];

            $cellManager->updateContent($cellContent);
        }

        //Add random placement milk
        for ($iChoco = 0; $iChoco < $this->nbRandomChoco; $iChoco++) {
            $xpos = rand(1, $this->width);
            $ypos = rand(1, $this->height);

            $cell=$cellManager->selectOneByXY($xpos, $ypos);
            $cellContent = [
                'id' => $cell['id'],
                'content_type_id' =>3
            ];

            $cellManager->updateContent($cellContent);
        }
        return true;
    }

/*    public function getCellContentInPos(int $x, int $y) :array
    {

    }*/

    public function getAllCells(): array
    {
        $cellManager=new CellManager();
        $mapCells= $cellManager->selectAll();

        return $mapCells;
    }
}
