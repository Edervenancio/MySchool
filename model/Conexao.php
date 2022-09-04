<?php
class Conexao {

    public static $instance;

    // função responsável por iniciar a conexão com o banco de dados
    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(
                "mysql:host=localhost;dbname=myschool;",
                "root",
                "",
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}
