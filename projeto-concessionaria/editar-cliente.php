<?php
require_once 'config.php';
$id = intval($_GET['id'] ?? 0);
$nome = $email = $telefone = $endereco = '';
if ($id > 0) {
    $stmt = $conn->prepare('SELECT nome_cliente, email_cliente, telefone_cliente, endereco_cliente FROM cliente WHERE id_cliente = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $telefone, $endereco);
    $stmt->fetch();
    $stmt->close();
}
echo '<h1>' . ($id ? 'Editar Cliente' : 'Cadastrar Cliente') . '</h1>';
echo '<form method="post" action="salvar-cliente.php">';
if ($id) echo '<input type="hidden" name="id" value="' . $id . '">';
echo 'Nome: <input type="text" name="nome" value="' . htmlspecialchars($nome) . '" required><br><br>';
echo 'Email: <input type="email" name="email" value="' . htmlspecialchars($email) . '"><br><br>';
echo 'Telefone: <input type="tel" name="telefone" value="' . htmlspecialchars($telefone) . '"><br><br>';
echo 'Endereço: <input type="text" name="endereco" value="' . htmlspecialchars($endereco) . '"><br><br>';
?>
<?php $button_text = 'Salvar'; include 'templates/submit-button.php'; ?>
<?php
echo '</form>';
