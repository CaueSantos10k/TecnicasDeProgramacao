<?php 
require_once 'config.php';

$id = $_REQUEST['id'] ?? '';
$cliente_id_cliente = '';
$ingresso_id_ingresso = '';
$quantidade = '';
$valor_total = '';
$data_venda = '';

if ($id) {
    $sql = "SELECT id_venda, cliente_id_cliente, ingresso_id_ingresso, quantidade, valor_total, data_venda FROM vendas WHERE id_venda = ?";
    $resultado = $conexao->prepare($sql);
    $resultado->bind_param("i", $id);
    $resultado->execute();
    $dados = $resultado->get_result()->fetch_assoc();
    if ($dados) {
        $cliente_id_cliente = $dados['cliente_id_cliente'] ?? '';
        $ingresso_id_ingresso = $dados['ingresso_id_ingresso'] ?? '';
        $quantidade = $dados['quantidade'] ?? '';
        $valor_total = $dados['valor_total'] ?? '';
        $data_venda = $dados['data_venda'] ?? '';
    }
}

// Buscar todos os clientes para o select
$clientes_sql = "SELECT id_cliente, nome_cliente FROM clientes ORDER BY nome_cliente";
$clientes_result = $conexao->prepare($clientes_sql);
$clientes_result->execute();
$clientes_lista = $clientes_result->get_result();

// Buscar todos os ingressos para o select
$ingressos_sql = "SELECT i.id_ingresso, s.nome_show, t.nome_tipo, i.preco
                  FROM ingressos i
                  INNER JOIN shows s ON i.show_id_show = s.id_show
                  INNER JOIN tipos_ingresso t ON i.tipo_ingresso_id_tipo = t.id_tipo
                  ORDER BY s.nome_show, t.nome_tipo";
$ingressos_result = $conexao->prepare($ingressos_sql);
$ingressos_result->execute();
$ingressos_lista = $ingressos_result->get_result();
?>

<h1><?php echo $id ? 'Editar Venda' : 'Cadastrar Venda'; ?></h1>

<form action="salvar-venda.php" method="post">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <?php } ?>
    
    <div class="mb-3">
        <label for="cliente_id_cliente" class="form-label">Cliente</label>
        <select class="form-select" id="cliente_id_cliente" name="cliente_id_cliente" required>
            <option value="">-- Selecione um Cliente --</option>
            <?php
                $clientes_lista->data_seek(0);
                while ($cliente = $clientes_lista->fetch_assoc()) {
                    $selected = $cliente['id_cliente'] == $cliente_id_cliente ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($cliente['id_cliente']) . '" ' . $selected . '>' . htmlspecialchars($cliente['nome_cliente']) . '</option>';
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="ingresso_id_ingresso" class="form-label">Ingresso</label>
        <select class="form-select" id="ingresso_id_ingresso" name="ingresso_id_ingresso" required>
            <option value="">-- Selecione um Ingresso --</option>
            <?php
                $ingressos_lista->data_seek(0);
                while ($ingresso = $ingressos_lista->fetch_assoc()) {
                    $selected = $ingresso['id_ingresso'] == $ingresso_id_ingresso ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($ingresso['id_ingresso']) . '" ' . $selected . '>' . htmlspecialchars($ingresso['nome_show']) . ' - ' . htmlspecialchars($ingresso['nome_tipo']) . ' (R$ ' . number_format($ingresso['preco'], 2, ',', '.') . ')</option>';
                }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>" required>
    </div>

    <div class="mb-3">
        <label for="valor_total" class="form-label">Valor Total (R$)</label>
        <input type="number" class="form-control" id="valor_total" name="valor_total" value="<?php echo htmlspecialchars($valor_total); ?>" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="data_venda" class="form-label">Data da Venda</label>
        <input type="datetime-local" class="form-control" id="data_venda" name="data_venda" value="<?php echo htmlspecialchars($data_venda); ?>" required>
    </div>

    <?php $button_text = $id ? 'Atualizar' : 'Cadastrar'; ?>
    <?php include('templates/submit-button.php'); ?>
</form>

<script>
    // Dados dos ingressos com preços
    const ingressos = {
        <?php
            $ingressos_result->data_seek(0);
            $items = [];
            while ($ingresso = $ingressos_result->fetch_assoc()) {
                $items[] = $ingresso['id_ingresso'] . ': ' . (float)$ingresso['preco'];
            }
            echo implode(', ', $items);
        ?>
    };

    function calcularValorTotal() {
        const ingressoSelect = document.getElementById('ingresso_id_ingresso');
        const quantidadeInput = document.getElementById('quantidade');
        const valorTotalInput = document.getElementById('valor_total');
        
        const ingressoId = ingressoSelect.value;
        const quantidade = parseInt(quantidadeInput.value) || 0;
        
        if (ingressoId && ingressos[ingressoId] && quantidade > 0) {
            const preco = parseFloat(ingressos[ingressoId]);
            const valorTotal = (preco * quantidade).toFixed(2);
            valorTotalInput.value = valorTotal;
        }
    }

    // Adicionar listeners aos campos
    document.getElementById('ingresso_id_ingresso').addEventListener('change', calcularValorTotal);
    document.getElementById('quantidade').addEventListener('input', calcularValorTotal);
</script>
