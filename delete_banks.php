<?php
require_once 'models/BankModel.php';
$bankModel = new BankModel();

$id = NULL;
$user_id = NULL; //Add new user

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $bankModel->deleteUserById($id);//Delete existing banks
}
header('location: list_banks.php');
?>