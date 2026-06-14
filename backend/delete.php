<?php
require_once 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: listar.php');
    exit;
}

try {
    $pdo = conectar();
    $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
    $stmt->execute([':id' => $id]);

    header('Location: listar.php?removido=1');
    exit;
} catch (PDOException $e) {
    header('Location: listar.php');
    exit;
}
