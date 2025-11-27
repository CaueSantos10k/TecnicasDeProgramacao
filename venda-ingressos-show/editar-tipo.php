<?php 
require_once 'config.php';

$id = $_REQUEST['id'] ?? '';
$nome_tipo = '';
$descricao_tipo = '';

if ($id) {
    $sql = "SELECT id_tipo, nome_tipo, descricao_tipo FROM tipos_ingresso WHERE id_tipo = ?";
    $resultado = $conexao->prepare($sql);
    $resultado->bind_param("i", $id);
    $resultado->execute();
    $dados = $resultado->get_result()->fetch_assoc();
    if ($dados) {
        $nome_tipo = $dados['nome_tipo'] ?? '';
        $descricao_tipo = $dados['descricao_tipo'] ?? '';
    }
}
?>

<h1><?php echo $id ? 'Editar Tipo de Ingresso' : 'Cadastrar Tipo de Ingresso'; ?></h1>

<form action="salvar-tipo.php" method="post">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <?php } ?>
    
    <div class="mb-3">
        <label for="nome_tipo" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome_tipo" name="nome_tipo" value="<?php echo htmlspecialchars($nome_tipo); ?>" required <?php echo $id ? 'readonly' : ''; ?>>
    </div>

    <div class="mb-3">
        <label for="descricao_tipo" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao_tipo" name="descricao_tipo" rows="3"><?php echo htmlspecialchars($descricao_tipo); ?></textarea>
    </div>

    <?php $button_text = $id ? 'Atualizar' : 'Cadastrar'; ?>
    <?php include('templates/submit-button.php'); ?>
</form>
