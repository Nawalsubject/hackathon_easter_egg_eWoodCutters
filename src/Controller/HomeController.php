<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

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
            /* tableau pour test */
        ];
        return $this->twig->render('Home/config.html.twig', ['classes'=> $class]);
    }
}
