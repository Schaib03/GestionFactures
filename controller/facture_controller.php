 <?php
 require_once 'model/facture.php';
 function listeFactureAction(){
     $listeFacture= listeFacture();
     require_once 'view/layout.php';
 }
 function CreerFactureAction(){
    require_once ('facture1.php');
 }
 function storeFacture($d, $m, $e, $idC, $idP) {
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if ($fac->ajouterFacture()) {
       header('Location: index.php');
   } else {
       echo 'Error adding facture';
   }
}
 function editFacture($d, $m, $e, $idC, $idP,$num) {
   require_once ('model/facture.php');
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if($fac->loadFactureByNumero($num)) {
       $fac->modifierFacture($d, $m, $e, $idC, $idP);
       header('Location: index.php');
   }
   else {
       echo 'Error editing facture';
   }
}
function deleteFacture($d, $m, $e, $idC, $idP,$num) {
   require_once ('model/facture.php');
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if($fac->loadFactureByNumero($num)) {
       $fac->supprimerFacture($num);
       header('Location: index.php');
   }
   else {
       echo 'Error deleting facture';
   }
}
 ?>
    