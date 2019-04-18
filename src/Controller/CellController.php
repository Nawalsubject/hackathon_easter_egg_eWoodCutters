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

/**
 * Class ItemController
 *
 */
class CellController extends AbstractController
{


    /**
     * Display cell
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $cellManager = new CellManager();

        $cell = $cellManager->selectAll();

        return $this->twig->render('Cell/index.html.twig', ['cell' => $cell]);
    }

}
