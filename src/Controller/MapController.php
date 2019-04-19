<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\CellManager;
use App\Model\MapManager;
use App\Model\ObjectManager;
use App\Service\CellContent;
use App\Service\Egg;
use App\Service\Map;
use App\Model\PlayerManager;
use App\Service\Player;

/**
 * Class ItemController
 *
 */
class MapController extends AbstractController
{

    /**
     * Display map
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {

        $playerNext = 1;
        echo $_POST['player_next'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['player_next'])) {
                $playerNext = $_POST['player_next'];
                if ($playerNext == 2) {
                    $playerNext = 1;
                } else {
                    $playerNext = 2;
                }
            };
        }

        $playerManager = new PlayerManager;
        $players = $playerManager->selectAll();

        $objectManager = new ObjectManager();
        $milkPlayer1 = $objectManager->getCountMilk(1);
        $milkPlayer2 = $objectManager->getCountMilk(2);
        $chocolatePlayer1 = $objectManager->getCountChocolate(1);
        $chocolatePlayer2 = $objectManager->getCountChocolate(2);
        $eggPlayer1 = $objectManager->getCountEgg(1);
        $eggPlayer2 = $objectManager->getCountEgg(2);


        $map = new Map(12, 12, 3, 6, 4, 3);

        $mapCells = $map->getAllCells();


        return $this->twig->render('Map/index.html.twig', [
            'map' => $map,
            'cells' => $mapCells,
            'players' => $players,
            'player_id' => $playerNext,
            'player1' => ['milk' => $milkPlayer1, 'chocolate' => $chocolatePlayer1, 'egg' => $eggPlayer1],
            'player2' => ['milk' => $milkPlayer2, 'chocolate' => $chocolatePlayer2, 'egg' => $eggPlayer2],
            'content' => false,
        ]);
    }

    public function show()
    {
        $player='';
        $playerCurrent = 1;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST['goWhere'];

            $playerCurrent = $_POST['player_next'];
            $player = new Player($playerCurrent);
            switch ($_POST['goWhere']) {
                case "up":
                    $player->goUp();
                    break;
                case "down":
                    $player->goDown();
                    break;
                case "left":
                    $player->goLeft();
                    break;
                case "right":
                    $player->goRight();
                    break;
            }
        }

        $playerManager = new PlayerManager;
        $players = $playerManager->selectAll();

        $objectManager = new ObjectManager();
        $milkPlayer1 = $objectManager->getCountMilk(1);
        $milkPlayer2 = $objectManager->getCountMilk(2);
        $chocolatePlayer1 = $objectManager->getCountChocolate(1);
        $chocolatePlayer2 = $objectManager->getCountChocolate(2);
        $eggPlayer1 = $objectManager->getCountEgg(1);
        $eggPlayer2 = $objectManager->getCountEgg(2);


        $map = new Map(12, 12, 3, 6, 4, 3);

        $mapCells = $map->getAllCells();
        $content_id = $map->getContent($player->getX(), $player->getY());

        $content = new CellContent($content_id, $playerCurrent);
        $content->action();

        if ($content_id>0) {
            $cellManager = new CellManager();
            $cellManager->updateContentStatus($player->getX(), $player->getY());
        }


        return $this->twig->render('Map/index.html.twig', [
            'map' => $map,
            'cells' => $mapCells,
            'players' => $players,
            'player_id' => $playerCurrent,
            'player1' => ['milk' => $milkPlayer1, 'chocolate' => $chocolatePlayer1, 'egg' => $eggPlayer1],
            'player2' => ['milk' => $milkPlayer2, 'chocolate' => $chocolatePlayer2, 'egg' => $eggPlayer2],
            'content' => true,
            '$content_id' => $content_id
        ]);
    }
}
