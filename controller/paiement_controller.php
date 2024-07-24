<?php 
require_once 'model/paiement.php';
function storePaiement($n, $a, $e) {
    $paiement = new Paiement($n, $a, $e);
    if ($paiement->ajouterPaiement()) {
        header('Location: view/paiementLayout.php');
    } else {
        echo 'Error adding paiement';
    }
}
function editPaiement($n, $a, $e, $num) {
    require_once ('model/paiement.php');
    $paiement = new Paiement($n, $a, $e);
    if($paiement->loadPaiementById($num)) {
        $paiement->modifierPaiement($num,$n, $a, $e);
        header('Location: view/paiementLayout.php');
    }
    else {
        echo 'Error';
    }
}

function deletePaiement($dateP, $montant, $methode, $num) {
    require_once ('model/paiement.php');
    $paiement = new paiement($dateP, $montant, $methode);
    if($paiement->loadPaiementById($num)) {
        $paiement->supprimerPaiement($num);
        header('Location: view/paiementLayout.php');
    }
    else {
        echo 'Error deleting paiement';
    }
 }
?>
