<?php
namespace Core;

class Auth
{
    public static function attempt(string $usuario, string $senha): bool
    {
        $usuarioOk = hash_equals(LOGIN_USER, $usuario);
        $senhaOk   = password_verify($senha, LOGIN_PASS_HASH);

        if ($usuarioOk && $senhaOk) {
            Session::set('logado', true);
            Session::set('usuario', $usuario);
            return true;
        }
        return false;
    }

    public static function check(): bool
    {
        return Session::get('logado') === true;
    }

    public static function user(): ?string
    {
        return Session::get('usuario');
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            Session::flash('erro', 'Faça login para acessar esta área.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}
