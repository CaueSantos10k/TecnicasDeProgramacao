<?php
require_once 'config.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $del = $conexao->prepare("DELETE FROM vendas WHERE id_venda = ?");
        if (!$del) { die('Prepare failed: ' . $conexao->error); }
        $del->bind_param('i', $id);
        if (!$del->execute()) { die('Execute failed: ' . $del->error); }
        $del->close();
    }
    header('Location: index.php?page=listar-venda');
    exit;
}

$cliente_id = intval($_POST['cliente_id_cliente'] ?? 0);
$ingresso_id = intval($_POST['ingresso_id_ingresso'] ?? 0);
$quantidade = intval($_POST['quantidade'] ?? 0);
$valor_total = floatval(str_replace(',', '.', $_POST['valor_total'] ?? 0));
$data_venda = trim($_POST['data_venda'] ?? '');
$id = intval($_POST['id'] ?? 0);

if ($cliente_id <= 0 || $ingresso_id <= 0 || $quantidade <= 0) {
    header('Location: index.php?page=' . ($id ? 'editar-venda&id=' . $id : 'cadastrar-venda') . '&error=invalid_fields');
    exit;
}

if ($id > 0) {
    $stmt = $conexao->prepare("UPDATE vendas SET cliente_id_cliente = ?, ingresso_id_ingresso = ?, quantidade = ?, valor_total = ?, data_venda = ? WHERE id_venda = ?");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('iiidsi', $cliente_id, $ingresso_id, $quantidade, $valor_total, $data_venda, $id);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-venda');
    exit;
} else {
    $stmt = $conexao->prepare("INSERT INTO vendas (cliente_id_cliente, ingresso_id_ingresso, quantidade, valor_total, data_venda) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('iiids', $cliente_id, $ingresso_id, $quantidade, $valor_total, $data_venda);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-venda');
    exit;
}
