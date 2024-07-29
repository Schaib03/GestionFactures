<?php 
require_once __DIR__.'/../controller/utilisateurController.php';

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $u = $_POST['uname'];
    $ps = $_POST['psw'];

    if (loginAction($u, $ps)) {
        header('Location: userLayout.php');
        exit(); 
    } else {
        header('Location: index.php');
        exit(); 
    }
} else {
     header('Location: index.php');
    exit(); 
}
?>
