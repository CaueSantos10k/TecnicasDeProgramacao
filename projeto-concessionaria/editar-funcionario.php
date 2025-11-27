<?php
require_once 'config.php';
$id = intval($_GET['id'] ?? 0);
$nome = $email = $telefone = '';
if ($id > 0) {
    $stmt = $conn->prepare('SELECT nome_funcionario, telefone_funcionario, email_funcionario FROM funcionario WHERE id_funcionario = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($nome, $telefone, $email);
    $stmt->fetch();
    $stmt->close();
}
echo '<h1>' . ($id ? 'Editar Funcionário' : 'Cadastrar Funcionário') . '</h1>';
echo '<form method="post" action="salvar-funcionario.php">';
if ($id) echo '<input type="hidden" name="id" value="' . $id . '">';
echo 'Nome: <input type="text" name="nome" value="' . htmlspecialchars($nome) . '" required><br><br>';
echo 'Email: <input type="email" name="email" value="' . htmlspecialchars($email) . '"><br><br>';
echo 'Telefone: <input type="tel" name="telefone" value="' . htmlspecialchars($telefone) . '"><br><br>';
?>
<?php $button_text = 'Salvar'; include 'templates/submit-button.php'; ?>
<?php
echo '</form>';
