<?php
require_once 'config.php';
$id = intval($_GET['id'] ?? 0);
$cliente_id = $funcionario_id = $modelo_id = 0;
$data_venda = '';
$valor = '';

// carregar clientes, funcionarios, modelos
$clientes = $funcionarios = $modelos = [];
$r = $conn->query('SELECT id_cliente, nome_cliente FROM cliente'); while ($x = $r->fetch_assoc()) $clientes[] = $x;
$r = $conn->query('SELECT id_funcionario, nome_funcionario FROM funcionario'); while ($x = $r->fetch_assoc()) $funcionarios[] = $x;
$r = $conn->query('SELECT id_modelo, nome_modelo FROM modelo'); while ($x = $r->fetch_assoc()) $modelos[] = $x;

if ($id > 0) {
    $stmt = $conn->prepare('SELECT cliente_id_cliente, funcionario_id_funcionario, modelo_id_modelo, data_venda, valor_venda FROM venda WHERE id_venda = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($cliente_id, $funcionario_id, $modelo_id, $data_venda, $valor);
    $stmt->fetch();
    $stmt->close();
}

echo '<h1>' . ($id ? 'Editar Venda' : 'Cadastrar Venda') . '</h1>';
echo '<form method="post" action="salvar-venda.php">';
if ($id) echo '<input type="hidden" name="id" value="' . $id . '">';
// cliente
echo 'Cliente: <select name="cliente_id"><option value="0">-- selecione --</option>';
foreach ($clientes as $c) { $sel = ($c['id_cliente']==$cliente_id)?' selected':''; echo '<option value="' . $c['id_cliente'] . '"' . $sel . '>' . htmlspecialchars($c['nome_cliente']) . '</option>'; }
echo '</select><br><br>';
// funcionario
echo 'Funcionário: <select name="funcionario_id"><option value="0">-- selecione --</option>';
foreach ($funcionarios as $f) { $sel = ($f['id_funcionario']==$funcionario_id)?' selected':''; echo '<option value="' . $f['id_funcionario'] . '"' . $sel . '>' . htmlspecialchars($f['nome_funcionario']) . '</option>'; }
echo '</select><br><br>';
// modelo
echo 'Modelo: <select name="veiculo_id"><option value="0">-- selecione --</option>';
foreach ($modelos as $m) { $sel = ($m['id_modelo']==$modelo_id)?' selected':''; echo '<option value="' . $m['id_modelo'] . '"' . $sel . '>' . htmlspecialchars($m['nome_modelo']) . '</option>'; }
echo '</select><br><br>';
echo 'Data: <input type="date" name="data_venda" value="' . htmlspecialchars($data_venda) . '"><br><br>';
echo 'Valor: <input type="number" step="0.01" name="valor_total" value="' . htmlspecialchars($valor) . '"><br><br>';
?>
<?php $button_text = 'Salvar'; include 'templates/submit-button.php'; ?>
<?php
echo '</form>';
