<?php use Core\Auth; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(APP_NAME) ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="<?= BASE_URL ?>/"><?= e(APP_NAME) ?></a>
    <?php if (Auth::check()): ?>
        <nav>
            <a href="<?= BASE_URL ?>/veiculos">Veículos</a>
            <a href="<?= BASE_URL ?>/clientes">Clientes</a>
            <a href="<?= BASE_URL ?>/vendedores">Vendedores</a>
            <span class="user">Olá, <?= e(Auth::user()) ?></span>
            <a class="logout" href="<?= BASE_URL ?>/logout">Sair</a>
        </nav>
    <?php endif; ?>
</header>
<main class="container">
