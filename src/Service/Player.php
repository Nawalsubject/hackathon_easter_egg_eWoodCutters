<?php


namespace App\Service;

use App\Service\Charac;

class Player
{

    private $id;
    private $charac_id;
    private $name;
    private $gender;
    private $origin;
    private $picture;
    private $kind;
    private $life = 100;


    public function __construct($kind)
    {
        $player = new Charac('', $kind);
        $this->setCharacId($player->getId());
        $this->setName($player->getName());
        $this->setGender($player->getGender());
        $this->setOrigin($player->getGender());
        $this->setPicture($player->getPicture());
        $this->setKind($player->getkind());

        if ($this->kind == 'vegan') {
            $this->life += 20;
        }
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
    public function getId(): int
    {
        return $this->id;
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
    public function getSpecies()
    {
        return $this->kind;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species): void
    {
        $this->kind = $species;
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
