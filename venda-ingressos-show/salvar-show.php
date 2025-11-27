<?php
require_once 'config.php';

// DELETE via GET: salvar-show.php?action=delete&id=NN
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        $del = $conexao->prepare("DELETE FROM shows WHERE id_show = ?");
        if (!$del) { die('Prepare failed: ' . $conexao->error); }
        $del->bind_param('i', $id);
        if (!$del->execute()) { die('Execute failed: ' . $del->error); }
        $del->close();
    }
    header('Location: index.php?page=listar-show');
    exit;
}

// INSERT or UPDATE via POST
$nome = trim($_POST['nome_show'] ?? '');
$data = trim($_POST['data_show'] ?? '');
$hora = trim($_POST['hora_show'] ?? '');
$local = trim($_POST['local_show'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$id = intval($_POST['id'] ?? 0);

if ($nome === '' || $data === '') {
    header('Location: index.php?page=' . ($id ? 'editar-show&id=' . $id : 'cadastrar-show') . '&error=missing_fields');
    exit;
}

if ($id > 0) {
    $stmt = $conexao->prepare("UPDATE shows SET nome_show = ?, data_show = ?, hora_show = ?, local_show = ?, descricao = ? WHERE id_show = ?");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('sssssi', $nome, $data, $hora, $local, $descricao, $id);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-show');
    exit;
} else {
    $stmt = $conexao->prepare("INSERT INTO shows (nome_show, data_show, hora_show, local_show, descricao) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) { die('Prepare failed: ' . $conexao->error); }
    $stmt->bind_param('sssss', $nome, $data, $hora, $local, $descricao);
    if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
    $stmt->close();
    header('Location: index.php?page=listar-show');
    exit;
}
