<?php
require_once 'config.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $del = $conexao->prepare("DELETE FROM clientes WHERE id_cliente = ?");
        if (!$del) { die('Prepare failed: ' . $conexao->error); }
        $del->bind_param('i', $id);
        if (!$del->execute()) { die('Execute failed: ' . $del->error); }
        $del->close();
    }
    header('Location: index.php?page=listar-cliente');
    exit;
}

$nome = trim($_POST['nome_cliente'] ?? '');
$email = trim($_POST['email_cliente'] ?? '');
$telefone = trim($_POST['telefone_cliente'] ?? '');
$id = intval($_POST['id'] ?? 0);

if ($nome === '') {
    header('Location: index.php?page=' . ($id ? 'editar-cliente&id=' . $id : 'cadastrar-cliente') . '&error=missing_name');
    exit;
}

if ($id > 0) {
    $stmt = $conexao->prepare("UPDATE clientes SET nome_cliente = ?, email_cliente = ?, telefone_cliente = ? WHERE id_cliente = ?");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('sssi', $nome, $email, $telefone, $id);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-cliente');
    exit;
} else {
    $stmt = $conexao->prepare("INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente) VALUES (?, ?, ?)");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('sss', $nome, $email, $telefone);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-cliente');
    exit;
}
