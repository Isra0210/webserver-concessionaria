<?php

namespace Core;

class View
{
    public static function render(string $nome, array $dados = []): void
    {
        extract($dados);

        $arquivo = ROOT . '/app/Views/' . $nome . '.php';
        if (!is_file($arquivo)) {
            http_response_code(500);
            echo "View não encontrada: {$nome}";
            return;
        }

        require ROOT . '/app/Views/layout/header.php';
        require $arquivo;
        require ROOT . '/app/Views/layout/footer.php';
    }
}
