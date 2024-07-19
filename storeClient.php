<?php
require_once 'controller/client_controller.php';
$n=$_POST['nom'];
$a=$_POST['adresse'];
$e=$_POST['email'];
$t=$_POST['tel'];
storeClient($n, $a, $e, $t);
?>