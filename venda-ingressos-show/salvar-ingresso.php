<?php
require_once 'config.php';

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $del = $conexao->prepare("DELETE FROM ingressos WHERE id_ingresso = ?");
        if (!$del) { die('Prepare failed: ' . $conexao->error); }
        $del->bind_param('i', $id);
        if (!$del->execute()) { die('Execute failed: ' . $del->error); }
        $del->close();
    }
    header('Location: index.php?page=listar-ingresso');
    exit;
}

$show_id = intval($_POST['show_id_show'] ?? 0);
$tipo_id = intval($_POST['tipo_ingresso_id_tipo'] ?? 0);
$preco = floatval($_POST['preco'] ?? 0);
$qtd_total = intval($_POST['quantidade_total'] ?? 0);
$qtd_disp = intval($_POST['quantidade_disponivel'] ?? 0);
$id = intval($_POST['id'] ?? 0);

if ($show_id <= 0 || $tipo_id <= 0 || $preco <= 0 || $qtd_total <= 0) {
    header('Location: index.php?page=' . ($id ? 'editar-ingresso&id=' . $id : 'cadastrar-ingresso') . '&error=invalid_fields');
    exit;
}

if ($id > 0) {
    $stmt = $conexao->prepare("UPDATE ingressos SET show_id_show = ?, tipo_ingresso_id_tipo = ?, preco = ?, quantidade_total = ?, quantidade_disponivel = ? WHERE id_ingresso = ?");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('iidiii', $show_id, $tipo_id, $preco, $qtd_total, $qtd_disp, $id);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-ingresso');
    exit;
} else {
    $stmt = $conexao->prepare("INSERT INTO ingressos (show_id_show, tipo_ingresso_id_tipo, preco, quantidade_total, quantidade_disponivel) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('iidii', $show_id, $tipo_id, $preco, $qtd_total, $qtd_disp);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-ingresso');
    exit;
}
