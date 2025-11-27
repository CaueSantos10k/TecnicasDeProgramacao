<?php require_once 'config.php'; ?>
<?php
$sql = "SELECT v.id_venda, c.nome_cliente, s.nome_show, t.nome_tipo, v.quantidade, v.valor_total, v.data_venda
         FROM vendas v
         INNER JOIN clientes c ON v.cliente_id_cliente = c.id_cliente
         INNER JOIN ingressos i ON v.ingresso_id_ingresso = i.id_ingresso
         INNER JOIN shows s ON i.show_id_show = s.id_show
         INNER JOIN tipos_ingresso t ON i.tipo_ingresso_id_tipo = t.id_tipo
         ORDER BY v.id_venda DESC";
$result = $conexao->prepare($sql);
$result->execute();
$resultado = $result->get_result();
?>

<h1>Vendas</h1>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Show</th>
            <th>Tipo Ingresso</th>
            <th>Quantidade</th>
            <th>Valor Total</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_venda']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_cliente']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_tipo']) . '</td>';
                echo '<td>' . htmlspecialchars($row['quantidade']) . '</td>';
                echo '<td>R$ ' . number_format($row['valor_total'], 2, ',', '.') . '</td>';
                echo '<td>' . htmlspecialchars($row['data_venda']) . '</td>';
                echo '<td>';
                echo '<a href="?page=editar-venda&id=' . htmlspecialchars($row['id_venda']) . '" class="btn btn-sm btn-warning">Editar</a> ';
                echo '<a href="salvar-venda.php?action=delete&id=' . htmlspecialchars($row['id_venda']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
