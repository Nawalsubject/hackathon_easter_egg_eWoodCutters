<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class ObjectManager extends AbstractManager
{
    /**
     *
     */
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

    /**
     * Récuperer nombre d'oeufs
     *
     * @param $player_id
     * @return int|void
     */
    public function getCountEgg($player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbEgg FROM $this->table WHERE content_type_id=:egg AND player_id=$player_id");
        $statement->bindValue('egg', self::EGG);

        $statement->execute();
        return count($statement->fetchAll());
    }

    /**
     * Récuperer le nombre de lait
     *
     * @param $player_id
     * @return int|void
     */
    public function getCountMilk($player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbMilk FROM $this->table WHERE content_type_id=:milk AND player_id=$player_id");
        $statement->bindValue('milk', self::MILK);

        $statement->execute();
        return count($statement->fetchAll());
    }

    /**
     * Récuperer le nombre de chocolats
     *
     * @param $player_id
     * @return int|void
     */
    public function getCountChocolate($player_id)
    {
        $statement = $this->pdo->prepare("SELECT id as nbChocolate FROM $this->table WHERE content_type_id=:chocolate AND player_id=$player_id");
        $statement->bindValue('chocolate', self::CHOCOLATE);

        $statement->execute();
        return  count($statement->fetchAll());
    }

}
