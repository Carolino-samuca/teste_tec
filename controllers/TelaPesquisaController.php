<?php
include_once "../includes/Connection.php";

$sql = "SELECT * FROM usuarios LIMIT 3";
$result = $conn->query($sql);

// Seleciona a tabela bairro e a quantidade de ceps associados
$cepPorBairro = "SELECT * FROM bairros";
$resultadoCepPorBairro = $conn->query($cepPorBairro);

// Seleciona a tabela bairro e a quantidade de ceps associados maior que 1
$cepBairroMaiorUm = "SELECT * FROM bairros WHERE quantidade > 1";
$resultadoCepBairroMaiorUm = $conn->query($cepBairroMaiorUm);


// Recebe os dados via requisição POST e confere se não está nulo depois veridica se realmente não está vazio
if (isset($_POST['pesquisa'])) {

    $pesquisa = $_POST['pesquisa'];

    if ($_POST['pesquisa'] == "") {
        $sql = "SELECT * FROM usuarios LIMIT 3"; // aqui limitei a quantidade que vai retornar, se não puxaria todo o banco de dados
        $result = $conn->query($sql);
    } else {
        // Se for uma pesquisa númerica, ou seja somente números ele ira pesquisar já por CPF
        if (is_numeric($pesquisa)) {
            // LIKE junto com os dois '%' ajuda na pesquisa pois vai pesquisar o número ou letra que tem contida no banco
            $sql = "SELECT * FROM usuarios WHERE cpf LIKE '%$pesquisa%'";
            $result = $conn->query($sql);
        } else {
            $sql = "SELECT * FROM usuarios WHERE nome_completo LIKE '%$pesquisa%'";
            $result = $conn->query($sql);
        }
    }
}
