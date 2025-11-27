<?php 
require_once 'config.php';

$id = $_REQUEST['id'] ?? '';
$nome_cliente = '';
$email_cliente = '';
$telefone_cliente = '';

if ($id) {
    $sql = "SELECT id_cliente, nome_cliente, email_cliente, telefone_cliente FROM clientes WHERE id_cliente = ?";
    $resultado = $conexao->prepare($sql);
    $resultado->bind_param("i", $id);
    $resultado->execute();
    $dados = $resultado->get_result()->fetch_assoc();
    if ($dados) {
        $nome_cliente = $dados['nome_cliente'] ?? '';
        $email_cliente = $dados['email_cliente'] ?? '';
        $telefone_cliente = $dados['telefone_cliente'] ?? '';
    }
}
?>

<h1><?php echo $id ? 'Editar Cliente' : 'Cadastrar Cliente'; ?></h1>

<form action="salvar-cliente.php" method="post">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <?php } ?>
    
    <div class="mb-3">
        <label for="nome_cliente" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" value="<?php echo htmlspecialchars($nome_cliente); ?>" required <?php echo $id ? 'readonly' : ''; ?>>
    </div>

    <div class="mb-3">
        <label for="email_cliente" class="form-label">Email</label>
        <input type="email" class="form-control" id="email_cliente" name="email_cliente" value="<?php echo htmlspecialchars($email_cliente); ?>" required>
    </div>

    <div class="mb-3">
        <label for="telefone_cliente" class="form-label">Telefone</label>
        <input type="tel" class="form-control" id="telefone_cliente" name="telefone_cliente" value="<?php echo htmlspecialchars($telefone_cliente); ?>">
    </div>

    <?php $button_text = $id ? 'Atualizar' : 'Cadastrar'; ?>
    <?php include('templates/submit-button.php'); ?>
</form>
