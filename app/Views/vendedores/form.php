<?php

$val = fn(string $c) => e($old[$c] ?? $vendedor[$c] ?? '');
?>
<div class="card">
    <h1><?= $vendedor ? 'Editar' : 'Novo' ?> vendedor</h1>

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
            Matrícula
            <input type="text" name="matricula" value="<?= $val('matricula') ?>">
            <?php if (isset($erros['matricula'])): ?><span class="erro-campo"><?= e($erros['matricula']) ?></span><?php endif; ?>
        </label>

        <label>
            Comissão (%)
            <input type="text" name="comissao" value="<?= $val('comissao') ?>" placeholder="Ex.: 3.5">
            <?php if (isset($erros['comissao'])): ?><span class="erro-campo"><?= e($erros['comissao']) ?></span><?php endif; ?>
        </label>

        <div class="form-acoes">
            <button type="submit">Salvar</button>
            <a class="btn-secundario" href="<?= BASE_URL ?>/vendedores">Cancelar</a>
        </div>
    </form>
</div>
