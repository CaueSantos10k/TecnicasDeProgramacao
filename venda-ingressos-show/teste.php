<?php
require 'config.php';

echo "<h2>TESTE DE CONECTIVIDADE - VENDA INGRESSOS SHOW</h2>";
echo "<hr>";

// Teste 1: Conexão
echo "<h3>1. Conexão com Banco de Dados</h3>";
if ($conexao) {
    echo "✅ Conexão estabelecida com sucesso<br>";
} else {
    echo "❌ Falha na conexão<br>";
    exit;
}

// Teste 2: Tabelas
$tabelas = ['shows', 'tipos_ingresso', 'ingressos', 'clientes', 'vendas'];
echo "<h3>2. Verificação de Tabelas</h3>";
foreach ($tabelas as $tabela) {
    $result = $conexao->query("SELECT COUNT(*) as total FROM $tabela");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "✅ Tabela <strong>$tabela</strong>: {$row['total']} registros<br>";
    } else {
        echo "❌ Tabela <strong>$tabela</strong>: ERRO<br>";
    }
}

// Teste 3: Verificar handlers
echo "<h3>3. Verificação de Arquivos Principais</h3>";
$files = ['salvar-show.php', 'salvar-tipo.php', 'salvar-ingresso.php', 'salvar-cliente.php', 'salvar-venda.php',
          'listar-show.php', 'listar-tipo.php', 'listar-ingresso.php', 'listar-cliente.php', 'listar-venda.php',
          'editar-show.php', 'editar-tipo.php', 'editar-ingresso.php', 'editar-cliente.php', 'editar-venda.php'];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✅ $file<br>";
    } else {
        echo "❌ $file: NÃO ENCONTRADO<br>";
    }
}

echo "<hr>";
echo "<p><strong>Teste concluído!</strong> Se todas as verificações passaram, o sistema está pronto.</p>";
echo "<p><a href='index.php' style='text-decoration: none; color: #8b5cf6; font-weight: bold;'>&larr; Voltar para o Painel</a></p>";
?>
