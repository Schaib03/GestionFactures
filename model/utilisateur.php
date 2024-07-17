<?php 
class utilisateur{
    private $id;
    private $nom;
    private $login;
    private $password;

    public function __construct($nom, $login, $password) {
        $this->nom = $nom;
        $this->login = $login;
        $this->password = $password;
    }
    public function seConnecter($login, $password) {

    }
    public function ajouterUtilisateur() {
        $pdo = dbU_connect();
        $query = "INSERT INTO Utilisateur (nom,login,password) VALUES (:nom, :login, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':password', $this->password);        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function identifierUtilisateur() {
        $pdo = dbU_connect();
        $query = "SELECT * FROM utilisateur WHERE login = :login AND password = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            echo "Error identifying user";
            return false;
        }
    }
    public function modifierUtilisateur($nom, $login, $password) {

    }
    public function supprimerUtilisateur() {

    }
    public function rechercherFactureParNumero($numero) {

    }
    public function rechercherFactureParClient($idC) {

    }
    public function rechercherFactureParPaiement($idP) {
        
    }

}
function dbU_connect(){
    return new PDO('mysql:host=localhost;dbname=appwebFactures','root','');
}?>