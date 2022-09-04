<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <form method="POST" action="../controller/login_controller.php">
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

                <div class="col-md-6 mt-2">
                    <button class="btn btn-primary btn-lg">Entrar<i class="fa fa-user-plus"></i></button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>