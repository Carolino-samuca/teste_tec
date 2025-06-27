# Crud de cadasdro de usuário
 ### Resumo
 Nesse sistema temos a primícia de cadastro de usuário contendo seu CEP, CPF, endereço, nome, número, cidade e bairro.
 Com isso a proposta feita para o maior desenvolvimento e desafio se volta em nos fatores do título, a criação, a leitura ( juntamente com uma barra de pesquisa ), a inclusão de novos 
 arquivos e a exclusão.

 ## 💻 Tecnologias usadas
- JavaScript
- PHP
- Bootstrap
- HTML / CSS

## 📌Pontos de atenção
### Configurar o banco de dados:
Para a configuração foi deixado um arquivo '.sql' dentro da pasta sql do projeto, nela contém a criação do banco de dados juntamente de sua tabelas que foram usadas nesse projeto

### Rsponsividade:
todo o projeto foi pensado e planejado tanto para o desktop quanto para o smartphone e outros dispositivos.

### Configurar e rodar o projeto:
Todo o projeto foi feito em '.php' para rodar e testar lembre-se de baixar o xamp e ativá-lo ( tanto o Apache quanto o MySQL), colocar o arquivo em htdocs e por fim colocar no navegador o link **http://localhost/teste_tec/index.php** ( lembrando que 
tem que ser o mesmo nome que o arquivo ).
Outro ponto de atenção, para rodar o projeto vá no arquivo 'Connection.php' localizado na pasta 'includes', no meu caso coloquei o acesso ao banco pela porta 3307, na maioria dos casos pode deixar no padrão que é 3306.

## 📄Explicando Sistema
### Tela incial:
Como todo sistema de cadatro ele tem que tem o registo no banco de dados a partir de informações retirada de um form. Nesse 
caso aplicamos o método POST para enviar ao arquivo **/controllers/CadastroController.php** nele haverá o prcessamento e colocará um valor na url para o retorno a página 
notificando se houve ou não exeto,

```PHP
try {
    if ($stmt->execute()) {
        header("Location:../index.php?msg=success");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    header("Location:../index.php?msg=error");
    exit();
}
```
Além de um retorno visual para o usuário a partir de um modal feito em bootstrap com condição em javascrit, e enfim direcionando para outra parte do sistema

![image](https://github.com/user-attachments/assets/04dffc1a-8020-476e-8208-b04e41142134)

Também temos o verificador de CPF, retornando em tempo real ( a cada novo valor inserido ou retirado ) se é válido ou não, juntamente com uma 
função que busca o CEP informado e completando as informações de endereço e afins do usário cadastrado.

### Tela de Listagem
Após o cadastro o sistema redireciona o usuário para a parte de listagem de todos os usuários cadastrado, exibindo o CEP, nome e CPF. Nesse caso 
tive a liberdade de criar 2 novas funções:
- Colocar um botão que redireciona para fazer novos cadastros;
- E uma barra de pesquisa para buscar algum usuário em específico e fazer a alteração ou exclusão,

Assim, seguindo roteiro de criação o botão de relatório ficará válido somente se o banco de dados tiver a quantidade de 10 ou mais usuários. Possibilitando 
visualizar a quantidade de CEP's por bairro e quais bairros tem mais que um CEP.

![image](https://github.com/user-attachments/assets/a517559b-ffec-49ac-b315-971e4cc42d19)

### Tela de edição
Nela temos o comum, podendo editar todos os campos que originalmente foi cadastrado, menos o CPF, já que ele foi conferido como válido no início, mas se precisa é fácil modicar isso no projeto
```JavaScript
<input type="text" name="cpf" value="<?= $usuario['cpf']; ?>" class="form-control" readonly>
```
Retirando apenas o "readonly" do input.

![image](https://github.com/user-attachments/assets/edfdaedb-20f6-440a-9f9a-986b5c829af1)
![image](https://github.com/user-attachments/assets/773a48e4-81d6-4ed5-bac3-f3b462cdff6e)


### Tela de Relatório
Nessa tela coloquei o os dois pontos de filtros ( quantidade de CEP's por bairro e quais bairros tem mais que um CEP ), como elementos no sistema, 
mas sempre que entrar nessa tela os dados sempre serão atualizados com as informações corretas. E novamente, para agilizar e melhorar a experiência do usuário, nessa parte eu coloquei dois botões para retornar tanto a tela de listagem 
quanto na tela de cadastrar usuário.

![image](https://github.com/user-attachments/assets/bdc2d2e8-4844-4261-91be-1e660045292b)
![image](https://github.com/user-attachments/assets/786db4dd-9067-4dda-867f-8626d5ab50a8)
![image](https://github.com/user-attachments/assets/e7ede918-1148-4401-b026-6f13a01cde94)



Também coloquei as informações de filtro da pesquisa em forma de cards, dessa forma ficará uma melhor visualização de dados tanto em desktops quanto em smartphones. 
Outro ponto seria que a pesquisa defeult traz somente 3 cards de exemplo para não poluir visualmente a tela, mas também pode ser facilmente alterado no código.
```PHP
if ($_POST['pesquisa'] == "") {
 $sql = "SELECT * FROM usuarios LIMIT 3"; // aqui limitei a quantidade que vai retornar, se não puxaria todo o banco de dados
 $result = $conn->query($sql);
}
```
![image](https://github.com/user-attachments/assets/d138ec7b-7641-4bc6-9f7f-bea513c1d04f)
