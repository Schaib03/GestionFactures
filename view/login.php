    <?php 
    require_once __DIR__.'/../controller/utilisateurController.php';
    $u=$_POST['uname'];
    $ps=$_POST['psw'];
    if(loginAction($u,$ps))
    {
        header('location: userLayout.php');
    }
    else
    {
        header('location: index.php');
    }
    
    


    ?>