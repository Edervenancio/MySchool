<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST" action="../MySchool/controller/login_controller.php">
    <div class="container">
        <div class="form-row">

      
            <div class="col-md-6">
                Email: <i class="fa fa-envelope"></i>
                <input class="form-control" type="text" name="email" required><br>
            </div>
         
            <div class="col-md-4">
                Senha: <i class="fa fa-lock"></i>
                <input class="form-control" type="password" name="passwordUser" id="passwordUser" required><br>
            </div>

            <div class="col-md-6">
                <br><button class="btn btn-primary btn-lg">Entrar<i class="fa fa-user-plus"></i></button>
           
            </div>


        </div>
    </div>
    
</form>


</body>
</html>