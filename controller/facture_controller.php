<?php
 require_once 'model/facture.php';
 function storeFacture($d, $m, $e, $idC, $idP) {
     try {
        $fac = new Facture($d, $m, $e, $idC, $idP);
        $fac->ajouterFacture();
        header('Location: view/layout.php');
        exit();      
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
    
}
 function editFacture($d, $m, $e, $idC, $idP,$num) {
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if($fac->loadFactureByNumero($num)) {
       $fac->modifierFacture($d, $m, $e, $idC, $idP);
       header('Location: view/layout.php');
   }
   else {
       echo 'Error editing facture';
   }
}
function deleteFacture($d, $m, $e, $idC, $idP,$num) {
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if($fac->loadFactureByNumero($num)) {
       $fac->supprimerFacture($num);
       header('Location: view/layout.php');
   }
   else {
       echo 'Error deleting facture';
   }
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>