<?php
require_once 'db.php';

$produtos = [];
$erro = '';

try {
    $pdo = conectar();
    $stmt = $pdo->query('SELECT id, nome, descricao, preco, created_at FROM produtos ORDER BY id DESC');
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $erro = 'Erro ao listar produtos. Execute o script database.sql para criar a tabela.';
}

$sucesso = isset($_GET['sucesso']);
$removido = isset($_GET['removido']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style/index.css">
    <link rel="stylesheet" href="../frontend/style/crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Listar Produtos - Site.set</title>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../frontend/index.php">
                <img src="../frontend/img/Brand-Logo.png" alt="Site.set">
            </a>
        </div>
        <div class="items">
            <a href="listar.php" class="link-default">Listar Produtos</a>
            <a href="create.php" class="btn-default">Cadastrar Produto</a>
        </div>
    </nav>

    <main>
        <div class="crud-container">
            <div class="crud-header">
                <h1>Produtos Cadastrados</h1>
                <a href="create.php" class="btn-submit">
                    <i class="fa-solid fa-plus"></i> Novo Produto
                </a>
            </div>

            <?php if ($sucesso): ?>
                <div class="alert alert-success">Produto cadastrado com sucesso!</div>
            <?php endif; ?>

            <?php if ($removido): ?>
                <div class="alert alert-success">Produto removido com sucesso!</div>
            <?php endif; ?>

            <?php if ($erro !== ''): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
            <?php elseif (count($produtos) === 0): ?>
                <div class="empty-state">
                    <p>Nenhum produto cadastrado ainda.</p>
                    <a href="create.php" class="btn-submit">Cadastrar primeiro produto</a>
                </div>
            <?php else: ?>
                <table class="produtos-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto['id']) ?></td>
                                <td><?= htmlspecialchars($produto['nome']) ?></td>
                                <td><?= htmlspecialchars($produto['descricao'] ?? '-') ?></td>
                                <td class="preco">R$ <?= number_format((float) $produto['preco'], 2, ',', '.') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($produto['created_at'])) ?></td>
                                <td class="acoes-cell">
                                    <div class="acoes">
                                        <a href="edit.php?id=<?= (int) $produto['id'] ?>"
                                            class="btn-cancel">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                        <a href="delete.php?id=<?= (int) $produto['id'] ?>"
                                            class="btn-delete"
                                            onclick="return confirm('Deseja realmente remover este produto?')">
                                            <i class="fa-solid fa-trash"></i> Remover
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="logo">
            <img src="../frontend/img/Brand-Logo.png" alt="">
        </div>
        <div class="items">
            Desenvolvido por: Samuel de Sousa Carneiro
        </div>
    </footer>
</body>

</html>