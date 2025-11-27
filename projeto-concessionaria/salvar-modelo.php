<?php
require_once 'config.php';

$nome = trim($_POST['nome'] ?? '');
$ano = trim($_POST['ano'] ?? '');
$marca_id = intval($_POST['marca_id'] ?? 0);
// DELETE
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$id = intval($_GET['id']);
		if ($id > 0) {
			$del = $conn->prepare("DELETE FROM modelo WHERE id_modelo = ?");
			if (!$del) { die('Prepare failed: ' . $conn->error); }
			$del->bind_param('i', $id);
			if (!$del->execute()) { die('Execute failed: ' . $del->error); }
			$del->close();
		}
		header('Location: index.php?page=listar-modelo');
		exit;
	}$id = intval($_POST['id'] ?? 0);
if ($nome === '' || $marca_id <= 0) {
	header('Location: index.php?page=' . ($id ? 'editar-modelo&id=' . $id : 'cadastrar-modelo') . '&error=missing_fields');
	exit;
}

if ($id > 0) {
	if ($ano === '') {
		$stmt = $conn->prepare("UPDATE modelo SET nome_modelo = ?, ano_modelo = NULL, marca_id_marca = ? WHERE id_modelo = ?");
		if (!$stmt) { die('Prepare failed: ' . $conn->error); }
		$stmt->bind_param('sii', $nome, $marca_id, $id);
	} else {
		$ano_int = intval($ano);
		$stmt = $conn->prepare("UPDATE modelo SET nome_modelo = ?, ano_modelo = ?, marca_id_marca = ? WHERE id_modelo = ?");
		if (!$stmt) { die('Prepare failed: ' . $conn->error); }
		$stmt->bind_param('siii', $nome, $ano_int, $marca_id, $id);
	}
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-modelo');
	exit;
} else {
	if ($ano === '') {
		$stmt = $conn->prepare("INSERT INTO modelo (nome_modelo, ano_modelo, marca_id_marca) VALUES (?, NULL, ?)");
		if (!$stmt) { die('Prepare failed: ' . $conn->error); }
		$stmt->bind_param('si', $nome, $marca_id);
	} else {
		$ano_int = intval($ano);
		$stmt = $conn->prepare("INSERT INTO modelo (nome_modelo, ano_modelo, marca_id_marca) VALUES (?, ?, ?)");
		if (!$stmt) { die('Prepare failed: ' . $conn->error); }
		$stmt->bind_param('sii', $nome, $ano_int, $marca_id);
	}
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-modelo');
	exit;
}
