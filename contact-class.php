<?php
include("db.php");

class Contact {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addContact($nom, $prenom, $categorie) {
        $query = "INSERT INTO contacts(nom, prenom, categorie) VALUES (:nom, :prenom, :categorie)";
        $query_run = $this->conn->prepare($query);

        $data = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':categorie' => $categorie
        ];

        $query_execute = $query_run->execute($data);

        return $query_execute;
    }

    public function getContactById($id) {
        $query = "SELECT * FROM contacts WHERE id = :id";
        $query_run = $this->conn->prepare($query);
        $query_run->execute([':id' => $id]);
    
        return $query_run->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAllContacts() {
        $query = "SELECT * FROM contacts";
        $query_run = $this->conn->prepare($query);
        $query_run->execute();

        return $query_run->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateContact($id, $nom, $prenom) {
        $query = "UPDATE contacts SET nom=:nom, prenom=:prenom WHERE id=:id";
        $query_run = $this->conn->prepare($query);

        $data = [
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom
        ];

        $query_execute = $query_run->execute($data);

        return $query_execute;
    }
}

$contact = new Contact($conn);


$contactManager = new Contact($conn);
$allContacts = $contactManager->getAllContacts();

if (isset($_POST['save-btn'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $categorie = $_POST['categorie'];

    $query_execute = $contactManager->addContact($nom, $prenom, $categorie);

    if ($query_execute) {
        $_SESSION['message'] = "Contact ajouté avec succès";
        header('location: index.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout du contact";
        header('location: index.php');
        exit(0);
    }
}

if (isset($_POST['update-btn'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    try {
        $query = "UPDATE contacts SET nom=:nom, prenom=:prenom WHERE id=:id";
        $statement = $conn->prepare($query);

        $data = [
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom
        ];

        $query_execute = $statement->execute($data);

        if ($query_execute) {
            $_SESSION['message'] = "Contact mis à jour avec succès";
            header('location:index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour du contact";
            header('location:index.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo "Connexion échouée " . $e->getMessage();
    }
}
?>