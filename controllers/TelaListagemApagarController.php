<?php
include_once "../includes/Connection.php";

// Recebe os dados via requisição GET e confere se não está vazio após isso ele deleta o usuário com base no id enviado retornando sucesso ou erro da função
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location:../views/TelaListagem.php?msg=success");
        exit();
    } else {
        header("Location:../views/TelaListagem.php?msg=error");
        exit();
    }
} else {
    echo "ID não fornecido!";
    exit();
}
