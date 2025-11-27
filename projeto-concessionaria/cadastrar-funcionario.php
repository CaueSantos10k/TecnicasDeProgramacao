<h1>Cadastrar Funcionário</h1>
<form action="salvar-funcionario.php" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required><br><br>

    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" required><br><br>

    <label for="salario">Salário:</label>
    <input type="number" id="salario" name="salario" required step="0.01"><br><br>

    <?php $button_text = 'Cadastrar Funcionário'; include 'templates/submit-button.php'; ?>
</form>