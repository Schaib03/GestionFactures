<?php
require_once __DIR__.'/../model/utilisateur.php';

function storeUtilisateur($n, $l, $p) {
    $user = new utilisateur($n, $l, $p);
    if ($user->ajouterUtilisateur()) {
        header('Location: index.php');
        exit(); // Prevent further code execution
    } else {
        // Optionally, you can use a more user-friendly error handling method
        // For instance, redirect to an error page
        header('Location: error.php?msg=Error adding user');
        exit(); // Prevent further code execution
    }
}

function loginAction($u, $ps) {
    require_once __DIR__.'/../model/utilisateur.php';
    $user = new utilisateur(null, $u, $ps);
    if ($user->identifierUtilisateur($u, $ps)) {
        $query = 'SELECT id FROM utilisateur WHERE login = :login AND password = :password';
        $pdo = dbU_connect();
        $stmt = $pdo->prepare($query);      
        $stmt->bindParam(':login', $u);
        $stmt->bindParam(':password', $ps);        
        if ($stmt->execute()) {
            $id = $stmt->fetchColumn();
            
            // Start the session before any output
            session_start();
            $_SESSION['login'] = $u;
            $_SESSION['id'] = $id;

            header('Location: userLayout.php');
            exit(); // Prevent further code execution
        } else {
            // Optionally, handle the error more gracefully
            header('Location: error.php?msg=Error executing query');
            exit(); // Prevent further code execution
        }
    } else {
        header('Location: error.php?msg=Error identifying user');
        exit(); // Prevent further code execution
    }
}
