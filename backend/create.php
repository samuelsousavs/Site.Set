<?php
require_once 'db.php';

$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    try {
        $pdo = conectar();
        $stmt = $pdo->prepare('INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)');
        $stmt->execute([$nome, $descricao, $preco]);
        header('Location: listar.php');
        exit;
    } catch (PDOException $e) {
        $mensagem = 'Erro ao cadastrar produto. Verifique se a tabela foi criada no banco de dados.';
        $tipoMensagem = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style/index.css">
    <link rel="stylesheet" href="../frontend/style/crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Cadastrar Produto - Site.set</title>
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
                <h1>Cadastrar Produto</h1>
            </div>

            <?php if ($mensagem !== ''): ?>
                <div class="alert alert-<?= htmlspecialchars($tipoMensagem) ?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form class="crud-form" method="POST" action="create.php">
                <div class="form-group">
                    <label for="nome">Nome do Produto *</label>
                    <input type="text" id="nome" name="nome" placeholder="Ex: Notebook Dell" required
                        value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" placeholder="Descreva o produto..."><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$) *</label>
                    <input type="text" id="preco" name="preco" placeholder="Ex: 1999.90" required
                        value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-plus"></i> Cadastrar
                    </button>
                    <a href="listar.php" class="btn-cancel">Cancelar</a>
                </div>
            </form>
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
