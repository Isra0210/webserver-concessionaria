<?php

use Core\Session;
use Models\Veiculo;
use Models\Cliente;
use Models\Vendedor;

if (Session::get('seeded') === true) {
    return;
}

foreach ([
    ['modelo' => 'Onix',    'marca' => 'Chevrolet', 'ano' => '2022', 'preco' => '78000',  'combustivel' => 'Flex'],
    ['modelo' => 'Corolla', 'marca' => 'Toyota',    'ano' => '2023', 'preco' => '145000', 'combustivel' => 'Flex'],
    ['modelo' => 'Kwid',    'marca' => 'Renault',   'ano' => '2021', 'preco' => '62000',  'combustivel' => 'Gasolina'],
] as $v) {
    Veiculo::criar($v);
}

foreach ([
    ['nome' => 'Ana Souza',   'email' => 'ana@email.com',   'telefone' => '(51) 99999-1111', 'cpf' => '12345678901'],
    ['nome' => 'Bruno Lima',  'email' => 'bruno@email.com', 'telefone' => '(51) 98888-2222', 'cpf' => '98765432100'],
] as $c) {
    Cliente::criar($c);
}

foreach ([
    ['nome' => 'Carlos Dias',  'email' => 'carlos@concessionaria.com', 'matricula' => 'V001', 'comissao' => '3.5'],
    ['nome' => 'Daniela Rocha','email' => 'daniela@concessionaria.com','matricula' => 'V002', 'comissao' => '4.0'],
] as $vend) {
    Vendedor::criar($vend);
}

Session::set('seeded', true);
