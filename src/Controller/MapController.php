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
use App\Service\Egg;
use App\Service\Map;

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

        /* tableau pour test */

        $players = [
            ['id' => 1, 'name' => 'Darth Vader', 'picture' => 'https://images.innoveduc.fr/easter_hackathon/3.jpeg',
                'species' => 'Human', 'gender' => 'male', 'origin' => 'Earth', 'class' => 'intello'],
            ['id' => 2, 'name' => 'Abadango Cluster Princess',
                'picture' => 'https://images.innoveduc.fr/easter_hackathon/6.jpeg', 'species' => 'Alien',
                'gender' => 'female', 'origin' => 'Abadango', 'class' => 'caid'],

        ];
        /* tableau pour test */



        $map = new Map(12, 12, 3, 6, 4, 3);
        // A FAIRE : TRUNCATE TABLE PLAYER
        $map->generator();
        $mapCells = $map->getAllCells();

        return $this->twig->render('Map/index.html.twig', [
            'map' => $map,
            'cells' => $mapCells,
            'players' => $players
        ]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $mapManager = new MapManager();
        $map = $mapManager->selectOneById($id);

        return $this->twig->render('Map/show.html.twig', ['map' => $map]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $mapManager = new MapManager();
        $map = $mapManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $map['title'] = $_POST['title'];
            $mapManager->update($map);
        }

        return $this->twig->render('Map/edit.html.twig', ['map' => $map]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mapManager = new MapManager();
            $map = [
                'title' => $_POST['title'],
            ];
            $id = $mapManager->insert($map);
            header('Location:/map/show/' . $id);
        }

        return $this->twig->render('Map/add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $mapManager = new MapManager();
        $mapManager->delete($id);
        header('Location:/item/index');
    }
}
