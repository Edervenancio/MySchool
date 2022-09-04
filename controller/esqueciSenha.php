<?php
    require("../model/Conexao.php");

    $classConnect = new Conexao();
    $conexao = $classConnect::get_instance();

    if(isset($_GET["t"]) && isset($_POST["passwordUser"])){
        $generateToken = function() use(&$generateToken, $conexao){
            $length = 32;
            $a = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz");
            $b = array();

            for($i = 0; $i < $length; $i++){
                $r = rand(0, (sizeof($a) - 1));
                $b[$i] = $a[$r];
            }

            $token = join("", $b);
            
            $query = $conexao->prepare("SELECT token FROM users WHERE token = ?");
            $query->execute(array($token));

            if($query->rowCount() > 0){
                return $generateToken();
            }else{
                return $token;
            }
        };

        $newToken = $generateToken();

        try{
            $query = $conexao->prepare("UPDATE users SET passwordUser = ?, token = ? WHERE token = ?");
            $query->execute(array(sha1($_POST["passwordUser"]), $newToken, $_GET["t"]));

            echo "Sua senha foi atualizada";
        }catch(PDOException $erro){
            echo "Erro";
        }
    }
?>

<form action="#" method="post">
    <input type="password" name="passwordUser" />
    <input type="submit" value="enviar" />
</form>