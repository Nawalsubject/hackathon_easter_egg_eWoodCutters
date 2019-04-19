<?php

namespace App\Model;

use App\Service\Charac;
use App\Service\Player;

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
     * @param Player $player
     * @return int
     */
    public function insert(Player $player) : int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table
        (`id`, `charac_id`,`name`,`species`, `gender`, `origin`, `picture`, `kind`, `life`,`x_init`,`y_init`) 
        VALUES (:id, :charac_id, :name, :species, :gender, :origin, :picture, :kind, :life, :x_init,:y_init)");

        $statement->bindValue('id', $player->getId(), \PDO::PARAM_INT);
        $statement->bindValue('charac_id', $player->getCharacId(), \PDO::PARAM_INT);
        $statement->bindValue('name', $player->getName(), \PDO::PARAM_STR);
        $statement->bindValue('species', $player->getSpecie(), \PDO::PARAM_STR);
        $statement->bindValue('gender', $player->getGender(), \PDO::PARAM_STR);
        $statement->bindValue('origin', $player->getOrigin(), \PDO::PARAM_STR);
        $statement->bindValue('picture', $player->getPicture(), \PDO::PARAM_STR);
        $statement->bindValue('kind', $player->getKind(), \PDO::PARAM_STR);
        $statement->bindValue('life', $player->getLife(), \PDO::PARAM_INT);
        $statement->bindValue('x_init', $player->getX(), \PDO::PARAM_INT);
        $statement->bindValue('y_init', $player->getY(), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function updateXY(int $x, int $y, int $playerid)
    {
        $statement="";
        // prepared request
        if ($playerid == 1) {
            $statement = $this->pdo->prepare("UPDATE cell SET  player1_reveal = 1 WHERE `x` = :x AND `y` = :y");
            $statement->bindValue('x', $x, \PDO::PARAM_INT);
            $statement->bindValue('y', $y, \PDO::PARAM_INT);

            $statement->execute();
        } else {
            $statement = $this->pdo->prepare("UPDATE cell SET  player2_reveal = 1 WHERE `x` = :x AND `y` = :y");
            $statement->bindValue('x', $x, \PDO::PARAM_INT);
            $statement->bindValue('y', $y, \PDO::PARAM_INT);
            $statement->execute();
        }

        $statement = $this->pdo->prepare("UPDATE $this->table SET `x_init` = :x, `y_init` = :y WHERE id=:id");
        $statement->bindValue('x', $x, \PDO::PARAM_INT);
        $statement->bindValue('y', $y, \PDO::PARAM_INT);
        $statement->bindValue('id', $playerid, \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function updateLife(int $life, int $playerid)
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `life` = :life WHERE id=:id");
        $statement->bindValue('life', $life, \PDO::PARAM_INT);
        $statement->bindValue('id', $playerid, \PDO::PARAM_INT);

        return $statement->execute();
    }
}
