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
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 60%;
        }

        .card {
            margin-top: 20px;
            border: 1px solid black;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #82e56c;
            color: #ffffff;
            padding: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .form-control {
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
            margin-bottom: 15px;
        
        }

        .btn-danger,
        .btn-primary {
            width: 15%;
            height: 50px;
            margin-top: 10px;
            margin-left: 45%;
            border-radius: 15px;
            cursor: pointer;
            color: #ffffff;
            background-color: #82e56c;
            border: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">
                
                <div class="card">
                    <div class="card-header">
                        <h3>Ajoutez un nouveau contact
                        <a href="list-contact.php" class="btn btn-danger float-end">BACK</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form  action="code.php" method="POST">
                            <div class="mb-3">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Prenom</label>
                                <input type="text" name="prenom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Catégorie</label>
                                <input type="categorie" name="categorie" class="form-control">
                            </div>
                            <div class="mb-3">
                            <button type="submit" name="save-btn" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div> 
</body>
</html>