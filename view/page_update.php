<?php

include_once '../model/Conexao.php';
include_once '../model/Manager.php';
include_once './dependencias.php';

$manager = new Manager();


$id = $_POST["id"];

echo '<pre>';
var_dump($id);
echo '</pre>';
?>

<h2 class="text-center"> Página de Atualização <i class="fa fa-user-edit"></i></h2><hr>

<form method="POST" action="../controller/update_client.php">
    <div class="container">
        <div class="form-row">
        <?php foreach($manager->getInfo("users", $id) as $user): ?>
        <div class="col-md-6">
                Ra: <i class="fa fa-key"></i>
                <input class="form-control" type="text" name="id" required autofocus value="<?= $user['id'] ?>"><br>
            </div>

            <div class="col-md-6">
                Nome: <i class="fa fa-user"></i>
                <input class="form-control" type="text" name="nome" value="<?= $user['nome'] ?>"required><br>
            </div>
        
            <div class="col-md-6">
                Email: <i class="fa fa-envelope"></i>
                <input class="form-control" type="text" name="email" value="<?= $user['email'] ?>"required><br>
            </div>

            <div class="col-md-4">
                Dt. De nascimento <i class="fa fa-calendar"></i>
                <input class="form-control" type="date" name="birth" value="<?= $user['birth'] ?>"required><br>
            </div>

            <div class="col-md-4">
                Telefone: <i class="fab fa-whatsapp"></i>
                <input class="form-control" type="text" name="phone" id="phone" value="<?= $user['phone'] ?>"required><br>
            </div>

            <div class="col-md-6">

                <input type="hidden" name="id" value="<?= $user['id'] ?>">
            
                <br><button class="btn btn-warning btn-lg">Atualizar<i class="fa fa-user-edit"></i></button>
           
            <a href="..index.php">

            </a>
            </div>

            <?php endforeach; ?>
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

