<?php
include_once "../includes/Connection.php";

session_start();

// Receber dados do formulário
$nomeCompleto = $_POST['nomeCompleto'];
$cpf  = $_POST['cpf'];
$cep          = $_POST['cep'];
$endereco     = $_POST['endereco'];
$bairro       = $_POST['bairro'];
$cidade       = $_POST['cidade'];
$estado       = $_POST['estado'];
$numero       = $_POST['numero'];

// aqui ele prepara um query de pesquisa para saber se o existe um bairro com o mesmo nome ou não

$stmt = $conn->prepare("SELECT id, quantidade FROM bairros WHERE nome_bairro = ?");
$stmt->bind_param("s", $bairro);
$stmt->execute();
$stmt->store_result();

// Se o bairro já existir
if ($stmt->num_rows > 0) {

    // Ele vai pegar o ID no banco e armazenar na variável
    $id = $conn->prepare("SELECT id FROM bairros WHERE nome_bairro = ?");
    $id->bind_param("s", $bairro);
    $id->execute();
    $id->bind_result($bairroId);
    $id->fetch();
    $id->close();

    // Ele vai pegar a quantidade no banco e armazenar na variável depois adcionar +1
    $quantidade = $conn->prepare("SELECT quantidade FROM bairros WHERE nome_bairro = ?");
    $quantidade->bind_param("s", $bairro);
    $quantidade->execute();
    $quantidade->bind_result($quantidade);
    $quantidade->fetch();
    $quantidade++;

    // Atualiza a quantidade do bairro na tabela bairros
    $update = $conn->prepare("UPDATE bairros SET quantidade = ? WHERE id = ?");
    $update->bind_param("ii", $quantidade, $bairroId);
    $update->execute();
    $update->close();
} else {
    // Se o bairro não existir, insere um novo bairro com quantidade = 1
    $stmt = $conn->prepare("INSERT INTO bairros (nome_bairro, quantidade) VALUES (?, ?)");
    $quantidade = 1;
    $stmt->bind_param("si", $bairro, $quantidade);
    $stmt->execute();
    $bairroId = $stmt->insert_id;
    $stmt->close();
}

// Prepara e executa a inserção
$stmt = $conn->prepare("INSERT INTO usuarios (nome_completo, cpf, cep, endereco, bairro, cidade, estado, numero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nomeCompleto, $cpf, $cep, $endereco, $bairro, $cidade, $estado, $numero);

try {
    if ($stmt->execute()) {
        header("Location:../index.php?msg=success");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    header("Location:../index.php?msg=error");
    exit();
}

$stmt->close();
$conn->close();
