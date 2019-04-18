<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\ObjectManager;

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
        return $this->twig->render('Home/config.html.twig');
    }
}
