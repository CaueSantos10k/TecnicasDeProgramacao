<h1>Cadastrar Modelo</h1>
<form action="salvar-modelo.php" method="post">
    <label for="nome">Nome do Modelo:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="ano">Ano:</label>
    <input type="number" id="ano" name="ano" required><br><br>

    <label for="marca_id">ID da Marca:</label>
    <input type="number" id="marca_id" name="marca_id" required><br><br>

    <?php $button_text = 'Cadastrar Modelo'; include 'templates/submit-button.php'; ?>
</form>