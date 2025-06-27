<?php
include_once '../includes/header.php';
include_once "../controllers/TelaListagemEditarController.php";
?>

<body>
    <section id="tela-listagem-editar">
        <div class="container mt-5 mb-5">
            <div class="w-100 text-center">
                <h1>Editar usuario</h1>
            </div>
            <!-- Aqui precisamos enviar o action para que dê um retorno de sucesso ou não, além de enviar os dados para dar o update  -->
            <form method="POST" action="../controllers/TelaListagemEditarController.php">
                <div class="form-group d-none">
                    <input type="text" name="id" value="<?= $usuario['id']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" value="<?= $usuario['nome_completo']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" value="<?= $usuario['cpf']; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" value="<?= $usuario['cep']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" value="<?= $usuario['endereco']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" value="<?= $usuario['bairro']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" value="<?= $usuario['cidade']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" value="<?= $usuario['estado']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero" value="<?= $usuario['numero']; ?>" class="form-control" required>
                </div>
                <div class="w-100">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <?php
                        if ($msg == "success") { ?>
                            <i class="fa-solid fa-check"></i>
                            <h2>Alteração efetuada</h2>
                        <?php } elseif ($msg == "error") { ?>
                            <i class="fa-solid fa-x"></i>
                            <h2>Alteração não realizada</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../js/script.js"></script>
<script>
    <?php if (isset($msg)) { ?>
        $('#exampleModalCenter').modal('show');
        <?php if ($msg == "success") { ?>
            $('input[type="text"]').val('');
            setTimeout(function() {
                window.location.href = "./TelaListagem.php";
            }, 2000);
        <?php } ?>
        <?php if ($msg == "error") { ?>
            $('input[type="text"]').val('');
            setTimeout(function() {
                window.location.href = "./TelaListagem.php";
            }, 2000);
        <?php } ?>
    <?php } ?>
</script>