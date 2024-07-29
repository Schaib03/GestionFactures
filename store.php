<?php
require_once 'controller/facture_controller.php';

$d=$_POST['date'];
$m=$_POST['montantTotal'];
$e=$_POST['etat'];
$iC=$_POST['idC'];
$iP=$_POST['idP'];
$montant = $_POST['mont'];
if ($montant > $m) {
    echo "<script>
        alert('Le montant du paiement ne doit pas depasser le montant de la facture');
        setTimeout(function() {
            window.location.href = 'view/layout.php';
        }, 1000); // 1 second delay
    </script>";
} else if ((0< $montant && $montant < $m) && ($e == "Payée" || $e == "Impayée")) {
    echo "<script>
        alert('L\'état de la facture doit etre : Partiellement payée');
        setTimeout(function() {
            window.location.href = 'view/layout.php';
        }, 1000); // 1 second delay
    </script>";
} else if ($montant == $m && $e != "Payée") {
    echo "<script>
        alert('L\'état de la facture doit etre : Payée');
        setTimeout(function() {
            window.location.href = 'view/layout.php';
        }, 1000); // 1 second delay
    </script>";
} else {
    storeFacture($d, $m, $e, $iC, $iP);
}
?>