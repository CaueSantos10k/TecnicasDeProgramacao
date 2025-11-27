<?php 
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'venda_ingressos_show');

    // Conexão com tratamento de erro e definição de charset
    $conexao = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if ($conexao->connect_error) {
        die('Erro de conexão (' . $conexao->connect_errno . '): ' . $conexao->connect_error);
    }
    $conexao->set_charset('utf8mb4');
?>