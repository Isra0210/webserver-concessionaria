<?php

namespace Controllers;

use Core\Controller;
use Core\Auth;
use Core\Session;
use Core\Validator;
use Models\Vendedor;

class VendedorController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function index(): void
    {
        $this->view('vendedores/index', [
            'vendedores' => Vendedor::todos(),
            'sucesso'    => Session::getFlash('sucesso'),
        ]);
    }

    public function create(): void
    {
        $this->view('vendedores/form', [
            'vendedor' => null,
            'erros'    => Session::getFlash('erros', []),
            'old'      => Session::getFlash('old', []),
            'acao'     => '/vendedores/salvar',
        ]);
    }

    public function store(): void
    {
        $erros = Validator::check($_POST, Vendedor::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/vendedores/novo');
        }

        Vendedor::criar($this->dadosDoForm());
        Session::flash('sucesso', 'Vendedor cadastrado com sucesso!');
        $this->redirect('/vendedores');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $vendedor = Vendedor::buscar($id);

        if (!$vendedor) {
            Session::flash('sucesso', 'Vendedor não encontrado.');
            $this->redirect('/vendedores');
        }

        $this->view('vendedores/form', [
            'vendedor' => $vendedor,
            'erros'    => Session::getFlash('erros', []),
            'old'      => Session::getFlash('old', $vendedor),
            'acao'     => '/vendedores/atualizar?id=' . $id,
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $erros = Validator::check($_POST, Vendedor::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/vendedores/editar?id=' . $id);
        }

        Vendedor::atualizar($id, $this->dadosDoForm());
        Session::flash('sucesso', 'Vendedor atualizado com sucesso!');
        $this->redirect('/vendedores');
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        Vendedor::excluir($id);
        Session::flash('sucesso', 'Vendedor removido.');
        $this->redirect('/vendedores');
    }

    private function dadosDoForm(): array
    {
        return [
            'nome'      => $this->input('nome'),
            'email'     => $this->input('email'),
            'matricula' => $this->input('matricula'),
            'comissao'  => $this->input('comissao'),
        ];
    }
}
