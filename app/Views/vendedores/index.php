<div class="cabecalho-lista">
    <h1>Vendedores</h1>
    <a class="btn" href="<?= BASE_URL ?>/vendedores/novo">+ Novo vendedor</a>
</div>

<?php if (!empty($sucesso)): ?>
    <div class="alerta alerta-sucesso"><?= e($sucesso) ?></div>
<?php endif; ?>

<?php if (empty($vendedores)): ?>
    <p class="vazio">Nenhum vendedor cadastrado ainda.</p>
<?php else: ?>
    <table class="tabela">
        <thead>
            <tr>
                <th>Nome</th><th>E-mail</th><th>Matrícula</th><th>Comissão (%)</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $v): ?>
                <tr>
                    <td><?= e($v['nome']) ?></td>
                    <td><?= e($v['email']) ?></td>
                    <td><?= e($v['matricula']) ?></td>
                    <td><?= e(number_format((float) $v['comissao'], 2, ',', '.')) ?></td>
                    <td class="acoes">
                        <a href="<?= BASE_URL ?>/vendedores/editar?id=<?= (int) $v['id'] ?>">Editar</a>
                        <form method="POST" action="<?= BASE_URL ?>/vendedores/excluir?id=<?= (int) $v['id'] ?>"
                              onsubmit="return confirm('Remover este vendedor?');">
                            <button type="submit" class="link-perigo">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
