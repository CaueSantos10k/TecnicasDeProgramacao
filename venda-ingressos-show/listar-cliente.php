<?php require_once 'config.php'; ?>
<?php
$sql = "SELECT id_cliente, nome_cliente, email_cliente, telefone_cliente FROM clientes ORDER BY id_cliente DESC";
$result = $conexao->prepare($sql);
$result->execute();
$resultado = $result->get_result();
?>

<h1>Clientes</h1>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $resultado->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id_cliente']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nome_cliente']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email_cliente']) . '</td>';
                echo '<td>' . htmlspecialchars($row['telefone_cliente']) . '</td>';
                echo '<td>';
                echo '<a href="?page=editar-cliente&id=' . htmlspecialchars($row['id_cliente']) . '" class="btn btn-sm btn-warning">Editar</a> ';
                echo '<a href="salvar-cliente.php?action=delete&id=' . htmlspecialchars($row['id_cliente']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Tem certeza?\')">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>
