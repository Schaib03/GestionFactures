<?php
require_once 'controller/paiement_controller.php';
$n=$_POST['dateP'];
$a=$_POST['montant'];
$e=$_POST['methode'];
storePaiement($n, $a, $e);
?>