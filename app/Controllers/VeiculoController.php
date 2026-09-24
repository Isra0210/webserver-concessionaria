<?php
namespace Controllers;

use Core\Controller;
use Core\Auth;
use Core\Session;
use Core\Validator;
use Models\Veiculo;

class VeiculoController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function index(): void
    {
        $this->view('veiculos/index', [
            'veiculos' => Veiculo::todos(),
            'sucesso'  => Session::getFlash('sucesso'),
        ]);
    }

    public function create(): void
    {
        $this->view('veiculos/form', [
            'veiculo' => null,
            'erros'   => Session::getFlash('erros', []),
            'old'     => Session::getFlash('old', []),
            'acao'    => '/veiculos/salvar',
        ]);
    }

    public function store(): void
    {
        $erros = Validator::check($_POST, Veiculo::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/veiculos/novo');
        }

        Veiculo::criar($this->dadosDoForm());
        Session::flash('sucesso', 'Veículo cadastrado com sucesso!');
        $this->redirect('/veiculos');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $veiculo = Veiculo::buscar($id);

        if (!$veiculo) {
            Session::flash('sucesso', 'Veículo não encontrado.');
            $this->redirect('/veiculos');
        }

        $this->view('veiculos/form', [
            'veiculo' => $veiculo,
            'erros'   => Session::getFlash('erros', []),
            'old'     => Session::getFlash('old', $veiculo),
            'acao'    => '/veiculos/atualizar?id=' . $id,
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $erros = Validator::check($_POST, Veiculo::REGRAS);

        if ($erros) {
            Session::flash('erros', $erros);
            Session::flash('old', $_POST);
            $this->redirect('/veiculos/editar?id=' . $id);
        }

        Veiculo::atualizar($id, $this->dadosDoForm());
        Session::flash('sucesso', 'Veículo atualizado com sucesso!');
        $this->redirect('/veiculos');
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        Veiculo::excluir($id);
        Session::flash('sucesso', 'Veículo removido.');
        $this->redirect('/veiculos');
    }

    private function dadosDoForm(): array
    {
        return [
            'modelo'      => $this->input('modelo'),
            'marca'       => $this->input('marca'),
            'ano'         => $this->input('ano'),
            'preco'       => $this->input('preco'),
            'combustivel' => $this->input('combustivel'),
        ];
    }
}
