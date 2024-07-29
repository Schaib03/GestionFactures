<?php
session_start();
require_once __DIR__.'/../model/facture.php';
require_once __DIR__.'/../model/utilisateur.php';
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$utilisateur = new utilisateur("", "", "");
$idU = $_SESSION['id'];
$utilisateur = $utilisateur->selectById($idU);
$nom = $utilisateur->getNom();
$listeFacture = listeFacture();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Table des factures</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.css" />


  
    <style>
        @keyframes example {
            0% {transform: translateX(0);}
            50% {transform: translateX(100px);}
            100% {transform: translateX(0);}
        }
        @keyframes example1 {
            0% {transform: translateX(0);}
            50% {transform: translateX(-50px);}
            100% {transform: translateX(0);}
        }
       
        .animated-image {
            animation: example1 3s infinite;
        }
        th {
  background-color: #04AA6D;
  color: white;
}
td{
    text-align: left;
}
td:nth-child(even) {background-color: #f2f2f2;}

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
                <img src="../img/facture.png"  class="animated-image image-fluid" width="60" height="60" alt="Logo">                </div>
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
            <li class="nav-item active">
                <a class="nav-link" href="layout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des factures</span></a>
            </li>

            <!-- Nav Item - Clients -->
            <li class="nav-item">
                <a class="nav-link" href="clientlayout.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Table des clients</span></a>
            </li>
            <!-- Nav Item - Paiements -->
            <li class="nav-item">
                <a class="nav-link" href="paiementlayout.php">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nom?></span>
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
                    <h1 class="h3 mb-2 text-gray-800">Table des factures</h1>
                   
                    <!-- DataTales Example -->
                   

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a  href="../facture1.php"> <button  class="btn btn-primary">Ajouter une facture</button></a>
                            <a href="clientLayout.php"  class="btn btn-success">Liste des clients</a>
                            <a href="paiementLayout.php" class="btn btn-warning">Liste des paiements</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table" id="dataTable"  width="100%" cellspacing="1">
                                
        <thead>
            <tr>
                <th style=" width: 5px;" scope="col">Numero</th>  
                <th scope="col" style="width: 140px;">Date </th>
                <th scope="col" width="180px;">Montant Total</th>
                <th style="width: 180px;" scope="col">Etat</th>
                <th scope="col" width="120px;">Id Client</th>
                <th scope="col" width="120px;">Id Paiement</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php 
   
        $i=1; 
        foreach($listeFacture as $facture): ?>    
            <tr>
                  <?php 
                require_once __DIR__.'/../model/client.php';
                require_once __DIR__.'/../model/paiement.php';
                $idClient=$facture->idC;
                $idPaiement=$facture->idP;
                $paiement=new paiement("","","");
                 $client=new client("","","","","");
                 $client=$client->loadClientById($idClient);
                 $paiement=$paiement->loadPaiementById($idPaiement);
                  ?>
                <td><?= $i ?></td>
                <td><?= $facture->date ?></td>
                <td><?= $facture->montantTotal ?> DH</td>
                <td><?= $facture->etat?></td>
                <td>                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#infoClient<?php echo $idClient ?>" id="submit"><?= $facture->idC ?></button>
                </td>
                <td>                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#infoPaiement<?php echo $idPaiement ?>" id="submit"><?= $facture->idP ?></button>
                </td>
             
              
                
                <td width="220px;" ><a href="../modifFact.php?numero=<?= $facture->numero ?>&id=<?= $i ?>" class="btn btn-info" action="../modifFact.php" method="get">Modifier</a>
                <a href="../suppFact.php?num=<?= $facture->numero ?>" class="btn btn-danger" action="../suppFact.php" method="get">Supprimer</a>
                
                
            </tr>              <!-- ClientModal -->
                <div class="modal fade" id="infoClient<?= $idClient?>" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Informations Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <!-- Your card content goes here -->
                        <div class="card">
                        <div class="card-body">
                        <div class="card shadow-sm">
                            <div class="card-text">
                            <?php $client = listeClientByID($idClient); ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">ID:</span>
                                <span ><?= $client->idClient ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Name:</span>
                                <span><?= $client->nom ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Address:</span>
                                <span><?= $client->adresse ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Email:</span>
                                <span><?= $client->email ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Téléphone:</span>
                                <span><?= $client->telephone ?></span>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="../modifClient.php?num=<?= $client->idClient ?>&id=<?= $i ?>"  action="../modifClient.php" method="get" class="btn btn-primary">Modifier</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
                <div class="modal fade" id="infoPaiement<?= $idPaiement?>" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Informations Paiement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                        <!-- Your card content goes here -->
                        <div class="card">
                        <div class="card-body">
                        <div class="card shadow-sm">
                            <div class="card-text">
                            <?php $paiement = listePaiementByID($idPaiement); ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">ID:</span>
                                <span ><?= $paiement->idPaiement ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Date du paiement</span>
                                <span><?= $paiement->dateP ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Montant</span>
                                <span><?= $paiement->montant ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Méthode</span>
                                <span><?= $paiement->methode ?></span>
                                </li>
                              
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="../modifPaiement.php?number=<?= $paiement->idPaiement ?>&id=<?= $i ?>"  action="../modifPaiement.php" method="get" class="btn btn-primary">Modifier</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <?php $i++ ;
            
            ?>
              
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
   

    <!-- PaiementModal -->
    <div class="modal fade" id="infoPaiement" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="infoModalLabel">Information Card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Your card content goes here -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card Title</h5>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.js"></script>
   



</body>

</html>