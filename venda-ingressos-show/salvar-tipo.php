<?php
require_once 'config.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $del = $conexao->prepare("DELETE FROM tipos_ingresso WHERE id_tipo = ?");
        if (!$del) { die('Prepare failed: ' . $conexao->error); }
        $del->bind_param('i', $id);
        if (!$del->execute()) { die('Execute failed: ' . $del->error); }
        $del->close();
    }
    header('Location: index.php?page=listar-tipo');
    exit;
}

$nome = trim($_POST['nome_tipo'] ?? '');
$descricao = trim($_POST['descricao_tipo'] ?? '');
$id = intval($_POST['id'] ?? 0);

if ($nome === '') {
    header('Location: index.php?page=' . ($id ? 'editar-tipo&id=' . $id : 'cadastrar-tipo') . '&error=missing_name');
    exit;
}

if ($id > 0) {
    $stmt = $conexao->prepare("UPDATE tipos_ingresso SET nome_tipo = ?, descricao_tipo = ? WHERE id_tipo = ?");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('ssi', $nome, $descricao, $id);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-tipo');
    exit;
} else {
    $stmt = $conexao->prepare("INSERT INTO tipos_ingresso (nome_tipo, descricao_tipo) VALUES (?, ?)");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('ss', $nome, $descricao);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-tipo');
    exit;
}
