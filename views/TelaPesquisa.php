<?php
include_once '../includes/header.php';
include_once '../includes/Connection.php';
include_once '../controllers/TelaPesquisaController.php';
session_start();
?>

<body>
    <section id="tela-pesquisa">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="d-flex justify-content-center mb-4">
                        <a href="TelaListagem.php" class="mr-2">
                            <button class="btn btn-primary">Listagem</button>
                        </a>
                        <a href="../index.php">
                            <button class="btn btn-primary">cadastrar</button>
                        </a>
                    </div>
                    <form class="form-inline justify-content-center mb-4" method="POST" action="">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="inputPassword2" name="pesquisa" placeholder="Pesquisar">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="acao" value="pesquisar">Pesquisar</button>
                    </form>
                    <div id="tabela-clientes" class="justify-content-center table-fundo">
                        <div class="row justify-content-center">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($usuario = $result->fetch_assoc()) {
                                    echo "
                                    <div class='col-sm-12 col-md-6 col-lg-4 col-12 mb-3 cards-pesquisa-mobile d-flex justify-content-center text-center'>
                                        <div class='card'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>" . $usuario["nome_completo"] . "</h5>
                                                <h6 class='card-subtitle mb-2 text-muted'>ID: " . $usuario["id"] . "</h6>
                                                <p class='card-text'><strong>CPF:</strong> " . $usuario["cpf"] . "</p>
                                                <p class='card-text'><strong>CEP:</strong> " . $usuario["cep"] . "</p>
                                                <p class='card-text'><strong>Endereço:</strong> " . $usuario["endereco"] . " " . $usuario["numero"] . ", " . $usuario["bairro"] . " - " . $usuario["cidade"] . " / " . $usuario["estado"] . "</p>
                                            </div>
                                        </div>
                                    </div>
                                ";
                                }
                            } else {
                                echo "<div class='col-12'><p class='text-center'>Nenhum cliente encontrado</p></div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <h4 class="mb-4 mt-4">Quantidade de CEPs por Bairro</h4>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th class="title-table">Bairro</th>
                                    <th class="title-table text-center">Quantidade de CEPs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($resultadoCepPorBairro) && $resultadoCepPorBairro->num_rows > 0) {
                                    while ($bairroCep = $resultadoCepPorBairro->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td>" . $bairroCep['nome_bairro'] . "</td>
                                                <td class='text-center'>" . $bairroCep['quantidade'] . " CEP(s)</td>
                                            </tr>
                                        ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <h4 class="mb-4 mt-4">Bairros com Mais de um CEP</h4>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th class="title-table">Bairro</th>
                                    <th class="title-table text-center">Quantidade de CEPs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($resultadoCepBairroMaiorUm) && $resultadoCepBairroMaiorUm->num_rows > 0) {
                                    while ($bairroCepMaiorUm = $resultadoCepBairroMaiorUm->fetch_assoc()) {
                                        echo "
                                        <tr>
                                            <td>" . $bairroCepMaiorUm['nome_bairro'] . "</td>
                                            <td class='text-center'>" . $bairroCepMaiorUm['quantidade'] . " CEP(s)</td>
                                        </tr>
                                    ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>