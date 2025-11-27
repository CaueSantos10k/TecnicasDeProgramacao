<?php require_once 'config.php'; ?>
<?php
$sql = "SELECT id_show, nome_show, data_show, hora_show, local_show, descricao FROM shows ORDER BY id_show DESC";
$result = $conexao->prepare($sql);
$result->execute();
$resultado = $result->get_result();
?>

<h1>Shows</h1>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Local</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['data_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['hora_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['local_show']) . '</td>';
                echo '<td>' . htmlspecialchars($row['descricao']) . '</td>';
                echo '<td>';
                echo '<a href="?page=editar-show&id=' . htmlspecialchars($row['id_show']) . '" class="btn btn-sm btn-warning">Editar</a> ';
                echo '<a href="salvar-show.php?action=delete&id=' . htmlspecialchars($row['id_show']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
