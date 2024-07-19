<?php
require_once 'controller/client_controller.php';
require_once 'modifClient.php';
$d=$_POST['nom'];
$m=$_POST['adresse'];
$e=$_POST['email'];
$te=$_POST['tel'];
$num=$_POST['idClient'];
editClient($d, $m, $e, $te,$num);
?>