<?php
require_once 'config.php';
echo '<h1>Listar Marca</h1>';
echo '<a class="btn btn-primary" href="index.php?page=cadastrar-marca">Nova Marca</a><br><br>';
$res = $conn->query('SELECT id_marca, nome_marca FROM marca');
if ($res && $res->num_rows) {
    echo '<table class="table table-bordered"><tr><th>ID</th><th>Nome</th><th>Ações</th></tr>';
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id_marca'];
        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_marca']) . '</td>';
        echo '<td><a href="index.php?page=editar-marca&id=' . $id . '">Editar</a> | <a href="salvar-marca.php?action=delete&id=' . $id . '" onclick="return confirm(\'Confirma exclusão?\')">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhuma marca cadastrada.</p>';
}
