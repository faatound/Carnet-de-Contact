<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="./index.css?v=2">
   
   
</head>
<body>
    <div class="welcome">
        <h1>Bienvenue dans votre Carnet de Contacts</h1>
        
      </div>
      <div class="options">
        <div class="option">
          <img src="./undraw_Contact_us_re_4qqt (1).png" alt="Liste de Contacts">
          <button class="green-btn"><a href="list-contact.php">Liste de Contacts</a></button> 
        </div>
        <div class="option">
          <img src="./undraw_People_search_re_5rre (1).png" alt="Fiche de Contact">
         <button class="green-btn"><a href="edit.php">Fiche de Contact</a></button> 
        </div>
        <div class="option">
          <img src="./undraw_Profile_data_re_v81r.png" alt="Formulaire de Contact">
          <button class="green-btn"><a href="ajax.php">Formulaire de Contact</a></button>
        </div>
        <script>
      document.addEventListener("DOMContentLoaded", function() {
    const title = document.querySelector(".welcome h1");
    title.classList.add("loaded");
});

    </script>
</body>
</html>
