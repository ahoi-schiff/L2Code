<?php
// src/Entity/Page.php

namespace App\Entity;

use DateTime;

class Page
{
    private?int $id = null;
    private string $title;
    private string $content;
    private DateTime $createdAt;

    public function getId():?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }
}