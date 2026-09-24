<?php

namespace Models;

class Cliente
{
    private const COLECAO = 'clientes';

    public const REGRAS = [
        'nome'     => ['required', 'min:2', 'max:80', 'nome'],
        'email'    => ['required', 'email'],
        'telefone' => ['required', 'telefone'],
        'cpf'      => ['required', 'cpf'],
    ];

    public static function todos(): array
    {
        return Store::all(self::COLECAO);
    }
    public static function buscar(int $id): ?array
    {
        return Store::find(self::COLECAO, $id);
    }
    public static function criar(array $dados): int
    {
        return Store::insert(self::COLECAO, $dados);
    }
    public static function atualizar(int $id, array $dados): bool
    {
        return Store::update(self::COLECAO, $id, $dados);
    }
    public static function excluir(int $id): bool
    {
        return Store::delete(self::COLECAO, $id);
    }
}
