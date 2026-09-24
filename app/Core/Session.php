<?php

namespace Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => SESSION_LIFETIME,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
        }
    }

    public static function set(string $chave, mixed $valor): void
    {
        $_SESSION[$chave] = $valor;
    }

    public static function get(string $chave, mixed $padrao = null): mixed
    {
        return $_SESSION[$chave] ?? $padrao;
    }

    public static function has(string $chave): bool
    {
        return isset($_SESSION[$chave]);
    }

    public static function remove(string $chave): void
    {
        unset($_SESSION[$chave]);
    }

    public static function flash(string $chave, mixed $valor): void
    {
        $_SESSION['_flash'][$chave] = $valor;
    }

    public static function getFlash(string $chave, mixed $padrao = null): mixed
    {
        $valor = $_SESSION['_flash'][$chave] ?? $padrao;
        unset($_SESSION['_flash'][$chave]);
        return $valor;
    }
}
