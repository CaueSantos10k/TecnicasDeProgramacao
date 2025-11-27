<h1>Cadastrar Venda</h1>
<form action="salvar-venda.php" method="post">
    <label for="cliente_id">ID do Cliente:</label>
    <input type="number" id="cliente_id" name="cliente_id" required><br><br>

    <label for="funcionario_id">ID do Funcionário:</label>
    <input type="number" id="funcionario_id" name="funcionario_id" required><br><br>

    <label for="veiculo_id">ID do Veículo:</label>
    <input type="number" id="veiculo_id" name="veiculo_id" required><br><br>

    <label for="data_venda">Data da Venda:</label>
    <input type="date" id="data_venda" name="data_venda" required><br><br>

    <label for="valor_total">Valor Total:</label>
    <input type="number" id="valor_total" name="valor_total" required step="0.01"><br><br>

    <?php $button_text = 'Cadastrar Venda'; include 'templates/submit-button.php'; ?>
</form>