<?php

// tests/Unit/Service/PageServiceTest.php

namespace App\Tests\Unit\Service;

use App\Entity\Page;
use App\Repository\PageRepositoryInterface;
use App\Service\PageService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class PageServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetLatestPageTitles(): void
    {
        // 1. Vorbereitung (Arrange)

        // Erstelle Dummy-Page-Objekte für den Test
        $page1 = new Page();
        $page1->setTitle('Titel 1');
        $page2 = new Page();
        $page2->setTitle('Titel 2');
        $page3 = new Page();
        $page3->setTitle('Titel 3');

        // Erstelle ein Mock-Objekt für das Repository-Interface
        $repositoryMock = $this->createMock(PageRepositoryInterface::class);

        // Konfiguriere den Mock: Wenn die Methode `findAll()` aufgerufen wird,
        // soll sie unser vorbereitetes Array von Pages zurückgeben.
        $repositoryMock->method('findAll')->willReturn([$page1, $page2, $page3]);

        // Erstelle eine Instanz der zu testenden Klasse und injiziere den Mock
        $pageService = new PageService($repositoryMock);

        // 2. Ausführung (Act)
        $result = $pageService->getLatestPageTitles(2);

        // 3. Überprüfung (Assert)
        $this->assertCount(2, $result);
        $this->assertEquals(['Titel 1', 'Titel 2'], $result);
    }
}
