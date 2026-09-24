<div class="card card-estreito">
    <h1>Entrar</h1>

    <?php if (!empty($erro)): ?>
        <div class="alerta alerta-erro"><?= e($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/login">
        <label>
            Usuário
            <input type="text" name="usuario" value="<?= e($old['usuario'] ?? '') ?>" autofocus>
        </label>
        <label>
            Senha
            <input type="password" name="senha">
        </label>
        <button type="submit">Entrar</button>
    </form>

    <p class="dica">Usuário de teste: <code>admin</code> / senha <code>123456</code></p>
</div>
