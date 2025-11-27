<?php require_once 'config.php'; ?>
<?php
$sql = "SELECT i.id_ingresso, s.nome_show, t.nome_tipo, i.preco, i.quantidade_total, i.quantidade_disponivel 
         FROM ingressos i
         INNER JOIN shows s ON i.show_id_show = s.id_show
         INNER JOIN tipos_ingresso t ON i.tipo_ingresso_id_tipo = t.id_tipo
         ORDER BY i.id_ingresso DESC";
$result = $conexao->prepare($sql);
$result->execute();
$resultado = $result->get_result();
?>

<h1>Ingressos</h1>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Show</th>
            <th>Tipo</th>
            <th>Preço</th>
            <th>Quantidade Total</th>
            <th>Disponíveis</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_ingresso']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_tipo']) . '</td>';
                echo '<td>R$ ' . number_format($row['preco'], 2, ',', '.') . '</td>';
                echo '<td>' . htmlspecialchars($row['quantidade_total']) . '</td>';
                echo '<td>' . htmlspecialchars($row['quantidade_disponivel']) . '</td>';
                echo '<td>';
                echo '<a href="?page=editar-ingresso&id=' . htmlspecialchars($row['id_ingresso']) . '" class="btn btn-sm btn-warning">Editar</a> ';
                echo '<a href="salvar-ingresso.php?action=delete&id=' . htmlspecialchars($row['id_ingresso']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
