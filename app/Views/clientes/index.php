<div class="cabecalho-lista">
    <h1>Clientes</h1>
    <a class="btn" href="<?= BASE_URL ?>/clientes/novo">+ Novo cliente</a>
</div>

<?php if (!empty($sucesso)): ?>
    <div class="alerta alerta-sucesso"><?= e($sucesso) ?></div>
<?php endif; ?>

<?php if (empty($clientes)): ?>
    <p class="vazio">Nenhum cliente cadastrado ainda.</p>
<?php else: ?>
    <table class="tabela">
        <thead>
            <tr>
                <th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= e($c['nome']) ?></td>
                    <td><?= e($c['email']) ?></td>
                    <td><?= e($c['telefone']) ?></td>
                    <td><?= e($c['cpf']) ?></td>
                    <td class="acoes">
                        <a href="<?= BASE_URL ?>/clientes/editar?id=<?= (int) $c['id'] ?>">Editar</a>
                        <form method="POST" action="<?= BASE_URL ?>/clientes/excluir?id=<?= (int) $c['id'] ?>"
                              onsubmit="return confirm('Remover este cliente?');">
                            <button type="submit" class="link-perigo">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
