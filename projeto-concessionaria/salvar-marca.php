<?php
require_once 'config.php';

$nome = trim($_POST['nome'] ?? '');
$pais = trim($_POST['pais_origem'] ?? '');
// DELETE
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$id = intval($_GET['id']);
		if ($id > 0) {
			$del = $conn->prepare("DELETE FROM marca WHERE id_marca = ?");
			if (!$del) { die('Prepare failed: ' . $conn->error); }
			$del->bind_param('i', $id);
			if (!$del->execute()) { die('Execute failed: ' . $del->error); }
			$del->close();
		}
		header('Location: index.php?page=listar-marca');
		exit;
	}$id = intval($_POST['id'] ?? 0);
if ($nome === '') {
	header('Location: index.php?page=' . ($id ? 'editar-marca&id=' . $id : 'cadastrar-marca') . '&error=missing_name');
	exit;
}

if ($id > 0) {
	$stmt = $conn->prepare("UPDATE marca SET nome_marca = ? WHERE id_marca = ?");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('si', $nome, $id);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-marca');
	exit;
} else {
	$stmt = $conn->prepare("INSERT INTO marca (nome_marca) VALUES (?)");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('s', $nome);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-marca');
	exit;
}
