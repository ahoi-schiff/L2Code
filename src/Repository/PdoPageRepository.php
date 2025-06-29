<?php

// src/Repository/PdoPageRepository.php

namespace App\Repository;

use App\Entity\Page;
use PDO;

class PdoPageRepository implements PageRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM pages ORDER BY createdAt DESC');
        return $stmt->fetchAll(PDO::FETCH_CLASS, Page::class);
    }

    public function findById(int $id): ?Page
    {
        $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Page::class);
        $page = $stmt->fetch();
        return $page === false ? null : $page;
    }

    public function save(Page $page): bool
    {
        if ($page->getId() === null) {
            // Neuer Page: INSERT
            $stmt = $this->pdo->prepare(
                'INSERT INTO pages (title, content, createdAt) VALUES (:title, :content, :createdAt)'
            );
        } else {
            // Bestehender Page: UPDATE
            $stmt = $this->pdo->prepare(
                'UPDATE pages SET title = :title, content = :content WHERE id = :id'
            );
        }

        return $stmt->execute();
    }
    public function delete(Page $page): bool
    {
        if ($page->getId() === null) {
            // Bestehender Page: DELETE
            $stmt = $this->pdo->prepare(
                'DELETE FROM pages WHERE id = :id'
            );
        }

        return $stmt->execute();
    }
}
