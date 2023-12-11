 <?php

include("db.php");
include("code.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        margin: 20px;
    }

    h3{
        color: #155724;
    }

    .card {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #82e56c;
        color: #ffffff;
    }

    .btn-primary {
        background-color: #82e56c;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
        margin-top: 30px;
        margin-right: 50%;
    }

    .float-end {
        float: right;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 8px 16px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .popup-left {
    margin-left: 20px;
}

.btn-green {
    background-color:  #82e56c; 
    color: #ffffff; 
    border:none;
    cursor: pointer;
    padding: 10px 20px;
}

.edit-link{
    text-decoration: none;
    color: #ffffff; 
}
</style>


</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            <?php if(isset($_SESSION['message'])) : ?>
                <h5 class="alert alert-sucess"><?= $_SESSION['message']; ?></h5>
                <?php endif; ?>

                <?php unset($_SESSION['message']); ?>
               
                <div class="card">
                    <div class="card-header">
                        <h3>Bienvenue dans votre liste de Contact </h3>
                        <div class="card-body">
                            
                            <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Categorie</th>
                                </tr>
                            </thead>
                            <tbody>
                           
                            <?php $query = "SELECT * FROM contacts";
                            $statement = $conn->prepare($query);
                            $statement->execute();

                            $statement->setFetchMode(PDO::FETCH_OBJ);
                            $result = $statement->fetchAll(PDO::FETCH_OBJ);

                            if($result){
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->id; ?></td>
                                        <td><?= $row->nom; ?></td>
                                        <td><?= $row->prenom; ?></td>
                                        <td><?= $row->categorie; ?></td>
                                    </tr>
                                    <?php

                                }
                            }
                            else {
                                ?>
                                <tr> 
                                    <td colspan=5 >No record found</td>
                                </tr>
                                 <?php
                            }

                             ?>
                            </tbody>
                            </table> 
                            <a href="ajax.php" class="btn btn-primary float-end">Ajouter</a>
                        </div>
                        
                       
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    
    <script>

        function closePopup() {
                const overlay = document.querySelector(".overlay");
                overlay.style.display = "none";
            }
        document.addEventListener("DOMContentLoaded", function () {
            const tableRows = document.querySelectorAll("table tbody tr");

            tableRows.forEach(row => {
                row.addEventListener("click", () => {
                    // Récupérez les données de la ligne (supposez que les données sont dans des cellules td)
                    const id = row.querySelector("td:nth-child(1)").innerText;
                    const nom = row.querySelector("td:nth-child(2)").innerText;
                    const prenom = row.querySelector("td:nth-child(3)").innerText;
                    const categorie = row.querySelector("td:nth-child(4)").innerText;

                    // Afficher le popup avec les données
                    showPopup({ id, nom, prenom, categorie });
                });
            });

            function showPopup(contact) {
                const overlay = document.querySelector(".overlay");
                const popup = document.querySelector(".popup");

                // Remplir les données dans le popup
                popup.innerHTML = `
                    <h3>Information du Contact</h3>
                   
                    <p><strong>Nom:</strong> ${contact.nom}</p>
                    <p><strong>Prénom:</strong> ${contact.prenom}</p>
                    <p><strong>Catégorie:</strong> ${contact.categorie}</p>
                    <button onclick="closePopup()"  class="btn-green">Annuler</button>
                    <button class="btn-green"> <a class="edit-link" href="edit.php?id=${contact.id}" >Éditer</a></button>
                `;
                popup.classList.add("popup-left");
                // Afficher le popup
                overlay.style.display = "flex";
            }

            function editContact(id) {
    // Redirigez l'utilisateur vers edit.php avec l'ID du contact
            window.location.href = `edit.php?id=${id}`;
}
        });
    </script>


<div class="overlay">
    <div class="popup"></div>
</div>



</body>
</html>
    