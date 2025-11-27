<?php
require_once 'config.php';

$cliente_id = intval($_POST['cliente_id'] ?? 0);
$funcionario_id = intval($_POST['funcionario_id'] ?? 0);
$modelo_id = intval($_POST['veiculo_id'] ?? 0);
$data_venda = trim($_POST['data_venda'] ?? '');
$valor = trim($_POST['valor_total'] ?? '');
// DELETE
	if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
		$id = intval($_GET['id']);
		if ($id > 0) {
			$del = $conn->prepare("DELETE FROM venda WHERE id_venda = ?");
			if (!$del) { die('Prepare failed: ' . $conn->error); }
			$del->bind_param('i', $id);
			if (!$del->execute()) { die('Execute failed: ' . $del->error); }
			$del->close();
		}
		header('Location: index.php?page=listar-venda');
		exit;
	}$id = intval($_POST['id'] ?? 0);
if ($cliente_id <= 0 || $funcionario_id <= 0 || $modelo_id <= 0) {
	header('Location: index.php?page=' . ($id ? 'editar-venda&id=' . $id : 'cadastrar-venda') . '&error=missing_ids');
	exit;
}

$valor_float = ($valor === '') ? 0.0 : floatval(str_replace(',', '.', $valor));

if ($id > 0) {
	$stmt = $conn->prepare("UPDATE venda SET data_venda = ?, valor_venda = ?, cliente_id_cliente = ?, funcionario_id_funcionario = ?, modelo_id_modelo = ? WHERE id_venda = ?");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('sdiiii', $data_venda, $valor_float, $cliente_id, $funcionario_id, $modelo_id, $id);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-venda');
	exit;
} else {
	$stmt = $conn->prepare("INSERT INTO venda (data_venda, valor_venda, cliente_id_cliente, funcionario_id_funcionario, modelo_id_modelo) VALUES (?, ?, ?, ?, ?)");
	if (!$stmt) { die('Prepare failed: ' . $conn->error); }
	$stmt->bind_param('sdiii', $data_venda, $valor_float, $cliente_id, $funcionario_id, $modelo_id);
	if (!$stmt->execute()) { die('Execute failed: ' . $stmt->error); }
	$stmt->close();
	header('Location: index.php?page=listar-venda');
	exit;
}

