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
    try {
        // Assuming $d, $m, $e, $idC, and $idP are already defined
        $fac = new Facture($d, $m, $e, $idC, $idP);
        
        if ($fac->ajouterFacture()) {
            header('Location: view/layout.php');
            exit(); // Make sure to call exit after header redirection
        } else {
            echo 'Error adding facture';
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
    
}
 function editFacture($d, $m, $e, $idC, $idP,$num) {
   require_once ('model/facture.php');
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
   require_once ('model/facture.php');
   $fac = new Facture($d, $m, $e, $idC, $idP);
   if($fac->loadFactureByNumero($num)) {
       $fac->supprimerFacture($num);
       header('Location: view/layout.php');
   }
   else {
       echo 'Error deleting facture';
   }
}
 ?>
    