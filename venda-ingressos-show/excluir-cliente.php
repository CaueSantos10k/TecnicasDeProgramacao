<?php require_once 'config.php'; ?>
<?php
    $id = $_REQUEST['id'] ?? '';
    if ($id) {
        header("Location: index.php?page=editar-cliente&id=$id");
    } else {
        header("Location: index.php");
    }
?>
