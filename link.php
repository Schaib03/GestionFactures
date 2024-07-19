<?php
require_once 'controller/utilisateurController.php';
require_once 'model/utilisateur.php';
if (isset($_POST['login'])) {
    $n = $_POST['nom'];
    $l = $_POST['login'];
    $p = $_POST['psw'];
    
    try {
        storeUtilisateur($n, $l, $p);
        echo "User stored successfully.";
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Error: Login not set.";
}


?>