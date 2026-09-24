<?php

namespace Core;

class Validator
{
    public static function check(array $dados, array $regras): array
    {
        $erros = [];

        foreach ($regras as $campo => $listaRegras) {
            $valor = trim((string) ($dados[$campo] ?? ''));

            foreach ($listaRegras as $regra) {
                [$nome, $parametro] = array_pad(explode(':', $regra, 2), 2, null);

                $mensagem = self::aplicar($nome, $valor, $parametro);
                if ($mensagem !== null) {
                    $erros[$campo] = $mensagem;
                    break;
                }
            }
        }

        return $erros;
    }

    private static function aplicar(string $regra, string $valor, ?string $parametro): ?string
    {
        return match ($regra) {
            'required' => $valor === '' ? 'Campo obrigatório.' : null,
            'min'      => mb_strlen($valor) < (int) $parametro ? "Mínimo de {$parametro} caracteres." : null,
            'max'      => mb_strlen($valor) > (int) $parametro ? "Máximo de {$parametro} caracteres." : null,
            'int'      => ($valor !== '' && !ctype_digit($valor)) ? 'Informe um número inteiro.' : null,
            'numeric'  => ($valor !== '' && !is_numeric($valor)) ? 'Informe um número.' : null,
            'min_val'  => ($valor !== '' && is_numeric($valor) && (float) $valor < (float) $parametro) ? "O valor mínimo é {$parametro}." : null,
            'max_val'  => ($valor !== '' && is_numeric($valor) && (float) $valor > (float) $parametro) ? "O valor máximo é {$parametro}." : null,
            'email'    => ($valor !== '' && !filter_var($valor, FILTER_VALIDATE_EMAIL)) ? 'E-mail inválido.' : null,
            'in'       => ($valor !== '' && !in_array($valor, explode(',', (string) $parametro), true)) ? 'Valor não permitido.' : null,
            'cpf'      => ($valor !== '' && !self::validarCpf($valor)) ? 'CPF inválido.' : null,
            'telefone' => ($valor !== '' && !preg_match('/^\d{10,11}$/', preg_replace('/\D/', '', $valor))) ? 'Telefone inválido. Use DDD + número.' : null,
            'ano'      => self::validarAno($valor),
            default    => null,
        };
    }

    private static function validarAno(string $valor): ?string
    {
        if ($valor === '') {
            return null;
        }
        if (!ctype_digit($valor)) {
            return 'Informe um ano válido.';
        }
        $ano    = (int) $valor;
        $maximo = (int) date('Y') + 1;
        if ($ano < 1900 || $ano > $maximo) {
            return "O ano deve estar entre 1900 e {$maximo}.";
        }
        return null;
    }

    private static function validarCpf(string $valor): bool
    {
        $cpf = preg_replace('/\D/', '', $valor);

        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += (int) $cpf[$i] * (($t + 1) - $i);
            }
            $digito = (10 * $soma) % 11 % 10;
            if ((int) $cpf[$t] !== $digito) {
                return false;
            }
        }

        return true;
    }
}
