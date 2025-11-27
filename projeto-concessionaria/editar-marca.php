<?php
require_once 'config.php';
$id = intval($_GET['id'] ?? 0);
$nome = '';
if ($id > 0) {
    $stmt = $conn->prepare('SELECT nome_marca FROM marca WHERE id_marca = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($nome);
    $stmt->fetch();
    $stmt->close();
}
echo '<h1>' . ($id ? 'Editar Marca' : 'Cadastrar Marca') . '</h1>';
echo '<form method="post" action="salvar-marca.php">';
if ($id) echo '<input type="hidden" name="id" value="' . $id . '">';
echo 'Nome: <input type="text" name="nome" value="' . htmlspecialchars($nome) . '" required><br><br>';
?>
<?php $button_text = 'Salvar'; include 'templates/submit-button.php'; ?>
<?php
echo '</form>';
