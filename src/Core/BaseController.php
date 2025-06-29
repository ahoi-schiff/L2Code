<?php

// src/Core/BaseController.php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class BaseController
{
    protected Environment $twig;

    public function __construct()
    {
        // 1. Pfad zum Template-Verzeichnis definieren
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');

        // 2. Twig-Umgebung initialisieren
        $this->twig = new Environment($loader, );
    }

    public static function readEnv($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}
