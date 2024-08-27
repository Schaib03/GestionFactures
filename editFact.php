<?php
require_once 'controller/facture_controller.php';
$d=$_POST['date'];
$m=$_POST['montantTotal'];
$e=$_POST['etat'];
$iC=$_POST['idC'];
$iP=$_POST['idP'];
$num=$_POST['num'];
$pdo=dbC_connect();
$query='SELECT montant FROM paiement  WHERE idPaiement = :idPaiement';
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idPaiement', $iP);
$stmt->execute();

$montant = $stmt->fetch(PDO::FETCH_OBJ);
$montant = $montant->montant;
if ($montant > $m) {
    echo "<script>
        alert('Le montant du paiement ne doit pas depasser le montant de la facture');
        setTimeout(function() {
            window.location.href = 'view/layout.php';
        }, 1000); // 1 second delay
    </script>";
} else if ($montant>0 && ($montant < $m) && ($e == "Payée" || $e == "Impayée")) {
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
    editFacture($d, $m, $e, $iC, $iP, $num);
}
?>

