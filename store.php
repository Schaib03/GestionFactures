<?php
require_once 'controller/facture_controller.php';
$d=$_POST['date'];
$m=$_POST['montantTotal'];
$e=$_POST['etat'];
$iC=$_POST['idC'];
$iP=$_POST['idP'];
storeFacture($d, $m, $e, $iC, $iP);
?>