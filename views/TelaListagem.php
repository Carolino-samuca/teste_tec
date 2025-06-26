<?php
include_once '../includes/header.php';
include_once "../controllers/TelaListagemController.php";
?>

<body>
    <section id="tela-listagem" class="d-flex justify-content-center align-items-center mt-5 mb-5 ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container">
                    <div class="w-100 text-center mb-3">
                        <h1>Usuários</h1>
                    </div>
                    <div class="w-100 text-center mt-3 mb-3">
                        <a href="../index.php">
                            <button type="button" class="btn btn-primary">cadastrar</button>
                        </a>
                        <a href="../views/TelaPesquisa.php">
                            <button type="button" id="btn-relatorio" class="btn btn-primary" disabled>Relatótio</button>
                        </a>
                    </div>
                    <form class="form-inline justify-content-center mt-4 mb-3" method="POST" action="">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="pesquisa" class="sr-only">Pesquisar CEP e CPF</label>
                            <input type="text" class="form-control" id="inputPassword2" name="pesquisa" placeholder="Pesquisar">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2" name="acao" value="pesquisar">Pesquisar</button>
                    </form>
                    <div class="d-flex justify-content-center table-fundo">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th class="title-table" scope="col">Nome</th>
                                    <th class="title-table text-center" scope="col">CPF</th>
                                    <th class="title-table text-center" scope="col">CEP</th>
                                    <th class="title-table text-center" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    $count = 0;
                                    while ($usuario = $result->fetch_assoc()) {
                                        $count++;
                                        echo "
                                            <tr>
                                                <td class='table-line'>" . $usuario["nome_completo"] . "</td>
                                                <td class='text-center table-line'>" . $usuario["cpf"] . "</td>
                                                <td class='text-center table-line'>" . $usuario["cep"] . "</td>
                                                <td class='text-center'>
                                                    <a href='TelaListagemEditar.php?id=" . $usuario["id"] . "' class='btn-pen mt-1'><i class='fa-solid fa-pen-to-square'></i></a>
                                                    <a href='../controllers/TelaListagemApagarController.php?id=" . $usuario["id"] . "' class='btn-trash mt-1'><i class='fa-solid fa-trash'></i></a>
                                                    </td>
                                            </tr>
                                        ";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>Nenhum cliente encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <?php
                                if ($msg == "success") { ?>
                                    <i class="fa-solid fa-check"></i>
                                    <h2>Cadastro Apagado</h2>
                                <?php } elseif ($msg == "error") { ?>
                                    <i class="fa-solid fa-x"></i>
                                    <h2>Cadastro não apagado</h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<script src="../js/script.js"></script>
<script>
    <?php if ($count >= 10) { ?>
        let mostrarBotao = document.getElementById('btn-relatorio');
        mostrarBotao.removeAttribute('disabled');
    <?php } ?>

    <?php if (isset($msg)) { ?>
        $('#exampleModalCenter').modal('show');
        <?php if ($msg == "success") { ?>
            setTimeout(function() {
                window.location.reload();
            }, 2000);
        <?php } ?>
        <?php if ($msg == "error") { ?>
            setTimeout(function() {
                window.location.reload();
            }, 2000);
        <?php } ?>
    <?php } ?>
</script>