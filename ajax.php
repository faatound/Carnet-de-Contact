<?php
include("db.php");
include("contact-class.php");

$contactManager = new Contact($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'addContact':
                // Traiter l'ajout d'un contact
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $categorie = $_POST['categorie'];

                $query_execute = $contactManager->addContact($nom, $prenom, $categorie);

                if ($query_execute) {
                    echo json_encode(['success' => true, 'message' => 'Contact ajouté avec succès']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du contact']);
                }
                break;

            case 'updateTable':
                // Mettre à jour la liste des contacts
                $allContacts = $contactManager->getAllContacts();
                echo json_encode(['success' => true, 'contacts' => $allContacts]);
                break;

            // Ajoutez d'autres cas d'action au besoin

            default:
                echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Action non spécifiée']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
}
?>
