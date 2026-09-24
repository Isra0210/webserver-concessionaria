<?php
namespace Core;

abstract class Controller
{
    protected function view(string $nome, array $dados = []): void
    {
        View::render($nome, $dados);
    }

    protected function redirect(string $caminho): void
    {
        header('Location: ' . BASE_URL . $caminho);
        exit;
    }

    protected function input(string $campo, string $padrao = ''): string
    {
        return trim((string) ($_POST[$campo] ?? $padrao));
    }
}
