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

class HomeController extends AbstractController
{

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
        /*$eggManager = new ObjectManager();
        $nbEggs = $eggManager->getCountEgg(1);

        $milkManager = new ObjectManager();
        $nbMilk = $milkManager->getCountMilk(1);

        $chocolateManager = new ObjectManager();
        $nbChocolates = $chocolateManager->getCountChocolate(1);*/

        return $this->twig->render('Home/index.html.twig');
    }

    public function config()
    {
        /* tableau pour test */

        $class = [
            ['id' => 1, 'name' => 'Les Caïds', 'picture' => '/assets/images/caid.jpeg',
                'races' => ['race1', 'race2', 'race3']],
            ['id' => 2, 'name' => 'Les Intellos', 'picture' => '/assets/images/intello.png',
                ['races' => 'race YO', 'race POUET']],
            ['id' => 3, 'name' => 'Les Sportifs', 'picture' => '/assets/images/sportif.jpg',
                'description' => 'description ... '],
            ['id' => 4, 'name' => 'Les Végans', 'picture' => '/assets/images/vegan.jpg',
                'description' => 'description ... ']
        ];
        /* tableau pour test */

        $truncatePlayer = new PlayerManager();
        $truncatePlayer->truncate();
        $map = new Map(12, 12, 3, 6, 4, 3);
        $map->generator();
        return $this->twig->render('Home/config.html.twig', ['classes' => $class]);
    }

    public function choice($kind, $player = 1)
    {
        $class = ['caid', 'intello', 'sportif', 'vegan'];

        if ($player == 1) {
            $player1 = new Player(1);
            $player1->init($class[$kind], 0, 0);
            return $this->twig->render('Home/config.html.twig', ['classes' => $kind, 'secondChoice' => true]);
        } else {
            $player2 = new Player(2);
            $player2->init($class[$kind], 12, 12);
            return $this->twig->render('Map/index.html.twig');
        }
    }
}
