<?php
session_start();

require '../model/Conexao.php';
$conexao = Conexao::get_instance();

if (isset($_SESSION["user"]) && is_array($_SESSION["user"])) {
    $nome = $_SESSION["user"][0];
    $nivel = $_SESSION["user"][1];
    $id = $_SESSION["user"][2];
} else {
    echo "<script>window.location = '../index.php'</script>";
}
?>
<html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../assets/style/dashboard.css" />
    <title>Dashboard - <?php echo $nome; ?></title>
    <?php
    if ($nivel == "A") {
    ?>
        <script type="text/javascript" src="../assets/script/jquery"></script>
        <script type="text/javascript" src="../assets/script/excluirUsuario.js"></script>




    <?php } ?>

    <?php include_once './dependencias.php'; ?>

</head>

<body>
    <header>
        <div id="content">
            <div id="user">
                <span><?php

                        if ($nivel == "A") {
                            echo $nivel ? $nome . " (ADM)" : $nome;
                        } else {
                            echo  $nivel ? $nome . " (USER) " : $nome;
                            echo '<br>';
                        } ?></span>
            </div>
            <span class="logo" style="padding-bottom:20px">Sistema de acesso</span>
            <div id="logout">
                <a href="../model/logout.php"><button>Sair</button></a>
            </div>
        </div>
    </header>

    <div id="content">
        <?php if ($nivel == "A") : ?>
            <div id="tabelaUsuarios">
                <span class="title">Lista de usuários</span>

                <table>
                    <thead>
                        <tr>
                            <td>Email</td>
                            <td>Telefone</td>
                            <td>Data de nascimento</td>
                            <td>Nome</td>
                            <td>Nível</td>
                            <td>RA</td>
                            <td>AÇÕES</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $conexao->prepare("SELECT email, nome, nivel, id, phone, birth FROM users WHERE nivel != ?");
                        $query->execute(array($nivel));

                        $users = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 0; $i < sizeof($users); $i++) :
                            $usuarioAtual = $users[$i];
                        ?>
                            <tr>
                                <td><?php echo $usuarioAtual["email"]; ?></td>
                                <td><?php echo $usuarioAtual["phone"]; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($usuarioAtual['birth'])) ?></td>
                                <td><?php echo $usuarioAtual["nome"]; ?></td>
                                <td><?php echo $usuarioAtual["nivel"]; ?></td>
                                <td><?php echo $usuarioAtual["id"]; ?></td>


                                <td>
                                    <form method="POST" action="./page_update.php">
                                        <input type="hidden" name="id" value="<?= $usuarioAtual['id'] ?>">                   
                                        <button class="btn btn-warning btn-xs">
                                            <i class="fa fa-user-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="../controller/delete_client.php" onclick="return confirm('Tem certeza que deseja excluir ?');">
                                        <input type="hidden" name="id" value="<?= $usuarioAtual['id'] ?>">

                                        <button class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>