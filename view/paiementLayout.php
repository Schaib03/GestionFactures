<?php
// At the top of the file, add:
session_start();
require_once __DIR__.'/../model/paiement.php';
require_once __DIR__.'/../model/utilisateur.php';

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$listePaiement = listePaiement();
$utilisateur = new utilisateur("", "", "");
$idU = $_SESSION['id'];
$utilisateur = $utilisateur->selectById($idU);
$nom = $utilisateur->getNom();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Table des paiements</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        @keyframes example {
            0% {transform: translateX(0);}
            50% {transform: translateX(100px);}
            100% {transform: translateX(0);}
        }
        @keyframes example1 {
            0% {transform: translateX(0);}
            50% {transform: translateX(-50px);}
            100% {transform: translateX(0);}}
        
        .animated-image {
            animation: example1 3s infinite;
        }
        td{
    text-align: left;
}
td:nth-child(even) {background-color: #f2f2f2;}
th {
  background-color: #04AA6D;
  color: white;
}

    </style>


</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="userLayout.php">
                <div class="sidebar-brand-icon ">
                <img src="../img/dollar.png"  class="animated-image image-fluid" width="60" height="60" alt="Logo">                </div>
            </a>

           
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="userLayout.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


      

           

        

            <!-- Heading -->
            <div class="sidebar-heading">
                Tables
            </div>

        

            <!-- Nav Item - Factures -->
            <li class="nav-item">
                <a class="nav-link" href="layout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <b><span>Table des factures</span></b></a>
            </li>

            <!-- Nav Item - Clients -->
            <li class="nav-item">
                <a class="nav-link" href="clientlayout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des clients</span></a>
            </li>
            <!-- Nav Item - Paiements -->
            <li class="nav-item active">
                <a class="nav-link" href="paiementLayout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des paiements</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <p class="text-center mb-2"> Know more about <strong>SQLI</strong> </p>
                <a class="btn btn-success btn-sm" href="https://www.sqli.com/ma-fr/agences/oujda">Learn more</a>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                       
    
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($nom) ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Table des paiements</h1>
                   
                    <!-- DataTales Example -->
                   

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a  href="../paiement1.php"> <button  class="btn btn-primary">Ajouter un paiement</button></a>
                            <a href="layout.php"  class="btn btn-success">Liste des factures</a>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table " id="dataTable" width="100%" cellspacing="0">
                                
                                    <thead>
                                        <tr>
                                            <th scope="col">Numéro Paiement</th>  
                                            <th scope="col">Id paiement</th>
                                            <th scope="col">Date du paiement</th>
                                            <th scope="col">Montant</th>
                                            <th scope="col">Méthode</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    
                                    <?php 
                                
                                    $i=1; 
                                    foreach($listePaiement as $paiement): ?>    
                                        <tr>
                                        
                                            <td><?= $i ?></td>
                                            <td><?= $paiement->idPaiement ?></td>
                                            <td><?= $paiement->dateP ?></td>
                                            <td><?= $paiement->montant ?> DH</td>
                                            <td><?= $paiement->methode ?></td>
                                            <td><a href="../modifPaiement.php?number=<?= $paiement->idPaiement ?>&id=<?= $i ?>"  class="btn btn-info" action="../modifPaiement.php" method="get">Modifier</a>
                                            <a href="../suppPaiement.php?number=<?= $paiement->idPaiement ?>" class="btn btn-danger" action="../suppPaiement.php" method="get">Supprimer</a>
                                        </tr>
                                        <?php $i++ ;?>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CHAIB Saad & Sqli 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>