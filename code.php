<?php
session_start();
include("db.php");

if (isset($_POST['update-btn']))
 {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $categorie = $_POST['categorie'];

    try {
       $query = "UPDATE contacts SET nom=:nom, prenom=:prenom, categorie=:categorie WHERE id=:id LIMIT 1";
       $statement = $conn->prepare($query);

       $data = [
        ':id' => $id,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':categorie' => $categorie,
        
        
    ];
    $query_execute = $statement->execute($data);
    if($query_execute){
        $_SESSION['message'] = "Updated Successfully";
        header('location:list-contact.php');
        exit(0);
    }
    else 
    {
        $_SESSION['message'] = "Not Updated Inserted ";
        header('location:list-contact.php');
        exit(0);
    }



        
    } catch (PDOException $e) {
       echo "connexion failed" .$e->getMessage() ;
    }
    
   
}









if(isset($_POST['save-btn']))
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $categorie = $_POST['categorie'];

    $query = "INSERT INTO contacts(nom,prenom,categorie) VALUES(:nom, :prenom, :categorie)";
    $query_run = $conn->prepare($query);

    $data = [
    ':nom' => $nom,
    ':prenom'=>$prenom,
    ':categorie'=>$categorie
    ];
    $query_execute = $query_run->execute($data);

    if ($query_execute) {
        $_SESSION['message'] = "Inserted successfully";
        header('location: list-contact.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Not inserted";
        header('location: list-contact.php');
        exit(0);
    }

}
?>
