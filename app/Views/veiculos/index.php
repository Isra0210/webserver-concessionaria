<div class="cabecalho-lista">
    <h1>Veículos</h1>
    <a class="btn" href="<?= BASE_URL ?>/veiculos/novo">+ Novo veículo</a>
</div>

<?php if (!empty($sucesso)): ?>
    <div class="alerta alerta-sucesso"><?= e($sucesso) ?></div>
<?php endif; ?>

<?php if (empty($veiculos)): ?>
    <p class="vazio">Nenhum veículo cadastrado ainda.</p>
<?php else: ?>
    <table class="tabela">
        <thead>
            <tr>
                <th>Modelo</th><th>Marca</th><th>Ano</th><th>Preço</th><th>Combustível</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $v): ?>
                <tr>
                    <td><?= e($v['modelo']) ?></td>
                    <td><?= e($v['marca']) ?></td>
                    <td><?= e($v['ano']) ?></td>
                    <td>R$ <?= e(number_format((float) $v['preco'], 2, ',', '.')) ?></td>
                    <td><?= e($v['combustivel']) ?></td>
                    <td class="acoes">
                        <a href="<?= BASE_URL ?>/veiculos/editar?id=<?= (int) $v['id'] ?>">Editar</a>
                        <form method="POST" action="<?= BASE_URL ?>/veiculos/excluir?id=<?= (int) $v['id'] ?>"
                              onsubmit="return confirm('Remover este veículo?');">
                            <button type="submit" class="link-perigo">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
