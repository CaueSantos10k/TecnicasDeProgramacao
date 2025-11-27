<?php
require_once 'config.php';
echo '<h1>Listar Cliente</h1>';
echo '<a class="btn btn-primary" href="index.php?page=cadastrar-cliente">Novo Cliente</a><br><br>';
$res = $conn->query('SELECT id_cliente, nome_cliente, email_cliente, telefone_cliente, endereco_cliente FROM cliente');
if ($res && $res->num_rows) {
    echo '<table class="table table-bordered"><tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr>';
    while ($row = $res->fetch_assoc()) {
        $id = (int)$row['id_cliente'];
        echo '<tr>';
        echo '<td>' . $id . '</td>';
        echo '<td>' . htmlspecialchars($row['nome_cliente']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email_cliente']) . '</td>';
        echo '<td>' . htmlspecialchars($row['telefone_cliente']) . '</td>';
        echo '<td>' . htmlspecialchars($row['endereco_cliente']) . '</td>';
        echo '<td><a href="index.php?page=editar-cliente&id=' . $id . '">Editar</a> | <a href="salvar-cliente.php?action=delete&id=' . $id . '" onclick="return confirm(\'Confirma exclusão?\')">Excluir</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Nenhum cliente cadastrado.</p>';
}
