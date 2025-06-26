<?php
include_once "../includes/Connection.php";

// Seleciona o id, nome , cpf e cep do usuário da tabela usuário
$sql = "SELECT id, nome_completo, cpf, cep FROM usuarios";
$result = $conn->query($sql);

// Recebe os dados via requisição GET e confere se não está vazio
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if (isset($_POST['pesquisa'])) {
    $pesquisa = $_POST['pesquisa'];

    // Se for numérico cpnsidera como pesquisa do CPF se for letra ele busca por nome
    if (is_numeric($pesquisa)) {
        $sql = "SELECT * FROM usuarios WHERE cpf LIKE '%$pesquisa%'";
        $result = $conn->query($sql);
        // exit();
    } else {
        $sql = "SELECT * FROM usuarios WHERE nome_completo LIKE '%$pesquisa%'";
        $result = $conn->query($sql);
        // exit();
    }
}
