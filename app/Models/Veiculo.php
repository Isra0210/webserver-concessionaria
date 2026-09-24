<?php
namespace Models;

class Veiculo
{
    private const COLECAO = 'veiculos';

    public const REGRAS = [
        'modelo'      => ['required', 'min:2', 'max:60'],
        'marca'       => ['required', 'min:2', 'max:40'],
        'ano'         => ['required', 'int'],
        'preco'       => ['required', 'numeric'],
        'combustivel' => ['required', 'in:Gasolina,Etanol,Flex,Diesel,Elétrico'],
    ];

    public static function todos(): array { return Store::all(self::COLECAO); }
    public static function buscar(int $id): ?array { return Store::find(self::COLECAO, $id); }
    public static function criar(array $dados): int { return Store::insert(self::COLECAO, $dados); }
    public static function atualizar(int $id, array $dados): bool { return Store::update(self::COLECAO, $id, $dados); }
    public static function excluir(int $id): bool { return Store::delete(self::COLECAO, $id); }
}
