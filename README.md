# Concessionária de Veículos

## Integrantes

- Israel Rodrigues (RA 2062925)
- (nome e RA do segundo integrante)
- (nome e RA do terceiro integrante)

## Divisão do trabalho

- Israel: (preencher)
- (segundo integrante): (preencher)
- (terceiro integrante): (preencher)

## Sobre o projeto

Aplicação web de uma concessionária feita em PHP com o padrão MVC. Tem
login e o cadastro (criar, listar, editar e excluir) de veículos,
clientes e vendedores. As validações dos formulários são feitas no lado
do servidor, em PHP.

Nesta etapa o sistema não usa banco de dados. Os dados ficam guardados
na sessão enquanto o servidor está rodando.

## O que instalar

O projeto só precisa do PHP 8 (ou mais novo). Não usa banco de dados
nem Composer nesta etapa.

Para instalar o PHP:

- Windows: baixar em https://windows.php.net/download/ ou instalar o
  XAMPP (https://www.apachefriends.org/).
- macOS: `brew install php`
- Linux (Ubuntu/Debian): `sudo apt install php`

Para conferir se instalou certo, rode `php -v`. Deve aparecer algo como
`PHP 8.x.x`.

## Como rodar

Na pasta do projeto, suba o servidor embutido do PHP apontando para a
pasta `public`:

```
php -S localhost:8000 -t public
```

Depois é só abrir http://localhost:8000 no navegador.

Login de teste:

- Usuário: admin
- Senha: 123456

Para parar o servidor, aperte Ctrl + C no terminal.

## Configuração

As configurações ficam no arquivo `config/config.php`. O que pode ser
alterado:

- `APP_NAME`: nome que aparece no topo do site
- `LOGIN_USER`: usuário aceito no login
- `LOGIN_PASS_HASH`: senha do login, guardada como hash (não em texto)
- `SESSION_LIFETIME`: tempo da sessão, em segundos

Para trocar a senha, gere um hash novo e cole em `LOGIN_PASS_HASH`:

```
php -r "echo password_hash('nova_senha', PASSWORD_DEFAULT);"
```

## Observações

- O sistema não usa banco de dados nesta fase. Os dados de exemplo são
  carregados de `app/seed.php` quando a sessão começa.
- Como os dados ficam na sessão, eles são perdidos quando o usuário sai
  ou quando a sessão expira.
