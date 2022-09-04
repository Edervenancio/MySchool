<?php

session_start();

echo '<pre>';
var_dump($_SESSION['user']);
echo '</pre>';

if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
    $nivel = $_SESSION['user'][1];
    $nome = $_SESSION['user'][0];
    require('../model/Conexao.php');
} else {
    header("Location: ./login.php");
}

$conexao = conexao::get_instance();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>

<body>
    <?php if ($nivel == "A") : ?>
        <table width="40%">
            <thead>
                <tr style="font-weight: bold">
                    <td>Email</td>
                    <td>Data de nascimento</td>
                    <td>Nome</td>
                    <td>ADM</td>
                    <td>ID</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $conexao->prepare("SELECT * FROM users");
                $query->execute();

                $users = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < sizeof($users); $i++) :
                    $usuarioAtual = $users[$i];
                ?>
                    <tr>
                        <td><?php echo $usuarioAtual["email"]; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($usuarioAtual['birth'])) ?></td>
                        <td><?php echo $usuarioAtual["nome"]; ?></td>
                        <td><?php echo $usuarioAtual["nivel"]; ?></td>
                        <td><?php echo $usuarioAtual["id"]; ?></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="./logout.php">Sair</a>
</body>

</html>