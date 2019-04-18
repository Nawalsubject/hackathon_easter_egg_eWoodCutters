<?php

namespace App\Model;

use App\Service\Charac;

/**
 * Class PlayerManager
 */
class PlayerManager extends AbstractManager

    /**
     *
     */
{
    private $id;
    private $charac_id;
    private $name;
    private $species;
    private $gender;
    private $origin;
    private $picture;
    private $kind;
    private $life;

    const TABLE = 'player';


    /**
     * @param array $player
     *
     */
    public function insert(array $player)
    {

        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table
 (`charac_id`,`name`,`species`, `gender`, `origin`, `picture`, `kind`, `life`) 
        VALUES (:charac_id, :name, :species, :gender, :origin, :picture, :kind, :life)");

        $statement->bindValue('charac_id', $player['charac_id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $player['name'], \PDO::PARAM_INT);
        $statement->bindValue('species', $player['species'], \PDO::PARAM_INT);
        $statement->bindValue('gender', $player['gender'], \PDO::PARAM_INT);
        $statement->bindValue('origin', $player['origin'], \PDO::PARAM_INT);
        $statement->bindValue('picture', $player['picture'], \PDO::PARAM_INT);
        $statement->bindValue('kind', $player['kind'], \PDO::PARAM_INT);
        $statement->bindValue('life', $player['life'], \PDO::PARAM_INT);

        $statement->execute();
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
        return $this->species;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species): void
    {
        $this->species = $species;
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
