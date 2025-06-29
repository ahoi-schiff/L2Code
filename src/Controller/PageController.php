<?php
// src/Controller/PageController.php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\PageRepositoryInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PageController extends BaseController // Erbt von BaseController
{
    private PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        parent::__construct(); // Ruft den Konstruktor des BaseControllers auf
        $this->pageRepository = $pageRepository;
    }
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(): void
    {
        $pages = $this->pageRepository->findAll();
        echo $this->twig->render('page/index.html.twig', ['pages' => $pages]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function show(int $id): void
    {
        // Dummy-Daten für die Anzeige
        $page = [$id];

        echo $this->twig->render('page/show.html.twig', ['page' => $page]);
    }
}