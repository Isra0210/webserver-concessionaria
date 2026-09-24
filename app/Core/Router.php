<?php

namespace Core;

class Router
{
    private array $rotas = ['GET' => [], 'POST' => []];

    public function get(string $caminho, array $acao): void
    {
        $this->rotas['GET'][$caminho] = $acao;
    }

    public function post(string $caminho, array $acao): void
    {
        $this->rotas['POST'][$caminho] = $acao;
    }

    public function dispatch(string $metodo, string $caminho): void
    {
        $caminho = rtrim($caminho, '/') ?: '/';

        $acao = $this->rotas[$metodo][$caminho] ?? null;

        if ($acao === null) {
            http_response_code(404);
            echo '404 — Página não encontrada';
            return;
        }

        [$classe, $metodoControlador] = $acao;
        $controlador = new $classe();
        $controlador->$metodoControlador();
    }
}
