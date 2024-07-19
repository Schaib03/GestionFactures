<?php 
require_once 'model/client.php';
function storeClient($n, $a, $e, $t) {
    $client = new Client($n, $a, $e, $t);
    if ($client->ajouterClient()) {
        header('Location: view/clientLayout.php');
    } else {
        echo 'Error adding client';
    }
}


function deleteClient($nom, $adresse, $email, $te,$num) {
    require_once ('model/client.php');
    $fac = new client($nom, $adresse, $email, $te);
    if($fac->loadClientById($num)) {
        $fac->supprimerClient($num);
        header('Location: view/clientLayout.php');
    }
    else {
        echo 'Error deleting facture';
    }
 }

function editClient($n, $a, $e, $te,$num) {
    require_once ('model/client.php');
    $client = new client($n, $a, $e, $te);
    if($client->loadClientById($num)) {
        $client->modifierClient($num,$n, $a, $e, $te);
        header('Location: view/clientLayout.php');
    }
    else {
        echo 'Error';
    }
}