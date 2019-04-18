<?php

namespace App\Model;

use App\Service\Charac;

/**
 * Class PlayerManager
 */
class PlayerManager extends AbstractManager
{
    const TABLE = 'player';


    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

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
}
