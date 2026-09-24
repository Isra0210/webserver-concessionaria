<?php

namespace Core;

class Auth
{
    public static function attempt(string $usuario, string $senha): bool
    {
        $usuarioOk = hash_equals(LOGIN_USER, $usuario);
        $senhaOk   = password_verify($senha, LOGIN_PASS_HASH);

        if ($usuarioOk && $senhaOk) {
            // gera um novo ID de sessão no login para evitar session fixation
            session_regenerate_id(true);
            Session::set('logado', true);
            Session::set('usuario', $usuario);
            Session::set('ultima_atividade', time());
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
        // impede o navegador de guardar páginas protegidas em cache
        // (senão o botão "voltar" mostraria a página mesmo após o logout)
        self::naoArmazenarEmCache();

        if (!self::check()) {
            Session::flash('erro', 'Faça login para acessar esta área.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (self::sessaoExpirada()) {
            // limpa os dados de login, mas mantém a sessão viva para levar a mensagem
            Session::remove('logado');
            Session::remove('usuario');
            Session::remove('ultima_atividade');
            Session::flash('erro', 'Sua sessão expirou por inatividade. Faça login novamente.');
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // renova o contador de inatividade a cada requisição válida
        Session::set('ultima_atividade', time());
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }

    private static function sessaoExpirada(): bool
    {
        $ultima = Session::get('ultima_atividade');
        if ($ultima === null) {
            return false;
        }
        return (time() - (int) $ultima) > SESSION_LIFETIME;
    }

    private static function naoArmazenarEmCache(): void
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
    }
}
