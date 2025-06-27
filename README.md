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

## 📄Explicando Sistema
### funcionalidades principais:
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




 
