<?php 
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'concessionaria2122m');

    // Conexão com tratamento de erro e definição de charset
    $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        // Em produção, registre o erro em arquivo em vez de exibir
        die('Erro de conexão (' . $conn->connect_errno . '): ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');