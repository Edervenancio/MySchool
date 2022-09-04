<?php

    require '../model/Conexao.php';

    $classConnect = new Conexao();
    $conexao = $classConnect::get_instance();


    

    if(isset($_GET["t"])){

        $query = $conexao->prepare("SELECT confirmed FROM users WHERE token = ?");

        
        
        $query->execute(array($_GET["t"]));

        if($query->rowCount() == 1){
            $confirmado = $query->fetchAll(PDO::FETCH_ASSOC)[0]["confirmed"];

            if(!$confirmado){
                $generateToken = function () use (&$generateToken, $conexao) {
                    $length = 32;
                    $a = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz");
                    $b = array();
        
                    for ($i = 0; $i < $length; $i++) {
                        $r = rand(0, (sizeof($a) - 1));
                        $b[$i] = $a[$r];
                    }
                    $token = join("", $b);
                    $query = $conexao->prepare("SELECT token FROM users WHERE token = ?");
                    $query->execute(array($token));
                    if ($query->rowCount() > 0) {
                        return $generateToken;
                    } else {
                        return $token;
                    }
                };

                $newToken = $generateToken();

                try{
                    $query2 = $conexao->prepare("UPDATE users SET confirmed = ?, token = ? WHERE token = ?");
                    $query2->execute(array(1, $newToken, $_GET["t"]));

                    echo "Sua conta foi confirmada";
                }catch(PDOException $erro){
                    echo "Erro";
                }
            }else{
                echo "Sua conta ja foi confirmada";
            }
        }else{
            echo "Token não encontrado";
        }
    }
?>