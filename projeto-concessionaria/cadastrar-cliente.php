<h1>Cadastrar Cliente</h1>
<form action="salvar-cliente.php" method="post">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required><br><br>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" required><br><br>

    <?php $button_text = 'Cadastrar Cliente'; include 'templates/submit-button.php'; ?>
</form>