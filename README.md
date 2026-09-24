# Concessionária de Veículos

Aluno: Israel Rodrigues
RA: 2062925

## Sobre o projeto

Aplicação web de uma concessionária feita em PHP usando o padrão MVC.
Tem login e o cadastro (criar, listar, editar e excluir) de veículos,
clientes e vendedores. As validações dos formulários são feitas no
lado do servidor, em PHP.

Nesta etapa o sistema não usa banco de dados: os dados ficam guardados
na sessão enquanto o servidor está rodando.

## Como rodar

É preciso ter o PHP 8 instalado (para conferir: `php -v`).

Na pasta do projeto, rode o servidor embutido do PHP apontando para a
pasta `public`:

```
php -S localhost:8000 -t public
```

Depois é só abrir http://localhost:8000 no navegador.

Login de teste:

- Usuário: admin
- Senha: 123456
