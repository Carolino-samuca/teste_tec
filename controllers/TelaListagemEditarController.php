<?php
include_once "../includes/Connection.php";
include_once "../controllers/TelaListagemController.php";


// Recebe os dados via requisição GET e confere se não está vazio
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = $id"; // seleciona a tabala usuários no id correspondente puxando todas as informações para os campos
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegando os dados dos campos do formulário 
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $numero = $_POST['numero'];

    // Atualizando os dados no banco de dados
    $sql = "UPDATE usuarios SET nome_completo = '$nome', cpf = '$cpf', cep = '$cep', endereco = '$endereco', bairro = '$bairro', cidade = '$cidade', estado = '$estado', numero = '$numero'  WHERE id = $id";


    // aqui ele vai tentar executar a query se conseguir ele retorna um requisição GET de sucesso, caso não, ele retorna com error
    try {
        if ($conn->query($sql)) {
            header("Location:../views/TelaListagemEditar.php?msg=success");
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        header("Location:../views/TelaListagemEditar.php?msg=error");
        exit();
    }
}
