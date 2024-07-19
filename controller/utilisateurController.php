<?php
require_once __DIR__.'/../model/utilisateur.php';
function storeUtilisateur($n,$l,$p) {
   $user = new utilisateur($n,$l,$p);
   if ($user->ajouterUtilisateur()) {
       header('Location: index.php');
   } else {
       echo 'Error adding user';
   }
}
function loginAction($u,$ps){
    require_once __DIR__.'/../model/utilisateur.php';
    $user = new utilisateur(null,$u,$ps);
    if($user->identifierUtilisateur($u,$ps)){
        $query='SELECT id FROM utilisateur WHERE login = :login AND password = :password';
        $pdo = new PDO('mysql:host=localhost;dbname=appwebFactures','root','');
        $stmt = $pdo->prepare($query);      
        $stmt->bindParam(':login', $u);
        $stmt->bindParam(':password', $ps);        
        if ($stmt->execute()) {
            $id = $stmt->fetchColumn();
            session_start();
            $_SESSION['login'] = $u;
            $_SESSION['id'] = $id;
            header('location: userLayout.php');
            return true;
        } 
        else {
            echo "Error executing query";
            return false;

        }

        
    }
    else{
        echo "error identifying user 2 ";
    }
}
