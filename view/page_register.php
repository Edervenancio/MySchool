<?php

include_once 'dependencias.php';

?>

<h2 class="text-center"> Página de registro <i class="fa fa-user-plus"></i></h2><hr>

<form method="POST" action="../controller/insert_client.php">
    <div class="container">
        <div class="form-row">

        <div class="col-md-6">
                Ra: <i class="fa fa-key"></i>
                <input class="form-control" type="text" name="id" id="id" required autofocus><br>
            </div>

            <div class="col-md-6">
                Nome: <i class="fa fa-user"></i>
                <input class="form-control" type="text" name="nome" required><br>
            </div>
        
            <div class="col-md-6">
                Email: <i class="fa fa-envelope"></i>
                <input class="form-control" type="text" name="email" required><br>
            </div>

            <div class="col-md-4">
                Dt. De nascimento <i class="fa fa-calendar"></i>
                <input class="form-control" type="date" name="birth" required><br>
            </div>

            <div class="col-md-4">
                Telefone: <i class="fab fa-whatsapp"></i>
                <input class="form-control" type="text" name="phone" id="phone" required><br>
            </div>

            <div class="col-md-4">
                Senha: <i class="fa fa-lock"></i>
                <input class="form-control" type="text" name="passwordUser" id="passwordUser" required><br>
            </div>

            <label class="form-label" for="nivel">Nível de acesso:</label>
                    <select name="nivel" id="nivel" class="form-select">
                        <option value="A" selected>Administrador</option>
                        <option value="U">Usuário</option>
                    </select>

            <div class="col-md-6">
                <br><button class="btn btn-primary btn-lg">Registrar<i class="fa fa-user-plus"></i></button>
           
            <a href="..index.php">
                Voltar 
            </a>
            </div>


        </div>
    </div>
    
</form>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> 

<script type="text/javascript">
    $(document).ready(function(){
       $("#phone").mask("(00) 00000-0000"); 
       $("#id").mask("000000000-0");
    });
</script>

