<?php
    session_start();
    require '../model/Conexao.php';

    $classConnect = new Conexao();
    $conexao = $classConnect::get_instance();

    $_POST["id"] = $_SESSION["user"][2];

    if((isset($_POST["id"]) && isset($_SESSION["user"]) && $_SESSION["user"][1] == "A")){
        $query = $conexao->prepare("DELETE FROM users WHERE id = ?");
        if($query->execute(array($_POST["id"]))){
            echo json_encode(array("erro" => 0));
        }else{
            echo json_encode(array("erro" => 1));    
        }
    }else{
        echo json_encode(array("erro" => 1));
    }
?>