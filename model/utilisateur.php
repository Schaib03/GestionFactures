<?php 
class utilisateur{
    private $id;
    private $nom;
    private $login;
    private $password;

    public function getId() {
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPassword() {
        return $this->password;
    }
    public function __construct($nom, $login, $password) {
        $this->nom = $nom;
        $this->login = $login;
        $this->password = $password;
    }
    public function ajouterUtilisateur() {
        $pdo = dbU_connect();
        $query = "INSERT INTO utilisateur (nom,login,password) VALUES (:nom, :login, :password)";
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
            header('Location: ../indexOubli.php');
            echo '<alert>Identifiant ou mot de passe incorrect</alert>';
            return false;
        }
    }
    public function selectById($id) {
        $pdo = dbU_connect();
        $query = "SELECT * FROM utilisateur WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->id = $user['id'];
            $this->nom = $user['nom'];
            $this->login = $user['login'];
            $this->password = $user['password'];
            return $this;
        }
        return null;
    }

}
function dbU_connect(){
    $host = 'db';
    $db   = 'appwebfactures';
    $user = 'appuser';
    $pass = 'apppassword';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }}

?>
