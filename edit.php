<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier vos informations de contact</title>
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

        h3 {
            color: #155724;
        }

        .card {
            margin-top: 20px;
        }

        .card-header {
            background-color: #82e56c;
            color: #ffffff;
            padding: 15px;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .card-body {
            padding: 20px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .btn-primary,.btn-danger {
            background-color: #82e56c;
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
    </style>
  
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Modifier et Mettre à jour
                            <a href="list-contact.php" class="btn btn-danger float-end">BACK</a>
                        </h3>
                    </div>
               
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];

                            $query = "SELECT * FROM contacts WHERE id=:id LIMIT 1";
                            $statement = $conn->prepare($query);
                            $data = [':id' => $id];
                            $statement->execute($data);

                            // Récupérer les données du contact
                            $result = $statement->fetch(PDO::FETCH_OBJ);
                            
                            if ($result) {
                        ?>  
                            <form action="code.php" method="POST">
                                <input type="hidden" value="<?= $result->id ?>" name="id"/>
                                <div class="mb-3">
                                    <label>Nom</label>
                                    <input type="text" name="nom" value="<?= $result->nom; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Prenom</label>
                                    <input type="text" name="prenom" value="<?= $result->prenom; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Categorie</label>
                                    <input type="text" name="categorie" value="<?= $result->categorie; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update-btn" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                        <?php
                            } else {
                                // Gérer le cas où l'enregistrement n'est pas trouvé
                                echo "Enregistrement non trouvé.";
                            }
                        }
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
