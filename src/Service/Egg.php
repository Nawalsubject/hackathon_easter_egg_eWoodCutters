<?php

namespace App\Service;

use GuzzleHttp;

/**
 * Class Egg
 */
class Egg
{
    private $id;
    private $name;
    private $color;
    private $caliber;
    private $farming;
    private $country;
    private $rarity;
    private $image;
    private $power;
    private $validity;

    public function __contruct(string $id = '')
    {
        $this->setId($id);
        $eggParameters = $this->loadData();
        $this->setId($eggParameters['id']);
        $this->setName($eggParameters['name']);
        $this->setColor($eggParameters['color']);
        $this->setCaliber($eggParameters['caliber']);
        $this->setFarming($eggParameters['farming']);
        $this->setCountry($eggParameters['country']);
        $this->setRarity($eggParameters['rarity']);
        $this->setImage($eggParameters['image']);
        $this->setPower($eggParameters['power']);
        $this->setValidity($eggParameters['validity']);
    }

    public function loadData() : array
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client(
            [
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/eggs/',
            ]
        );

        if (empty($this->id)) {
            $response=  $client->request('GET', 'random');
        } else {
            $response=  $client->request('GET', $this->id);
        }
        $body = $response->getBody();

        return json_decode($body->getContents(), true);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getCaliber()
    {
        return $this->caliber;
    }

    /**
     * @param mixed $caliber
     */
    public function setCaliber($caliber): void
    {
        $this->caliber = $caliber;
    }

    /**
     * @return mixed
     */
    public function getFarming()
    {
        return $this->farming;
    }

    /**
     * @param mixed $farming
     */
    public function setFarming($farming): void
    {
        $this->farming = $farming;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @param mixed $rarity
     */
    public function setRarity($rarity): void
    {
        $this->rarity = $rarity;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power): void
    {
        $this->power = $power;
    }

    /**
     * @return mixed
     */
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * @param mixed $validity
     */
    public function setValidity($validity): void
    {
        $this->validity = $validity;
    }

    public function getAttackPoint() : int
    {

        return 0;
    }
}
