<?php

$val = fn(string $c) => e($old[$c] ?? $veiculo[$c] ?? '');
?>
<div class="card">
    <h1><?= $veiculo ? 'Editar' : 'Novo' ?> veículo</h1>

    <form method="POST" action="<?= BASE_URL . e($acao) ?>">
        <label>
            Modelo
            <input type="text" name="modelo" value="<?= $val('modelo') ?>">
            <?php if (isset($erros['modelo'])): ?><span class="erro-campo"><?= e($erros['modelo']) ?></span><?php endif; ?>
        </label>

        <label>
            Marca
            <input type="text" name="marca" value="<?= $val('marca') ?>">
            <?php if (isset($erros['marca'])): ?><span class="erro-campo"><?= e($erros['marca']) ?></span><?php endif; ?>
        </label>

        <label>
            Ano
            <input type="text" name="ano" value="<?= $val('ano') ?>">
            <?php if (isset($erros['ano'])): ?><span class="erro-campo"><?= e($erros['ano']) ?></span><?php endif; ?>
        </label>

        <label>
            Preço
            <input type="text" name="preco" value="<?= $val('preco') ?>" placeholder="Ex.: 55000.00">
            <?php if (isset($erros['preco'])): ?><span class="erro-campo"><?= e($erros['preco']) ?></span><?php endif; ?>
        </label>

        <label>
            Combustível
            <?php $atual = $old['combustivel'] ?? $veiculo['combustivel'] ?? ''; ?>
            <select name="combustivel">
                <option value="">Selecione...</option>
                <?php foreach (['Gasolina','Etanol','Flex','Diesel','Elétrico'] as $op): ?>
                    <option value="<?= $op ?>" <?= $atual === $op ? 'selected' : '' ?>><?= $op ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($erros['combustivel'])): ?><span class="erro-campo"><?= e($erros['combustivel']) ?></span><?php endif; ?>
        </label>

        <div class="form-acoes">
            <button type="submit">Salvar</button>
            <a class="btn-secundario" href="<?= BASE_URL ?>/veiculos">Cancelar</a>
        </div>
    </form>
</div>
