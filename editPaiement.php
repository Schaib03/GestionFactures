<?php
require_once 'controller/paiement_controller.php';
$d=$_POST['dateP'];
$mo=$_POST['montant'];
$me=$_POST['methode'];
$num=$_POST['idPaiement'];
editPaiement($d, $mo, $me, $num);
?>