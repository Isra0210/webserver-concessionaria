<?php
namespace Models;

class Vendedor
{
    private const COLECAO = 'vendedores';

    public const REGRAS = [
        'nome'      => ['required', 'min:2', 'max:80'],
        'email'     => ['required', 'email'],
        'matricula' => ['required', 'min:2', 'max:20'],
        'comissao'  => ['required', 'numeric'],
    ];

    public static function todos(): array { return Store::all(self::COLECAO); }
    public static function buscar(int $id): ?array { return Store::find(self::COLECAO, $id); }
    public static function criar(array $dados): int { return Store::insert(self::COLECAO, $dados); }
    public static function atualizar(int $id, array $dados): bool { return Store::update(self::COLECAO, $id, $dados); }
    public static function excluir(int $id): bool { return Store::delete(self::COLECAO, $id); }
}
