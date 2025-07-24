<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    // Configuration du mdp
    echo "<h1 class=titre>Générateur de mot de passe</h1>";
    echo "<p class=sous_titre>Génération de mots de passe aléatoires avec des critères de sécurité.</p>";

    $longueur = 12; // Longueur du mot de passe
    $nombre_de_mdp = 5; // Nombre de mots de passe à générer

    $caracteres = [
        'minuscules' => 'abcdefghijklmnopqrstuvwxyz',
        'majuscules' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'chiffres' => '0123456789',
        'speciaux' => '!@#$%^&*()-_=+[]{}|;:,.>?'
    ];

    $types_actifs = ['minuscules', 'majuscules', 'chiffres', 'speciaux']; // Types de caractères à utiliser

    $chaine = '';
    foreach ($types_actifs as $type) {
        $chaine .= $caracteres[$type];
    }
    echo "<div class=info>Types de caractères disponibles : " . implode(", ", $types_actifs) . "</div>"; // implode = concatène les éléments d'un tableau en une chaîne de caractères
    echo "<div class=info>Nombre de caractères disponibles : " . strlen($chaine) . "</div>";
    echo "<div class=info><span style='color:black; text-decoration:underline'>Critères d'analyse :</span><br> Types de caractères utilisés<br>Nombre de caractères<br>Pas plus de deux répétitions d'un caractère</div>";

    function genererMotDePasse($longueur, $chaine)
    {
        $motdepasse = '';
        $nb_caracteres = strlen($chaine);

        for ($i = 0; $i < $longueur; $i++) {
            $index_aleatoire = random_int(0, $nb_caracteres - 1); // rand(min, max) génère un nombre aléatoire entre min et max
            $motdepasse .= $chaine[$index_aleatoire]; // Concatène le caractère aléatoire à la chaîne de mot de passe
        }

        return $motdepasse;

        // 1. Construire chaîne de caractères
        // 2. Mélanger aléatoirement
        // 3. Sélectionner N caractères
        // 4. Retourner résultat
    }



    function analyserForce($motdepasse)
    {
        $score = 0;
        $longueur = strlen($motdepasse);

        // 1. Longueur
        if ($longueur >= 8) $score += 2;
        elseif ($longueur >= 6) $score += 1;
        elseif ($longueur < 6) $score -= 2; // pénalité pour trop court

        if ($longueur >= 12) $score += 1; // bonus pour très long

        // 2. Types de caractères
        $hasLower = false;
        $hasUpper = false;
        $hasDigit = false;
        $hasSpecial = false;
        foreach (str_split($motdepasse) as $caractere) {  // on casse le mdp en caractères élément par élément
            if (ctype_lower($caractere)) $hasLower = true;  // on regarde si on a au moins une minuscule
            elseif (ctype_upper($caractere)) $hasUpper = true; // idem majuscule
            elseif (ctype_digit($caractere)) $hasDigit = true; // idem chiffre
            elseif (ctype_punct($caractere) || $caractere === '_') $hasSpecial = true; // et spécial (mais pas sur que "punct" prenne tout) // avec copilot, j'ai la confirmation que le underscore n'était pas pris en compte
        }
        $score += $hasLower + $hasUpper + $hasDigit + $hasSpecial;

        // 3. Répétition de caractères
        $chars = count_chars($motdepasse, 1);
        $maxRepeat = max($chars);
        if ($maxRepeat > 2) $score -= 1; // pénalité si un caractère est trop répété

        // 4. Résultat
        if ($score <= 2) return "🟥Faible";
        if ($score <= 4) return "🟧Moyen";
        if ($score <= 6) return "🟨Fort";
        if ($score > 6) return "<span style='color:green;'>🟩Très fort</span>";
    }

    for ($i = 1; $i <= $nombre_de_mdp; $i++) {
        $longueur = rand(3, 12);   // j'ai du changer la longueur ici sinon tout les mdp avaient la même longueur
        $motdepasse = genererMotDePasse($longueur, $chaine);
        $force = analyserForce($motdepasse);
        $message = "<div class=container_resultat>Mot de passe $i : <strong>$motdepasse</strong> <p>(Force : $force"; // début du message
        if ($longueur < 6) {
            $message .= ", <span style='color:red;'>trop court</span>";  // ajout d'un message si trop court
        }
        $message .= ")</p></div>"; // fermeture du message
        echo $message . "<br>"; // affichage du message au complet
    }
    ?>
</body>

</html>