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
            'email'    => ($valor !== '' && !filter_var($valor, FILTER_VALIDATE_EMAIL)) ? 'E-mail inválido.' : null,
            'in'       => ($valor !== '' && !in_array($valor, explode(',', (string) $parametro), true)) ? 'Valor não permitido.' : null,
            default    => null,
        };
    }
}
