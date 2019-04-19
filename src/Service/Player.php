<?php

namespace App\Service;

use App\Model\ObjectManager;
use App\Model\PlayerManager;
use App\Service\Charac;

class Player
{

    private $id;
    private $charac_id;
    private $name;
    private $specie;
    private $gender;
    private $origin;
    private $picture;
    private $kind;
    private $life;
    private $X;
    private $Y;


    public function __construct($id)
    {
        $playerManager = new PlayerManager();
        $playerCharacteristics=$playerManager->selectOneById($id);

        if (!empty($playerCharacteristics)) {
            $this->setCharacId($playerCharacteristics['charac_id']);
            $this->setName($playerCharacteristics['name']);
            $this->setSpecie($playerCharacteristics['species']);
            $this->setGender($playerCharacteristics['gender']);
            $this->setOrigin($playerCharacteristics['origin']);
            $this->setPicture($playerCharacteristics['picture']);
            $this->setKind($playerCharacteristics['kind']);
            $this->setLife($playerCharacteristics['life']);
            $this->setX($playerCharacteristics['X_init']);
            $this->setY($playerCharacteristics['Y_init']);
        }
    }

    public function init($kind, $xinit = 1, $yinit = 1)
    {
        $player = new Charac('', $kind);
        $this->setCharacId($player->getId());
        $this->setName($player->getName());
        $this->setSpecie($player->getSpecie());
        $this->setGender($player->getGender());
        $this->setOrigin($player->getOrigin());
        $this->setPicture($player->getPicture());
        $this->setKind($player->getkind());
        $this->life =100;
        if ($this->kind == 'vegan') {
            $this->life += 20;
        }
        $this->setX($xinit);
        $this->setY($yinit);

        $playerManager = new PlayerManager();
        $playerManager->insert($this);
    }

    public function goLeft() : bool
    {
        $playerManager = new PlayerManager();
        $playerManager->updateXY($this->getX()-1, $this->getY(), $this->getId());
        return true;
    }
    public function goRight() : bool
    {
        $playerManager = new PlayerManager();
        $playerManager->updateXY($this->getX()+1, $this->getY(), $this->getId());
        return true;
    }
    public function goUp() : bool
    {
        $playerManager = new PlayerManager();
        $playerManager->updateXY($this->getX(), $this->getY()+1, $this->getId());
        return true;
    }
    public function goDown() : bool
    {
        $playerManager = new PlayerManager();
        $playerManager->updateXY($this->getX()-1, $this->getY()-1, $this->getId());
        return true;
    }

    public function getBag() : array
    {
        $objectManager=new ObjectManager();

        return $objectManager->getBag($this->getId());
    }



    /**
     * @return mixed
     */
    public function getSpecie()
    {
        return $this->specie;
    }

    /**
     * @param mixed $specie
     */
    public function setSpecie($specie): void
    {
        $this->specie = $specie;
    }

    /**
     * @return mixed
     */
    public function getCharacId()
    {
        return $this->charac_id;
    }

    /**
     * @param mixed $charac_id
     */
    public function setCharacId($charac_id): void
    {
        $this->charac_id = $charac_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->X;
    }

    /**
     * @param mixed $X
     */
    public function setX($X): void
    {
        $this->X = $X;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->Y;
    }

    /**
     * @param mixed $Y
     */
    public function setY($Y): void
    {
        $this->Y = $Y;
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
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }


    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin): void
    {
        $this->origin = $origin;
    }


    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind): void
    {
        $this->kind = $kind;
    }

    /**
     * @return mixed
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * @param mixed $life
     */
    public function setLife($life): void
    {
        $this->life = $life;
    }
}
