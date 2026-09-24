<?php if (!empty($sucesso)): ?>
    <div class="alerta alerta-sucesso"><?= e($sucesso) ?></div>
<?php endif; ?>

<h1>Painel</h1>
<p>Escolha um cadastro para gerenciar:</p>

<div class="grid-cards">
    <a class="card card-link" href="<?= BASE_URL ?>/veiculos">
        <h2>Veículos</h2>
        <p>Cadastro e listagem de veículos do pátio.</p>
    </a>
    <a class="card card-link" href="<?= BASE_URL ?>/clientes">
        <h2>Clientes</h2>
        <p>Cadastro e listagem de clientes.</p>
    </a>
    <a class="card card-link" href="<?= BASE_URL ?>/vendedores">
        <h2>Vendedores</h2>
        <p>Cadastro e listagem de vendedores.</p>
    </a>
</div>
