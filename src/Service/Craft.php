<?php

namespace App\Service;

use App\Model\ObjectManager;

class Craft
{
    public $player_id;
    /**
     * Milk the player wants to use
     * INT
     */
    private $milk;

    /**
     * Chocolate the player want to use
     * INT
     */
    private $chocolate;

    /**
     * Egg that the user gets when he cooked
     */
    private $egg;

    public function __construct(int $milk, int $chocolate, int $player_id)
    {
        $this->player_id = $player_id;
        $this->milk = $milk;
        $this->chocolate = $chocolate;
    }

    public function getChocolate(): int
    {
        return $this->chocolate;
    }

    public function setChocolate(int $chocolate)
    {
        $this->chocolate = $chocolate;
        return $this;
    }

    public function getMilk(): int
    {
        return $this->milk;
    }

    public function setMilk(int $milk)
    {
        $this->milk = $milk;
        return $this;
    }

    public function getEgg(): string
    {
        return $this->egg;
    }

    public function setEgg(string $egg)
    {
        $this->egg = $egg;
        return $this;
    }

    public function cooking()
    {
        $objectManager = new ObjectManager();
        $nbMilk = $objectManager->getCountMilk($this->player_id);
        $nbChoco = $objectManager->getCountChocolate($this->player_id);
        $nbEgg = $objectManager->getCountEgg($this->player_id);
        $sum = $nbMilk + $nbChoco;
        if ($sum % 2 == 0) {
            $nbEgg += floor($sum / 2);
            return $nbEgg;
        }
    }
    public function delete()
    {
        $objectManager = new ObjectManager();
        $nbMilk = $objectManager->getCountMilk($this->player_id);
        $nbChoco = $objectManager->getCountChocolate($this->player_id);
    }
}
