<?php
require_once 'config.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
// DELETE
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$id = intval($_GET['id']);
		if ($id > 0) {
			$del = $conn->prepare("DELETE FROM funcionario WHERE id_funcionario = ?");
			if (!$del) { die('Prepare failed: ' . $conn->error); }
			$del->bind_param('i', $id);
			if (!$del->execute()) { die('Execute failed: ' . $del->error); }
			$del->close();
		}
		header('Location: index.php?page=listar-funcionario');
		exit;
	}$id = intval($_POST['id'] ?? 0);
if ($nome === '') {
	header('Location: index.php?page=' . ($id ? 'editar-funcionario&id=' . $id : 'cadastrar-funcionario') . '&error=missing_name');
	exit;
}

if ($id > 0) {
	$stmt = $conn->prepare("UPDATE funcionario SET nome_funcionario = ?, telefone_funcionario = ?, email_funcionario = ? WHERE id_funcionario = ?");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('sssi', $nome, $telefone, $email, $id);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-funcionario');
	exit;
} else {
	$stmt = $conn->prepare("INSERT INTO funcionario (nome_funcionario, telefone_funcionario, email_funcionario) VALUES (?, ?, ?)");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('sss', $nome, $telefone, $email);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-funcionario');
	exit;
}
