 <?php
include("db.php");
include("contact-class.php");

$contactManager = new Contact($conn);
$allContacts = $contactManager->getAllContacts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./index.css">
</head>
<body>
    <button class="add" onclick="openAddContactPopup()">Ajouter</button>

    
    <table>
        <thead>
        <tr>
            <th onclick="sortTable(1)">Id</th>
            <th onclick="sortTable(2)">Nom</th>
            <th onclick="sortTable(3)">Prénom</th>
            <th onclick="sortTable(4)">Catégorie</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allContacts as $contact): ?>
            <tr onclick="openContactPopup('<?php echo $contact['id']; ?>', '<?php echo $contact['nom']; ?>', '<?php echo $contact['prenom']; ?>', '<?php echo $contact['categorie']; ?>')">
                <td><?php echo $contact['id']; ?></td>
                <td><?php echo $contact['nom']; ?></td>
                <td><?php echo $contact['prenom']; ?></td>
                <td><?php echo $contact['categorie']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Popup pour afficher la fiche du contact -->
    <div id="contactPopup" class="popup">
        <!-- Contenu de la fiche du contact -->
        <h2 id="popupTitle"></h2>
        <p id="popupContent"></p>
        <button onclick="closePopup()">Fermer</button>
        <button name="uptade-btn" >Editer</button>
    </div>
    
    
    <div id="addContactPopup" class="popup">
        
        <h2>Ajouter un nouveau contact</h2>
        <form  id="addContactForm" method="POST" action="" onsubmit="addContact(); return false;">
        

            <label for="newFirstName">Prénom:</label>
            <input type="text"  name="prenom" required>
            <br>
            <label for="newLastName">Nom:</label>
            <input type="text"  name="nom" required>
            <br>
            <label for="newCategory">Catégorie:</label>
            <input type="text"  name="categorie" required>
            <br>
            <button name="save-btn" type="submit">Enregistrer</button>
            <button onclick="closePopup()">Fermer</button>
        </form>
        
       
        
    </div>
    
    <script>
        // Fonction pour ouvrir la popup de fiche de contact
        function openContactPopup(id, firstName, lastName, category) {
    document.getElementById('popupTitle').innerText = `Contact ID: ${id}`;
    document.getElementById('popupContent').innerText = `Nom: ${firstName} ${lastName}\nCatégorie: ${category}`;
    document.getElementById('contactPopup').style.display = 'block';
    
}
    
        // Fonction pour ouvrir la popup d'ajout de contact
        function openAddContactPopup() {
            document.querySelector('table').style.display = 'none';
            document.getElementById('addContactPopup').style.display = 'block';

        }
    
        
        function addContact() {
            
            const form = document.getElementById('addContactForm');
            const newFirstName = form.querySelector('[name="prenom"]').value;
            const newLastName = form.querySelector('[name="nom"]').value;
            const newCategory = form.querySelector('[name="categorie"]').value;

    // Envoyer les données au serveur via une requête Ajax
    // Exemple avec fetch :
    fetch('contact-class.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `prenom=${encodeURIComponent(newFirstName)}&nom=${encodeURIComponent(newLastName)}&categorie=${encodeURIComponent(newCategory)}`,
    })
    .then(response => response.json())
    .then(data => {
        // Traitement de la réponse du serveur si nécessaire
        console.log(data);
        closePopup();
    })
    .catch(error => {
        console.error('Erreur lors de l\'ajout du contact :', error);
    });

    function updateTable(updatedContacts) {
    const tbody = document.querySelector('table tbody');

    // Supprimer toutes les lignes existantes du tableau
    tbody.innerHTML = '';

    // Ajouter les nouvelles lignes
    updatedContacts.forEach(contact => {
        const row = document.createElement('tr');
        row.onclick = function() {
            openContactPopup(contact.id, contact.nom, contact.prenom, contact.categorie);
        };

        const columns = ['id', 'nom', 'prenom', 'categorie'];
        columns.forEach(column => {
            const cell = document.createElement('td');
            cell.textContent = contact[column];
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });
}
}

    
        function closePopup() {
            document.querySelector('table').style.display = 'block';
            document.getElementById('contactPopup').style.display = 'none';
            document.getElementById('addContactPopup').style.display = 'none';
        }
    </script>

    
    
</body>
</html> 
