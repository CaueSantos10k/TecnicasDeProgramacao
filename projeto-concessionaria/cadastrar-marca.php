<h1>Cadastrar Marca</h1>
<form action="salvar-marca.php" method="post">
    <label for="nome">Nome da Marca:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="pais_origem">País de Origem:</label>
    <input type="text" id="pais_origem" name="pais_origem" required><br><br>

    <?php $button_text = 'Cadastrar Marca'; include 'templates/submit-button.php'; ?>
</form>