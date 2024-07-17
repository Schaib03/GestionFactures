<?php 
require_once 'controller/facture_controller.php'; 
require_once 'controller/utilisateurController.php';
require_once 'view/userLayout.php';//avec des cndts rak tma
// cnx ?>
<form action="view/login.php" method="post">
  <div class="container">
    <label for="uname"><b>e-Mail</b></label>
    <input type="mail" placeholder="Enter Mail" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <a href="view/login.php"><button type="submit">Login</button></a>
    <a href="register.php">Register</a>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>


