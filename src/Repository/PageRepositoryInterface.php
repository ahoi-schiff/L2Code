<?php
// src/Repository/PageRepositoryInterface.php

namespace App\Repository;

use App\Entity\Page;

interface PageRepositoryInterface
{
    /** @return Page */
    public function findAll(): array;

    public function findById(int $id):?Page;

    public function save(Page $page): bool;

    public function delete(Page $page): bool;
}