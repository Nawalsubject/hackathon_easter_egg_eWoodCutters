<?php

namespace App\Service;

use GuzzleHttp;

/**
 * Class Egg
 */
class Charac
{
    private $id;
    private $specie;
    private $name;
    private $gender;
    private $origin;
    private $image;
    private $skills;
    public $caids = ['Alien', 'Cronenberg', 'Disease'];
    public $intellos = ['Human', 'Human/Cyborg', 'Human/Mutant', 'Humanoïd'];
    public $vegans = ['Démon', 'Kryptonian', 'Maia'];
    public $sportifs = ['Rabbit toon', 'Amazonian Woman', 'Human toon'];


    public function __construct(string $id = '', $specie = '')
    {
        $this->setId($id);
        $this->setSpecie($specie);
        $characParameters = $this->loadData();
        $this->setId($characParameters['id']);
        $this->setSpecie($characParameters['species']);
        $this->setName($characParameters['name']);
        $this->setGender($characParameters['gender']);
        $this->setOrigin($characParameters['origin']);
        $this->setImage($characParameters['image']);
        $this->setSkills($characParameters['skills']);
    }

    public function loadData(): array
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client(
            [
                'base_uri' => 'http://easteregg.wildcodeschool.fr/api/characters/',
            ]
        );


        echo $this->getSpecie();

        if (!empty($this->id)) {
            $response = $client->request('GET', $this->id);
            $body = $response->getBody();
            $charachs = json_decode($body->getContents(), true);
        } else {
            switch ($this->specie) {
                case 'caid':
                    $specieArray = $this->caids;
                    break;
                case 'intello':
                    $specieArray = $this->intellos;
                    break;
                case 'vegan':
                    $specieArray = $this->vegans;
                    break;
                case 'sportif':
                    $specieArray = $this->sportifs;
                    break;
                default:
                    $specieArray = [];
                    break;
            }

            $response = $client->request('GET', 'random');
            $body = $response->getBody();
            $charachs = json_decode($body->getContents(), true);

            while (!in_array($charachs['species'], $specieArray)) {
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
    public function getSpecie()
    {
        return $this->specie;
    }

    public function setSpecie($specie): void
    {
        $this->specie = $specie;
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
