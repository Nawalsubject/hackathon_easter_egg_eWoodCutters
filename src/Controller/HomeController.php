<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\PlayerManager;
use App\Service\Player;
use App\Service\Map;
use App\Service\CellContent;

class HomeController extends AbstractController
{

    private $class = [
        ['id' => 1, 'name' => 'Les Caïds', 'picture' => '/assets/images/caid.jpeg',
            'description' => 'Mi-ours, mi-scorpion et re-mi-ours derrière', 'bonus' => 'Force : + 2',
            'Malus' => 'Intelligence : -20'],
        ['id' => 2, 'name' => 'Les Intellos', 'picture' => '/assets/images/intello.png',
            'description' => 'Chouchou de la maitresse', 'bonus' => 'Dextérité : + 2', 'Malus' => 'Courage : -15'],
        ['id' => 3, 'name' => 'Les Sportifs', 'picture' => '/assets/images/sportif.jpg',
            'description' => 'Foooooot , du foot, du foot , du foot !', 'bonus' => 'déplacement : + 1',
            'Malus' => 'Micro pénis'],
        ['id' => 4, 'name' => 'Les Végans', 'picture' => '/assets/images/vegan.jpg',
            'description' => 'Je suis pas gros. je suis jovial et épanoui !', 'bonus' => 'Santé : + 20',
            'Malus' => 'Charisme : -50']
    ];

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {

        /*$test = new CellContent(4, 1);
        $test->action();*/

        return $this->twig->render('Home/index.html.twig');
    }

    public function config()
    {

        $truncatePlayer = new PlayerManager();
        $truncatePlayer->truncate();
        $map = new Map(12, 12, 3, 6, 4, 3);
        $map->generator();
        return $this->twig->render('Home/config.html.twig', ['classes' => $this->class]);
    }

    public function choice($kind, $player = 1)
    {
        $classSelected = ['caid', 'intello', 'sportif', 'vegan'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST['player_id']);
        }

        if ($player == 1) {
            $player1 = new Player(1);
            $player1->init($classSelected[$kind - 1], 1, 1);
            return $this->twig->render('Home/config.html.twig', [
                'classes' => $this->class,
                'secondChoice' => true, 'player1' => $player1]);
        } else {
            $player2 = new Player(2);
            $player2->init($classSelected[$kind - 1], 12, 12);
            return $this->twig->render('Map/index.html.twig');
        }
    }
}
