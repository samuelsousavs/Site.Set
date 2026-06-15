<?php
require_once 'db.php';

$erro = '';
$mensagem = '';
$tipoMensagem = '';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Valores para preencher o formulário após erro
$nome = '';
$descricao = '';
$preco = '';

if ($id <= 0) {
    $erro = 'ID de produto inválido.';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco = $_POST['preco'] ?? '';

        try {
            $pdo = conectar();
            $stmt = $pdo->prepare('UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?');
            $stmt->execute([$nome, $descricao, $preco, $id]);

            header('Location: listar.php?sucesso=1');
            exit;
        } catch (PDOException $e) {
            $mensagem = 'Erro ao atualizar produto.';
            $tipoMensagem = 'error';
        }
    } else {
        // GET: buscar produto para exibir no formulário
        try {
            $pdo = conectar();
            $stmt = $pdo->prepare('SELECT nome, descricao, preco FROM produtos WHERE id = ?');
            $stmt->execute([$id]);
            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$produto) {
                $erro = 'Produto não encontrado.';
            } else {
                $nome = $produto['nome'] ?? '';
                $descricao = $produto['descricao'] ?? '';
                $preco = $produto['preco'] ?? '';
            }
        } catch (PDOException $e) {
            $erro = 'Erro ao carregar produto.';
        }
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
    <title>Editar Produto - Site.set</title>
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
                <h1>Editar Produto</h1>
            </div>

            <?php if ($erro !== ''): ?>
                <div class="alert alert-error"><?= htmlspecialchars($erro) ?></div>
                <div style="margin-bottom: 24px;">
                    <a href="listar.php" class="btn-cancel">Voltar</a>
                </div>
            <?php else: ?>
                <?php if ($mensagem !== ''): ?>
                    <div class="alert alert-<?= htmlspecialchars($tipoMensagem) ?>"><?= htmlspecialchars($mensagem) ?></div>
                <?php endif; ?>

                <form class="crud-form" method="POST" action="edit.php?id=<?= (int)$id ?>">
                    <div class="form-group">
                        <label for="nome">Nome do Produto *</label>
                        <input type="text" id="nome" name="nome" placeholder="Ex: Notebook Dell" required
                            value="<?= htmlspecialchars($nome) ?>">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" placeholder="Descreva o produto...">
                        <?= htmlspecialchars($descricao) ?>
                    </textarea>
                    </div>


                    <div class="form-group">
                        <label for="preco">Preço (R$) *</label>
                        <input type="text" id="preco" name="preco" placeholder="Ex: 1999.90" required
                            value="<?= htmlspecialchars($preco) ?>">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-pen-to-square"></i> Salvar Alterações
                        </button>
                        <a href="listar.php" class="btn-cancel">Cancelar</a>
                    </div>
                </form>
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