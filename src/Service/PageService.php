<?php
// src/Service/PageService.php
namespace App\Service;
use App\Repository\PageRepositoryInterface;

class PageService
{
    private PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getLatestPageTitles(int $limit): array
    {
        $pages = $this->pageRepository->findAll(); // Verwendet die Abhängigkeit
        $titles = [];
        foreach (array_slice($pages, 0, $limit) as $page) {
            $titles[] = $page->getTitle();
        }
        return $titles;
    }
}