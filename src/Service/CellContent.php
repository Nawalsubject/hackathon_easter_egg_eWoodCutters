<?php


namespace App\Service;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use App\Service\Player;
use App\Model\ObjectManager;
use App\Service\Egg;
use App\Controller\CellController;

class CellContent
{
    private $twig;
    private $content_type_id;
    private $player_id;

    const TABLE = 'object';

    public function __construct(int $content_type_id, int $player_id)
    {
        $this->content_type_id=$content_type_id;
        $this->player_id=$player_id;
    }

    /**
     * @return mixed
     */
    public function getContentTypeId()
    {
        return $this->content_type_id;
    }

    /**
     * @param mixed $content_type_id
     */
    public function setContentTypeId($content_type_id): void
    {
        $this->content_type_id = $content_type_id;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * @param mixed $player_id
     */
    public function setPlayerId($player_id): void
    {
        $this->player_id = $player_id;
    }

    public function action()
    {
        switch ($this->content_type_id) {
            case 1:
                $this->addEgg();
                break;
            case 2:
                $this->addMilk();
                break;
            case 3:
                $this->addChoco();
                break;
            case 4:
                $this->deleteObject();
                break;
            case 5:
                $this->win();
                break;
        }
    }

    private function addChoco()
    {
        $objectManager = new ObjectManager();
        $object= ['content_type_id' => $this->content_type_id ,
            'player_id' => $this->player_id];
        $id = $objectManager->insert($object);

        return $id;
    }
    private function addMilk()
    {
        $objectManager = new ObjectManager();
        $object= ['content_type_id' => $this->content_type_id ,
            'player_id' => $this->player_id];
        $id = $objectManager->insert($object);

        return $id;
    }
    private function addEgg()
    {
        $objectManager = new ObjectManager();
        $egg = new Egg();
        $egg_id = $egg->getId();
        $object= ['content_type_id' => $this->content_type_id ,
            'content_id' => $egg_id,
            'player_id' => $this->player_id];
        $id = $objectManager->insertEgg($object);

        return $id;
    }
    private function deleteObject()
    {
        $objectManager = new ObjectManager();
        $objects = $objectManager->selectAllPlayerObjects($this->player_id);
        shuffle($objects);
        $id = $objects[0]['id'];
        $objectManager->delete($id);
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function win()
    {
        header('Location: win');
    }
}
