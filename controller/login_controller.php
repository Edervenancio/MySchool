<?php
require '../model/Conexao.php';
require './PHPMAILER/PHPMailer.php';
require './PHPMAILER/SMTP.php';


class SendEmail {

    private $mail = null;


    public function settingsEmail() {
        $this->mail = new PHPMailer\PHPMailer();
        $this->mail->isSMTP();

        $this->mail->Port = "465";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->isHTML(true);

        $this->mail->SMTPSecure = "ssl";
        $this->mail->Mailer = "smtp";
        $this->mail->CharSet = "UTF-8";

        $this->mail->SMTPAuth = True;
        $this->mail->Username = "youremail@local.com";
        $this->mail->Password = "yourpassword";

        $this->mail->SingleTon = true;
        $this->mail->From = "youremail@local.com";
        $this->mail->FromName = "My School";
    }

    public function sendMailCadastro($nome, $email, $token) {
        $file = file_get_contents("../view/templates/cadastro.html");
        $file = str_replace("[NOME_USUARIO]", $nome, $file);
        $file = str_replace("[TOKEN]", $token, $file);

        $this->mail->addAddress($email);
        $this->mail->Subject = "Confirmação de email";
        $this->mail->Body = $file;

        if (!$this->mail->send()) {
            return false;
        }

        return true;
    }


    public function sendMailEsqueci($nome, $email, $token) {
        $file = file_get_contents("../view/templates/esqueci.html");
        $file = str_replace("[NOME_USUARIO]", $nome, $file);
        $file = str_replace("[TOKEN]", $token, $file);

        $this->mail->addAddress($email);
        $this->mail->Subject = "Mudança de senha";
        $this->mail->Body = $file;

        if (!$this->mail->send()) {
            return false;
        }

        return true;
    }
};






class LoginAndCadastro extends SendEmail {
    private $con = null;


    public function __construct($conexao) {
        $this->con = $conexao;
        $this->settingsEmail();
    }


    public function esqueciSenha($email) {
        $conexao = $this->con;

        $query = $conexao->prepare("SELECT email, nome, token FROM users WHERE email = ?");
        $query->execute(array($email));

        if ($query->rowCount() == 1) {
            $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];

            if ($this->sendMailEsqueci($user["nome"], $user["email"], $user["token"])) {
                return json_encode(array("erro" => 2, "mensagem" => "Olá {$user['nome']}, por favor verifique seu email"));
            }
        } else {
            return json_encode(array("erro" => 1, "mensagem" => "Email não encontrado"));
        }
    }

    public function login($email, $passwordUser) {
        $conexao = $this->con;

        $query = $conexao->prepare("SELECT * FROM users WHERE email = ?");

        $query->execute(array($email));

        if ($query->rowCount()) {
            $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];

            if (($user['passwordUser'] == sha1($passwordUser)) && ($user['confirmed'] == 1)) {
                session_start();
                $_SESSION["user"] = array($user["nome"], $user["nivel"], $user["id"]);
                return json_encode(array("erro" => 0));
            }

            if (($user["passwordUser"] == sha1($passwordUser)) && ($user["confirmed"] == 0)) {
                return json_encode(array("erro" => 2, "mensagem" => "Olá {$user['nome']}, por favor ative sua conta"));
            }
        } else {
            return json_encode(array("erro" => 1, "mensagem" => "Email e/ou senha incorretos."));
        }
    }
                                             
                                             

    public function send() {
        if (empty($_POST) || $this->con == null) {
            echo json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro interno no servidor."));
            return;
        }

        switch (true) {
            case (isset($_POST["type"])  && $_POST["type"] == "login" &&
                isset($_POST['passwordUser']) && isset($_POST['email']));
                echo $this->login($_POST['email'], $_POST['passwordUser']);
                break;


            case (isset($_POST["type"]) && $_POST["type"] == "cadastro" && isset($_POST['passwordUser']) && isset($_POST['email'])
                &&    isset($_POST['nome']) && isset($_POST['id']) && isset($_POST['phone']) && isset($_POST['birth']));
                echo $this->cadastro(
                    $_POST['passwordUser'],
                    $_POST['email'],
                    $_POST['nome'],
                    $_POST['id'],
                    $_POST['phone'],
                    $_POST['birth']
                );
                break;

            case (isset($_POST["type"])  && $_POST["type"] == "esqueci" && isset($_POST['email']));
                echo $this->esqueciSenha($_POST['email']);
                break;
        }
    }


    public function cadastro($passwordUser, $email, $nome, $id, $phone, $birth) {
        $conexao = $this->con;


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

        $token = $generateToken();
        /*
        $queryEmail = $conexao->prepare("SELECT email from users WHERE email = ?");
        $queryEmail->execute(array($email));
        
        if ($queryEmail->rowCount() == 1) {
            return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao cadastrar usuario. Email em uso"));
            exit();
        }
        echo '<pre>';
        var_dump($queryEmail->rowCount());
        echo '</pre>';
*/



        $query = $conexao->prepare("INSERT INTO users (passwordUser, email, nome, id, phone, birth, nivel, confirmed, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($query->execute(array(sha1($passwordUser), $email, $nome, $id, $phone, $birth, "U", 0, $token))) {
            if ($this->sendMailCadastro($nome, $email, $token)) {
                return json_encode(array("erro" => 2));
            }
        } else {
            return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao cadastrar usuario."));
        }
    }
};

$conexao = new Conexao();
$classe = new LoginAndCadastro($conexao::get_instance());
$classe->send();
