<?php

use Core\Router;
use Controllers\AuthController;
use Controllers\VeiculoController;
use Controllers\ClienteController;
use Controllers\VendedorController;

$router->get('/login',  [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/', [AuthController::class, 'home']);

$router->get('/veiculos',            [VeiculoController::class, 'index']);
$router->get('/veiculos/novo',       [VeiculoController::class, 'create']);
$router->post('/veiculos/salvar',    [VeiculoController::class, 'store']);
$router->get('/veiculos/editar',     [VeiculoController::class, 'edit']);
$router->post('/veiculos/atualizar', [VeiculoController::class, 'update']);
$router->post('/veiculos/excluir',   [VeiculoController::class, 'destroy']);

$router->get('/clientes',            [ClienteController::class, 'index']);
$router->get('/clientes/novo',       [ClienteController::class, 'create']);
$router->post('/clientes/salvar',    [ClienteController::class, 'store']);
$router->get('/clientes/editar',     [ClienteController::class, 'edit']);
$router->post('/clientes/atualizar', [ClienteController::class, 'update']);
$router->post('/clientes/excluir',   [ClienteController::class, 'destroy']);

$router->get('/vendedores',            [VendedorController::class, 'index']);
$router->get('/vendedores/novo',       [VendedorController::class, 'create']);
$router->post('/vendedores/salvar',    [VendedorController::class, 'store']);
$router->get('/vendedores/editar',     [VendedorController::class, 'edit']);
$router->post('/vendedores/atualizar', [VendedorController::class, 'update']);
$router->post('/vendedores/excluir',   [VendedorController::class, 'destroy']);
