<?php
require_once 'config.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');
// DELETE via GET: salvar-cliente.php?action=delete&id=NN
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$id = intval($_GET['id']);
		if ($id > 0) {
			$del = $conn->prepare("DELETE FROM cliente WHERE id_cliente = ?");
			if (!$del) { die('Prepare failed: ' . $conn->error); }
			$del->bind_param('i', $id);
			if (!$del->execute()) { die('Execute failed: ' . $del->error); }
			$del->close();
		}
		header('Location: index.php?page=listar-cliente');
		exit;
	}// INSERT or UPDATE via POST
$id = intval($_POST['id'] ?? 0);
if ($nome === '') {
	header('Location: index.php?page=' . ($id ? 'editar-cliente&id=' . $id : 'cadastrar-cliente') . '&error=missing_name');
	exit;
}

if ($id > 0) {
	$stmt = $conn->prepare("UPDATE cliente SET nome_cliente = ?, email_cliente = ?, telefone_cliente = ?, endereco_cliente = ? WHERE id_cliente = ?");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('ssssi', $nome, $email, $telefone, $endereco, $id);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-cliente');
	exit;
} else {
	$stmt = $conn->prepare("INSERT INTO cliente (nome_cliente, email_cliente, telefone_cliente, endereco_cliente) VALUES (?, ?, ?, ?)");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('ssss', $nome, $email, $telefone, $endereco);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-cliente');
	exit;
}

