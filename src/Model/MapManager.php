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
class MapManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'map';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $map
     * @return int
     */
    public function insert(array $map): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table 
            VALUES (NULL, :name, :width,:height,:background,:descr)");
        $statement->bindValue('name', $map['name'], \PDO::PARAM_STR);
        $statement->bindValue('width', $map['width'], \PDO::PARAM_INT);
        $statement->bindValue('height', $map['height'], \PDO::PARAM_INT);
        $statement->bindValue('background', $map['background'], \PDO::PARAM_STR);
        $statement->bindValue('descr', $map['descr'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $map
     * @return bool
     */
    public function update(array $map):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $map['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $map['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * @return bool
     */
    public function deleteAll():bool
    {
        $statement = $this->pdo->prepare("TRUNCATE $this->table");
        $statement->execute();

        return $statement->execute();
    }
}
