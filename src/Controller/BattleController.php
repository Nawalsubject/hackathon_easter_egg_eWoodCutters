<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\MapManager;
use App\Model\ObjectManager;
use App\Service\Egg;
use App\Service\Map;
use App\Model\PlayerManager;

/**
 * Class BattleController
 *
 */
class BattleController extends AbstractController
{

    /**
     * Display battle
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $playerManager = new PlayerManager;
        $player = $playerManager->selectAll();
        return $this->twig->render('Battle/index.html.twig', ['players'=> $player]);
    }
}
