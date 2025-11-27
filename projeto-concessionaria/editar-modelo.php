<?php
require_once 'config.php';
$id = intval($_GET['id'] ?? 0);
$nome = $ano = '';
$marca_id = 0;
// carregar marcas para select
$marcas = [];
$r = $conn->query('SELECT id_marca, nome_marca FROM marca');
while ($m = $r->fetch_assoc()) { $marcas[] = $m; }

if ($id > 0) {
    $stmt = $conn->prepare('SELECT nome_modelo, ano_modelo, marca_id_marca FROM modelo WHERE id_modelo = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($nome, $ano, $marca_id);
    $stmt->fetch();
    $stmt->close();
}

echo '<h1>' . ($id ? 'Editar Modelo' : 'Cadastrar Modelo') . '</h1>';
echo '<form method="post" action="salvar-modelo.php">';
if ($id) echo '<input type="hidden" name="id" value="' . $id . '">';
echo 'Nome: <input type="text" name="nome" value="' . htmlspecialchars($nome) . '" required><br><br>';
echo 'Ano: <input type="number" name="ano" value="' . htmlspecialchars($ano) . '"><br><br>';
echo 'Marca: <select name="marca_id">';
echo '<option value="0">-- selecione --</option>';
foreach ($marcas as $m) {
    $sel = ($m['id_marca'] == $marca_id) ? ' selected' : '';
    echo '<option value="' . $m['id_marca'] . '"' . $sel . '>' . htmlspecialchars($m['nome_marca']) . '</option>';
}
echo '</select><br><br>';
?>
<?php $button_text = 'Salvar'; include 'templates/submit-button.php'; ?>
<?php
echo '</form>';
