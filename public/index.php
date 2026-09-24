<?php

declare(strict_types=1);

define('ROOT', dirname(__DIR__));

require ROOT . '/config/config.php';

spl_autoload_register(function (string $class): void {
    $file = ROOT . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

function e(?string $valor): string {
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

Core\Session::start();

require ROOT . '/app/seed.php';

$router = new Core\Router();
require ROOT . '/app/routes.php';
$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
