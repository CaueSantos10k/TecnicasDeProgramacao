<?php
if (!isset($button_text)) {
    $button_text = 'Salvar';
}
?>
<button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($button_text); ?></button>
