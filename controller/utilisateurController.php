<?php
require_once 'model/utilisateur.php';
function storeUtilisateur($n,$l,$p) {
   $user = new utilisateur($n,$l,$p);
   if ($user->ajouterUtilisateur()) {
       header('Location: index.php');
   } else {
       echo 'Error adding facture';
   }
}