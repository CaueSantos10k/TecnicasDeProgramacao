<?php 
require_once 'config.php';

$id = $_REQUEST['id'] ?? '';
$show_id_show = '';
$tipo_ingresso_id_tipo = '';
$preco = '';
$quantidade_total = '';
$quantidade_disponivel = '';

if ($id) {
    $sql = "SELECT id_ingresso, show_id_show, tipo_ingresso_id_tipo, preco, quantidade_total, quantidade_disponivel FROM ingressos WHERE id_ingresso = ?";
    $resultado = $conexao->prepare($sql);
    $resultado->bind_param("i", $id);
    $resultado->execute();
    $dados = $resultado->get_result()->fetch_assoc();
    if ($dados) {
        $show_id_show = $dados['show_id_show'] ?? '';
        $tipo_ingresso_id_tipo = $dados['tipo_ingresso_id_tipo'] ?? '';
        $preco = $dados['preco'] ?? '';
        $quantidade_total = $dados['quantidade_total'] ?? '';
        $quantidade_disponivel = $dados['quantidade_disponivel'] ?? '';
    }
}

// Buscar todos os shows para o select
$shows_sql = "SELECT id_show, nome_show FROM shows ORDER BY nome_show";
$shows_result = $conexao->prepare($shows_sql);
$shows_result->execute();
$shows_lista = $shows_result->get_result();

// Buscar todos os tipos de ingresso para o select
$tipos_sql = "SELECT id_tipo, nome_tipo FROM tipos_ingresso ORDER BY nome_tipo";
$tipos_result = $conexao->prepare($tipos_sql);
$tipos_result->execute();
$tipos_lista = $tipos_result->get_result();
?>

<h1><?php echo $id ? 'Editar Ingresso' : 'Cadastrar Ingresso'; ?></h1>

<form action="salvar-ingresso.php" method="post">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <?php } ?>
    
    <div class="mb-3">
        <label for="show_id_show" class="form-label">Show</label>
        <select class="form-select" id="show_id_show" name="show_id_show" required>
            <option value="">-- Selecione um Show --</option>
            <?php
                $shows_lista->data_seek(0);
                while ($show = $shows_lista->fetch_assoc()) {
                    $selected = $show['id_show'] == $show_id_show ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($show['id_show']) . '" ' . $selected . '>' . htmlspecialchars($show['nome_show']) . '</option>';
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="tipo_ingresso_id_tipo" class="form-label">Tipo de Ingresso</label>
        <select class="form-select" id="tipo_ingresso_id_tipo" name="tipo_ingresso_id_tipo" required>
            <option value="">-- Selecione um Tipo --</option>
            <?php
                $tipos_lista->data_seek(0);
                while ($tipo = $tipos_lista->fetch_assoc()) {
                    $selected = $tipo['id_tipo'] == $tipo_ingresso_id_tipo ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($tipo['id_tipo']) . '" ' . $selected . '>' . htmlspecialchars($tipo['nome_tipo']) . '</option>';
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Preço (R$)</label>
        <input type="number" class="form-control" id="preco" name="preco" value="<?php echo htmlspecialchars($preco); ?>" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="quantidade_total" class="form-label">Quantidade Total</label>
        <input type="number" class="form-control" id="quantidade_total" name="quantidade_total" value="<?php echo htmlspecialchars($quantidade_total); ?>" required>
    </div>

    <div class="mb-3">
        <label for="quantidade_disponivel" class="form-label">Quantidade Disponível</label>
        <input type="number" class="form-control" id="quantidade_disponivel" name="quantidade_disponivel" value="<?php echo htmlspecialchars($quantidade_disponivel); ?>" required>
    </div>

    <?php $button_text = $id ? 'Atualizar' : 'Cadastrar'; ?>
    <?php include('templates/submit-button.php'); ?>
</form>
