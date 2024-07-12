<?php
require_once 'controller/facture_controller.php';
$d=$_POST['date'];
$m=$_POST['montantTotal'];
$e=$_POST['etat'];
$iC=$_POST['idC'];
$iP=$_POST['idP'];
require_once 'modifFact.php';
$num=$_POST['num'];
editFacture($d, $m, $e, $iC, $iP,$num);
?>