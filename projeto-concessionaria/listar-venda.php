<?php
require_once 'config.php';
echo '<h1>Listar Venda</h1>';
echo '<a class="btn btn-primary" href="index.php?page=cadastrar-venda">Nova Venda</a><br><br>';
$sql = 'SELECT v.id_venda, v.data_venda, v.valor_venda, c.nome_cliente, f.nome_funcionario, m.nome_modelo FROM venda v JOIN cliente c ON v.cliente_id_cliente = c.id_cliente JOIN funcionario f ON v.funcionario_id_funcionario = f.id_funcionario JOIN modelo m ON v.modelo_id_modelo = m.id_modelo';
$res = $conn->query($sql);
if ($res && $res->num_rows) {
    echo '<table class="table table-bordered"><tr><th>ID</th><th>Data</th><th>Valor</th><th>Cliente</th><th>Funcionário</th><th>Modelo</th><th>Ações</th></tr>';
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id_venda'];
        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($row['data_venda']) . '</td>';
        echo '<td>' . htmlspecialchars($row['valor_venda']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_cliente']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_funcionario']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_modelo']) . '</td>';
        echo '<td><a href="index.php?page=editar-venda&id=' . $id . '">Editar</a> | <a href="salvar-venda.php?action=delete&id=' . $id . '" onclick="return confirm(\'Confirma exclusão?\')">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhuma venda cadastrada.</p>';
}
