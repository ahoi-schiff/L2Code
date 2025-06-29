<?php

// tests/Unit/Entity/PageTest.php

namespace App\Tests\Unit\Entity;

use App\Entity\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function testSetAndGetTitle(): void
    {
        $page = new Page();
        $title = 'Ein Test-Titel';

        $page->setTitle($title);

        $this->assertSame($title, $page->getTitle());
    }

    public function testIdIsNullOnCreation(): void
    {
        $page = new Page();
        $this->assertNull($page->getId());
    }
}
