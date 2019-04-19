<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

class ObjectManager extends AbstractManager
{
    public $tableObject = 'object';

    const TABLE = 'object';
    const EGG = 1;
    const MILK = 2;
    const CHOCOLATE = 3;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getBag(int $player_id)
    {
        $statement = $this->pdo->prepare("SELECT *  FROM $this->table 
        WHERE  player_id=$player_id ORDER BY content_type_id");

        $statement->execute();
        return $statement->fetchAll();
    }


    public function insert(array $object)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO ". self::TABLE . "(content_type_id, player_id) 
VALUES (:content_type_id, :player_id)");
        $statement->bindValue('content_type_id', $object['content_type_id'], \PDO::PARAM_INT);
        $statement->bindValue('player_id', $object['player_id'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $this->pdo->lastInsertId();
        }
    }

    public function selectAllPlayerObjects($player_id)
    {
        return $query = $this->pdo->query("SELECT * FROM $this->table JOIN content_type 
        ON object.content_type_id=content_type.id WHERE player_id=$player_id AND content_type.bag=1")->fetchAll();
    }

    public function insertEgg(array $object)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO :mytable (content_type_id,content_id,player_id) 
VALUES (:content_type_id, :content_id, :player_id)");
        $statement->bindValue('content_type_id', $object['content_type_id'], \PDO::PARAM_INT);
        $statement->bindValue('content_id', $object['content_id'], \PDO::PARAM_INT);
        $statement->bindValue('player_id', $object['player_id'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function getCountEgg(int $player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbEgg FROM $this->table 
        WHERE content_type_id=:egg AND player_id=$player_id");
        $statement->bindValue('egg', self::EGG);

        $statement->execute();
        return count($statement->fetchAll());
    }

    public function getCountMilk(int $player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbMilk FROM $this->table
        WHERE content_type_id=:milk AND player_id=$player_id");
        $statement->bindValue('milk', self::MILK);

        $statement->execute();
        return count($statement->fetchAll());
    }


    public function getCountChocolate(int $player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbChocolate FROM $this->table 
        WHERE content_type_id=:chocolate AND player_id=$player_id");
        $statement->bindValue('chocolate', self::CHOCOLATE);

        $statement->execute();
        return count($statement->fetchAll());
    }
}
