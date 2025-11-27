<?php 
require_once 'config.php';

$id = $_REQUEST['id'] ?? '';
$nome_show = '';
$data_show = '';
$hora_show = '';
$local_show = '';
$descricao = '';

if ($id) {
    $sql = "SELECT id_show, nome_show, data_show, hora_show, local_show, descricao FROM shows WHERE id_show = ?";
    $resultado = $conexao->prepare($sql);
    $resultado->bind_param("i", $id);
    $resultado->execute();
    $dados = $resultado->get_result()->fetch_assoc();
    if ($dados) {
        $nome_show = $dados['nome_show'] ?? '';
        $data_show = $dados['data_show'] ?? '';
        $hora_show = $dados['hora_show'] ?? '';
        $local_show = $dados['local_show'] ?? '';
        $descricao = $dados['descricao'] ?? '';
    }
}
?>

<h1><?php echo $id ? 'Editar Show' : 'Cadastrar Show'; ?></h1>

<form action="salvar-show.php" method="post">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <?php } ?>
    
    <div class="mb-3">
        <label for="nome_show" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome_show" name="nome_show" value="<?php echo htmlspecialchars($nome_show); ?>" required <?php echo $id ? 'readonly' : ''; ?>>
    </div>

    <div class="mb-3">
        <label for="data_show" class="form-label">Data</label>
        <input type="date" class="form-control" id="data_show" name="data_show" value="<?php echo htmlspecialchars($data_show); ?>" required>
    </div>

    <div class="mb-3">
        <label for="hora_show" class="form-label">Hora</label>
        <input type="time" class="form-control" id="hora_show" name="hora_show" value="<?php echo htmlspecialchars($hora_show); ?>" required>
    </div>

    <div class="mb-3">
        <label for="local_show" class="form-label">Local</label>
        <input type="text" class="form-control" id="local_show" name="local_show" value="<?php echo htmlspecialchars($local_show); ?>" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($descricao); ?></textarea>
    </div>

    <?php $button_text = $id ? 'Atualizar' : 'Cadastrar'; ?>
    <?php include('templates/submit-button.php'); ?>
</form>
