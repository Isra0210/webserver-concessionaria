<?php
namespace Models;

use Core\Session;

class Store
{
    private static function init(string $colecao): void
    {
        if (!Session::has("db.$colecao")) {
            Session::set("db.$colecao", []);
            Session::set("db.$colecao.seq", 1);
        }
    }

    public static function all(string $colecao): array
    {
        self::init($colecao);
        return Session::get("db.$colecao");
    }

    public static function find(string $colecao, int $id): ?array
    {
        return self::all($colecao)[$id] ?? null;
    }

    public static function insert(string $colecao, array $dados): int
    {
        self::init($colecao);
        $registros = Session::get("db.$colecao");
        $id = Session::get("db.$colecao.seq");

        $dados['id'] = $id;
        $registros[$id] = $dados;

        Session::set("db.$colecao", $registros);
        Session::set("db.$colecao.seq", $id + 1);
        return $id;
    }

    public static function update(string $colecao, int $id, array $dados): bool
    {
        $registros = self::all($colecao);
        if (!isset($registros[$id])) {
            return false;
        }
        $dados['id'] = $id;
        $registros[$id] = $dados;
        Session::set("db.$colecao", $registros);
        return true;
    }

    public static function delete(string $colecao, int $id): bool
    {
        $registros = self::all($colecao);
        if (!isset($registros[$id])) {
            return false;
        }
        unset($registros[$id]);
        Session::set("db.$colecao", $registros);
        return true;
    }
}
