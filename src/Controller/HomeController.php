<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\PLayerManager;

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

        $class= [
            ['name' => 'Les Caïds', 'picture' => '/assets/images/caid.jpeg',
                'races' =>[ 'race1', 'race2', 'race3']],
            ['name' => 'Les Intellos', 'picture' => '/assets/images/intello.png',
                ['races' => 'race YO', 'race POUET']],
            ['name' => 'Les Sportifs', 'picture' => '/assets/images/sportif.jpg',
            'description' => 'description ... '],
            ['name' => 'Les Végans', 'picture' => '/assets/images/vegan.jpg',
                'description' => 'description ... ']
        ];

        /* TO DO!!!!!!  TRUNCATE Table PLAYER ET TURN AVANT LA CREATION DES PLAYER par la class Player*/


        return $this->twig->render('Home/config.html.twig', ['classes'=> $class]);
    }
}
