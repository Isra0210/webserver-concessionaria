<?php

$val = fn(string $c) => e($old[$c] ?? $cliente[$c] ?? '');
?>
<div class="card">
    <h1><?= $cliente ? 'Editar' : 'Novo' ?> cliente</h1>

    <form method="POST" action="<?= BASE_URL . e($acao) ?>">
        <label>
            Nome
            <input type="text" name="nome" value="<?= $val('nome') ?>">
            <?php if (isset($erros['nome'])): ?><span class="erro-campo"><?= e($erros['nome']) ?></span><?php endif; ?>
        </label>

        <label>
            E-mail
            <input type="text" name="email" value="<?= $val('email') ?>">
            <?php if (isset($erros['email'])): ?><span class="erro-campo"><?= e($erros['email']) ?></span><?php endif; ?>
        </label>

        <label>
            Telefone
            <input type="text" name="telefone" value="<?= $val('telefone') ?>" placeholder="(00) 00000-0000">
            <?php if (isset($erros['telefone'])): ?><span class="erro-campo"><?= e($erros['telefone']) ?></span><?php endif; ?>
        </label>

        <label>
            CPF
            <input type="text" name="cpf" value="<?= $val('cpf') ?>" placeholder="Somente números">
            <?php if (isset($erros['cpf'])): ?><span class="erro-campo"><?= e($erros['cpf']) ?></span><?php endif; ?>
        </label>

        <div class="form-acoes">
            <button type="submit">Salvar</button>
            <a class="btn-secundario" href="<?= BASE_URL ?>/clientes">Cancelar</a>
        </div>
    </form>
</div>
