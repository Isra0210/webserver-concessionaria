<?php
namespace Controllers;

use Core\Controller;
use Core\Auth;
use Core\Session;
use Core\Validator;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            $this->redirect('/');
        }
        $this->view('auth/login', [
            'erro' => Session::getFlash('erro'),
            'old'  => Session::getFlash('old', []),
        ]);
    }

    public function login(): void
    {
        $erros = Validator::check($_POST, [
            'usuario' => ['required'],
            'senha'   => ['required'],
        ]);

        $usuario = $this->input('usuario');

        if ($erros || !Auth::attempt($usuario, $this->input('senha'))) {
            Session::flash('erro', 'Usuário ou senha inválidos.');
            Session::flash('old', ['usuario' => $usuario]);
            $this->redirect('/login');
        }

        Session::flash('sucesso', 'Bem-vindo, ' . $usuario . '!');
        $this->redirect('/');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/login');
    }

    public function home(): void
    {
        Auth::requireLogin();
        $this->view('home', [
            'sucesso' => Session::getFlash('sucesso'),
        ]);
    }
}
