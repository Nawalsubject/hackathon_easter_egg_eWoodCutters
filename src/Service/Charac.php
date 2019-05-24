<?php

namespace App\Service;

use GuzzleHttp;

/**
 * Class Egg
 */
class Charac
{
    private $id;
    private $kind;
    private $name;
    private $gender;
    private $origin;
    private $specie;
    private $picture;
    private $skills;
    public $caids = ['Alien', 'Cronenberg', 'Disease'];
    public $intellos = ['Human', 'Human/Cyborg', 'Human/Mutant', 'Humanoïd'];
    public $vegans = ['Démon', 'Kryptonian', 'Maia'];
    public $sportifs = ['Rabbit toon', 'Amazonian Woman', 'Human toon'];


    public function __construct(string $id = '', $kind = '')
    {
        $this->setId($id);
        $this->setkind($kind);
        $characParameters = $this->loadData();
        $this->setId($characParameters['id']);
        $this->setspecie($characParameters['species']);
        $this->setName($characParameters['name']);
        $this->setGender($characParameters['gender']);
        $this->setOrigin($characParameters['origin']);
        $this->setPicture($characParameters['image']);
        $this->setSkills($characParameters['skills']);
    }

    public function loadData(): array
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client(
            [
                'base_uri' => 'https://tours.wilders.dev/api/characters/',
            ]
        );

        if (!empty($this->id)) {
            $response = $client->request('GET', $this->id);
            $body = $response->getBody();
            $charachs = json_decode($body->getContents(), true);
        } else {
            switch ($this->kind) {
                case 'caid':
                    $kindArray = $this->caids;
                    break;
                case 'intello':
                    $kindArray = $this->intellos;
                    break;
                case 'vegan':
                    $kindArray = $this->vegans;
                    break;
                case 'sportif':
                    $kindArray = $this->sportifs;
                    break;
                default:
                    $kindArray = [];
                    break;
            }

            $response = $client->request('GET', 'random');
            $body = $response->getBody();
            $charachs = json_decode($body->getContents(), true);

            while (!in_array($charachs['species'], $kindArray)) {
                $response = $client->request('GET', 'random');
                $body = $response->getBody();
                $charachs = json_decode($body->getContents(), true);
            };
        }

        return $charachs;
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
    public function getkind()
    {
        return $this->kind;
    }

    public function setkind($kind): void
    {
        $this->kind = $kind;
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
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills): void
    {
        $this->skills = $skills;
    }
}
