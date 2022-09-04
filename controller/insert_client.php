<?php

include_once '../model/Conexao.php';
include_once '../model/Manager.php';


$manager = new Manager();

$data = $_POST;

if(isset($data) && !empty($data)){
    $manager->insertClient("users", $data);
    header("Location: ../index.php?client_add_sucess");
}

?>