<?php
require_once 'config.php';
echo '<h1>Listar Modelo</h1>';
echo '<a class="btn btn-primary" href="index.php?page=cadastrar-modelo">Novo Modelo</a><br><br>';
$res = $conn->query('SELECT id_modelo, nome_modelo, ano_modelo, marca_id_marca FROM modelo');
if ($res && $res->num_rows) {
    echo '<table class="table table-bordered"><tr><th>ID</th><th>Nome</th><th>Ano</th><th>Marca ID</th><th>Ações</th></tr>';
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id_modelo'];
        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_modelo']) . '</td>';
        echo '<td>' . htmlspecialchars($row['ano_modelo']) . '</td>';
        echo '<td>' . htmlspecialchars($row['marca_id_marca']) . '</td>';
        echo '<td><a href="index.php?page=editar-modelo&id=' . $id . '">Editar</a> | <a href="salvar-modelo.php?action=delete&id=' . $id . '" onclick="return confirm(\'Confirma exclusão?\')">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhum modelo cadastrado.</p>';
}
