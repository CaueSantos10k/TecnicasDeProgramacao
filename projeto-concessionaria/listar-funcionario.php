<?php
require_once 'config.php';
echo '<h1>Listar Funcionário</h1>';
echo '<a class="btn btn-primary" href="index.php?page=cadastrar-funcionario">Novo Funcionário</a><br><br>';
$res = $conn->query('SELECT id_funcionario, nome_funcionario, telefone_funcionario, email_funcionario FROM funcionario');
if ($res && $res->num_rows) {
    echo '<table class="table table-bordered"><tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Email</th><th>Ações</th></tr>';
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id_funcionario'];
        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_funcionario']) . '</td>';
        echo '<td>' . htmlspecialchars($row['telefone_funcionario']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email_funcionario']) . '</td>';
        echo '<td><a href="index.php?page=editar-funcionario&id=' . $id . '">Editar</a> | <a href="salvar-funcionario.php?action=delete&id=' . $id . '" onclick="return confirm(\'Confirma exclusão?\')">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhum funcionário cadastrado.</p>';
}
