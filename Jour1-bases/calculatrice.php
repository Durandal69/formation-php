<!-- Déclaration du document HTML avec la langue française -->
<html lang="en">
<head>
    <!-- Définit l'encodage des caractères pour afficher correctement les accents -->
    <meta charset="UTF-8">
    <!-- Rend la page responsive (adaptée aux mobiles et tablettes) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre qui apparaît dans l'onglet du navigateur -->
    <title>Ma calculatrice PHP</title>
    
    <!-- CSS pour styliser la page -->
    <style>
        /* Style général de la page */
        body {
            font-family: Arial;
            margin: 20px;
        }
        
        /* Style pour les zones de résultats (classe CSS non utilisée actuellement) */
        .resultat {
            background: #f0f0f0;
            padding: 10px;
            margin: 5px 0;
            border-left: 4px solid #007cba;
        }
        
        /* Style pour une calculatrice (classe CSS non utilisée actuellement) */
        .calculator {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h1>Ma calculatrice PHP</h1>
    <?php
        // Afficher la date et la version de PHP pour info/debug
        echo "<p>Date : " . date("Y-m-d H:i:s") . "</p>";
        echo "<p>Version de PHP : " . phpversion() . "</p>";
        
        // Définition de nos deux nombres pour les calculs
        // Vous pouvez modifier ces valeurs pour tester différents calculs
        $nombre1 = 10;
        $nombre2 = 0;

        // Affichage d'un titre avec les nombres utilisés
        echo "<h2> Calcul avec le $nombre1 et $nombre2</h2>";

        // === DÉBUT DES CALCULS MATHÉMATIQUES ===
        echo "<div>";
        echo "<h3>Operations de bases</h3>";

        // ADDITION
        $addition = $nombre1 + $nombre2;
        echo "<div>Résultat de l'addition : $nombre1 + $nombre2 = $addition</div>";

        echo "</div>";

        // SOUSTRACTION
        echo "<div>";
        $soustraction = $nombre1 - $nombre2;
        echo "<div>Résultat de la soustraction : $nombre1 - $nombre2 = $soustraction</div>";
        echo "</div>";

        // MULTIPLICATION
        echo "<div>";
        $multiplication = $nombre1 * $nombre2;
        echo "<div>Résultat de la multiplication : $nombre1 * $nombre2 = $multiplication</div>";
        echo "</div>";

        // DIVISION : Division avec vérification pour éviter la division par zéro
        if ($nombre2 == 0) {
            // Si le diviseur est 0, on affiche un message d'erreur au lieu de faire le calcul
            echo "<div>Division par zéro n'est pas permise.</div>";
        } else {
            // Si le diviseur n'est pas 0, on peut faire la division en toute sécurité
            echo "<div>";
            $division = $nombre1 / $nombre2;        
            echo "<div>Résultat de la division : $nombre1 / $nombre2 = $division</div>";
            echo "</div>";
        }

        // MODULO : Reste de la division entière avec vérification pour éviter l'erreur
        if ($nombre2 == 0) {
            // Le modulo par zéro provoque aussi une erreur, donc on l'évite
            echo "<div>Modulo par zéro n'est pas permise.</div>";
        } else {
            // Si le diviseur n'est pas 0, on peut calculer le modulo
            echo "<div>";
            $modulo = $nombre1 % $nombre2;
            echo "<div>Résultat du modulo : $nombre1 % $nombre2 = $modulo</div>";
            echo "</div>";
        }
        
        // === CRÉATION D'UN TABLEAU RÉCAPITULATIF ===
        // Ajouts des différents résultats dans un tableau associatif
        // Un tableau associatif utilise des clés (noms) au lieu de numéros
        $resultats = [
            'Addition' => $addition,
            'Soustraction' => $soustraction,
            'Multiplication' => $multiplication,
            // isset() vérifie si la variable existe et n'est pas null
            // Si $division existe, on l'utilise, sinon on met 'N/A'
            'Division' => isset($division) ? $division : 'N/A',
            'Modulo' => isset($modulo) ? $modulo : 'N/A'
        ];

        // === AFFICHAGE DU TABLEAU HTML ===
        // Affichage de tous les résultats dans un tableau HTML bien formaté
        echo "<h3>Tableau des résultats</h3>";
        echo "<table border='1'>";
        // En-tête du tableau avec les titres des colonnes
        echo "<tr><th style='padding:10px 20px'>Opération</th><th style='padding:10px 20px'>Résultat</th></tr>";
        
        // foreach parcourt chaque élément du tableau $resultats
        // $operation récupère la clé (Addition, Soustraction, etc.)
        // $resultat récupère la valeur (le résultat numérique)
        foreach ($resultats as $operation => $resultat) {
            echo "<tr><td>$operation</td><td>$resultat</td></tr>";
        }
        echo "</table>";
    ?>
</body>
</html>