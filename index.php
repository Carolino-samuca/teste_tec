<?php
include_once 'includes/header.php';
session_start();
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
?>

<body>
    <section id="tela-cadastro">
        <div class="container">
            <div class="mt-5 mb-5">
                <!-- Envio do formulario usando o "onsumit" assim é possível chamar uma função de verificação antes que envie o formulário para o banco -->
                <form class="tabela-cadastro" method="POST" action="./controllers/CadastroController.php" onsubmit="return validarCampos()">
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" aria-describedby="emailHelp" placeholder="Nome Completo" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" maxlength="11" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                        <small id="validacaoCPF" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" maxlength="9" class="form-control" id="cep" name="cep" placeholder="CEP" required>
                        <small id="validacaoCEP" class="form-text"></small>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" required>
                    </div>
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" required>
                    </div>

                    <div class="h-100 w-100 mt-5 btn-submit">
                        <button type="submit" class="text-end btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <?php
                        if ($msg == "success") { ?>
                            <i class="fa-solid fa-check"></i>
                            <h2>Cadastro efetuado</h2>
                        <?php } elseif ($msg == "error") { ?>
                            <i class="fa-solid fa-x"></i>
                            <h2>Cadastro mal sucedido, CPF duplicado</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script src="js/script.js"></script>
<script>
    //Quando enviamos os dados do form para o banco e ele retorna a resposta em GET
    //Após isso colocamos em um condição simples que irá fazer aparecer o modal dando a reposta
    //Assim ele redireciona para a tela de listagem de usuários.
    <?php if (isset($msg)) { ?>
        $('#exampleModalCenter').modal('show');
        <?php if ($msg == "success") { ?>
            setTimeout(function() {
                window.location.href = "./views/TelaListagem.php";
            }, 2000);
        <?php } ?>
        <?php if ($msg == "error") { ?>
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        <?php } ?>
    <?php } ?>
</script>