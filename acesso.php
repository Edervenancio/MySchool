<?php
session_start();

if (isset($_SESSION["user"]) && is_array($_SESSION["user"])) {
    echo "<script>window.location = './view/dashboard.php'</script>";
}
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de acesso</title>
    <link rel="stylesheet" type="text/css" href="./assets/style/acesso.css" />
    <script type="text/javascript" src="./assets/script/jquery.js"></script>
    <script type="text/javascript" src="./assets/script/acesso.js"></script>
</head>

<body>
    <header>Sistema de acesso</header>

    <div id="subheader">
    <ol>
        <li><a href="./index.html">Home</a></li>
        <li><a href="./view/contato.html">contato</a></li>


    </ol>



    </div>


    <div id="mensagem" ></div>

    <div id="formulario">
            <form id="formularioLogin">
                <span class="title">Acesse sua conta</span>

                <div id="linha">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" />
                </div>

                <div id="linha" class="passwordUser">
                    <label for="senha">Senha</label>
                    <input type="password" name="passwordUser" id="passwordUser" />
                </div>

                <div id="button">
                    <button id="btnEntrar">Entrar</button><br><br>
                    <a href="javascript:void(0)" id="esqueciSenha">Esqueci minha senha</a>
                </div>
            </form>





        
        <form id="formularioCadastro">
                <span class="title">Crie sua conta</span>

                <div id="linha">
                    <label for="nomeCadastro">Nome</label>
                    <input type="text" name="nomeCadastro" id="nomeCadastro" />
                </div>

                <div id="linha">
                    <label for="raCadastro">RA</label>
                    <input type="text" name="raCadastro" id="raCadastro" />
                </div>

                <div id="linha">
                    <label for="telefoneCadastro">Telefone</label>
                    <input type="text" name="telefoneCadastro" id="telefoneCadastro" />
                </div>

                <div id="linha">
                    <label for="emailCadastro">Email</label>
                    <input type="text" name="emailCadastro" id="emailCadastro" />
                </div>
               
                <div id="linha">
                <label for="nascimentoCadastro">Dt. Nascimento (Mês/Dia/Ano)</label>
                <input class="form-control" type="date" name="nascimentoCadastro" id="nascimentoCadastro">
                </div>

                <div id="linha">
                    <label for="senhaCadastro">Senha</label>
                    <input type="password" name="senhaCadastro" id="senhaCadastro" />
                </div>

                <div id="button">
                    <button id="btnCadastrar">Cadastrar</button>
                </div>

            </form>

            
            <div id="textoCadastro">
                <span class="title">Não possui uma conta?</span>
                <span class="subtitle">Crie uma conta agora para acessar todas as ferramentas. É de graça!</span>
                <button id="btnCadastro"  class="change">Cadastre-se</button>
            </div>

            <div id="textoLogin">
                <span class="title">Já possui uma conta?</span>
                <span class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam modi, et iusto explicabo amet libero saepe quos impedit quisquam ut, ex tempora.</span>
                <button id="btnLogin" class="change">Entrar</button>
            </div>
    


    </div>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> 

    <script type="text/javascript">
    $(document).ready(function(){
       $("#telefoneCadastro").mask("(00) 00000-0000"); 
       $("#raCadastro").mask("000000000-0");
    });
</script>
</body>

</html>