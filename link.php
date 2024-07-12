<?php
require_once 'controller/utilisateurController.php';
$n=$_POST['nom'];
$l=$_POST['login'];
$p=$_POST['psw'];
storeUtilisateur($n, $l, $p);
?>