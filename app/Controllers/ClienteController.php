<?php
namespace Controllers;

use Core\Controller;
use Core\Auth;
use Core\Session;
use Core\Validator;
use Models\Cliente;

class ClienteController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function index(): void
    {
        $this->view('clientes/index', [
            'clientes' => Cliente::todos(),
            'sucesso'  => Session::getFlash('sucesso'),
        ]);
    }

    public function create(): void
    {
        $this->view('clientes/form', [
            'cliente' => null,
            'erros'   => Session::getFlash('erros', []),
            'old'     => Session::getFlash('old', []),
            'acao'    => '/clientes/salvar',
        ]);
    }

    public function store(): void
    {
        $erros = Validator::check($_POST, Cliente::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/clientes/novo');
        }

        Cliente::criar($this->dadosDoForm());
        Session::flash('sucesso', 'Cliente cadastrado com sucesso!');
        $this->redirect('/clientes');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $cliente = Cliente::buscar($id);

        if (!$cliente) {
            Session::flash('sucesso', 'Cliente não encontrado.');
            $this->redirect('/clientes');
        }

        $this->view('clientes/form', [
            'cliente' => $cliente,
            'erros'   => Session::getFlash('erros', []),
            'old'     => Session::getFlash('old', $cliente),
            'acao'    => '/clientes/atualizar?id=' . $id,
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $erros = Validator::check($_POST, Cliente::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/clientes/editar?id=' . $id);
        }

        Cliente::atualizar($id, $this->dadosDoForm());
        Session::flash('sucesso', 'Cliente atualizado com sucesso!');
        $this->redirect('/clientes');
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        Cliente::excluir($id);
        Session::flash('sucesso', 'Cliente removido.');
        $this->redirect('/clientes');
    }

    private function dadosDoForm(): array
    {
        return [
            'nome'     => $this->input('nome'),
            'email'    => $this->input('email'),
            'telefone' => $this->input('telefone'),
            'cpf'      => $this->input('cpf'),
        ];
    }
}
