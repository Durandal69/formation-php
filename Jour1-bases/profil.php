<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
        // Informations de base
        $nom = "Fleutot";
        $prenom = 'Stanislas';
        $date_naissance = '1990-09-05'; // Date de naissance au format YYYY-MM-DD
        $ville = 'Messimy';
        $pays = 'France';

        // Liste des hobbies
        $hobbies = [
            'Jeux vidéo',
            'Bande dessinée',
            'Culture japonaise',
            'Mangas',
        ];

        // Affichage des informations
        echo "<h1>Profil de $prenom $nom</h1>";
        echo "<p>Âge : " . (date('Y') - date('Y', strtotime($date_naissance))) . " ans " . "(" . (date('m') - date('m', strtotime($date_naissance))) . ")" ." mois</p>";
        echo "<p>Année de naissance : " . date('Y', strtotime($date_naissance)) . "</p>";
        echo "<p>Localisation : $ville, $pays</p>";

        if (date('Y') - date('Y', strtotime($date_naissance)) < 18) {
            echo "<p>Etudiant mineur.</p>";
        } else if (date('Y') - date('Y', strtotime($date_naissance)) >= 18 && date('Y') - date('Y', strtotime($date_naissance)) < 25) {
            echo "<p>Etudiant jeune adulte.</p>";
        } else {
            echo "<p>Etudiant adulte.<br>En reconversion professionnelle.</p>";
        }

        echo "<h2 style='color: green; margin: 10px; outline: 3px solid green; width: fit-content; padding: 5px;'>Hobbies :</h2><ul>";
        foreach ($hobbies as $hobby) {
            echo "<li style='color: blue;'>$hobby</li>";
        }
        echo "</ul>";

    ?>
</body>
</html>