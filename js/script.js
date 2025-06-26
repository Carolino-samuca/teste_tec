 //Função para retorno se há campos importantes vazios ou não além de verificar se o CPF e CEP estão corretos
    function validarCampos() {
        let validacaoCPF = document.getElementById("validacaoCPF");
        let validacaoCEP = document.getElementById("validacaoCEP");

        if (validacaoCPF.classList.contains("text-danger") ) {
            alert("Por favor, insira um CPF válido.");
            return false;
        }else if (validacaoCEP.classList.contains("text-danger")){
            alert("Por favor, insira um CEP válido.");
            return false
        }

        return true;
    }

    //Funcionalidade para retirar a mensagem do get que rebemos após cadastrar um usuário
    // se retirar a mensagem vai ficar aparecendo reptidas vezes, mesmo que tente sair
    if (window.location.search.includes("msg=")) {
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({
            path: newUrl
        }, "", newUrl);
    }

    // Validação de CPF, temos a função que escuta cada vez que é inserido o valor
    // dessa forma ao terminar de digitar sairá se o cpf é valido ou não por meio de uma mensagem de texto
    const cpf = document.getElementById("cpf");
    const validacao = document.getElementById("validacaoCPF");

    cpf.addEventListener("input", () => {
        if (validarCPF(cpf.value)) {
            validacao.textContent = "CPF válido.";
            validacao.className = "form-text text-success";
        } else {
            validacao.textContent = "CPF inválido.";
            validacao.className = "form-text text-danger";
        }
    });

    // Função para fazer o cálculo dos dígitos do CPF
    function validarCPF(cpf) {

        let soma = 0;

        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf[i]) * (10 - i);
        }

        digito1 = soma % 11;
        if (digito1 < 2) {
            digito1 = 0;
        } else {
            digito1 = 11 - digito1;
        }

        soma = 0;

        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf[i]) * (11 - i);
        }

        digito2 = soma % 11;

        if (digito2 < 2) {
            digito2 = 0;
        } else {
            digito2 = 11 - digito2;
        }

        if (digito1 != parseInt(cpf[9]) || digito2 != parseInt(cpf[10])) {
            return false;
        } else {
            return true;
        }

    }

    // Aqui temos a API para a busca do CEP
    let cep = document.getElementById("cep");
    cep.addEventListener("input", function() {
        const cep = this.value.replace(/\D/g, '');
        const mensagem = document.getElementById("validacaoCEP");


        fetch(`https://viacep.com.br/ws/${cep}/json/`) //retorna um jason, assim podemos pegar as informações do array recebidos
            .then(response => response.json())
            .then(dados => {
                if (dados.erro) {
                    mensagem.textContent = "CEP não encontrado.";
                    mensagem.className = "form-text text-danger";
                    
                }
                else{
                    mensagem.textContent = "CEP encontrado.";
                    mensagem.className = "form-text text-success";

                }

                document.getElementById("endereco").value = dados.logradouro;
                document.getElementById("bairro").value = dados.bairro;
                document.getElementById("cidade").value = dados.localidade;
                document.getElementById("estado").value = dados.estado;

            })
            .catch(() => {
                mensagem.textContent = "Erro ao buscar o endereço.";
                mensagem.className = "form-text text-danger";
            });
    });