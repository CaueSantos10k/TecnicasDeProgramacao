<?php require_once 'config.php'; ?>
<?php
$sql = "SELECT id_tipo, nome_tipo, descricao_tipo FROM tipos_ingresso ORDER BY id_tipo DESC";
$result = $conexao->prepare($sql);
$result->execute();
$resultado = $result->get_result();
?>

<h1>Tipos de Ingresso</h1>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_tipo']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_tipo']) . '</td>';
                echo '<td>' . htmlspecialchars($row['descricao_tipo']) . '</td>';
                echo '<td>';
                echo '<a href="?page=editar-tipo&id=' . htmlspecialchars($row['id_tipo']) . '" class="btn btn-sm btn-warning">Editar</a> ';
                echo '<a href="salvar-tipo.php?action=delete&id=' . htmlspecialchars($row['id_tipo']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
