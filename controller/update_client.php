<?php

include_once '../model/Conexao.php';
include_once '../model/Manager.php';

$manager = new Manager();

$update_client = $_POST;
$id = $_POST['id'];

if(isset($id) && !empty($id)){
    $manager->updateClient("users", $update_client, $id);
    header("Location: ../view/dashboard.php");
} else {
    echo "Erro!";
}

echo '<pre>';
var_dump($id);
echo '</pre>';


