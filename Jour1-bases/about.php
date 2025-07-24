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
        // Données personnelles
        $etudiant = [
            'nom' => "John Doe",
            'email' => "john.doe@example.com",
            'date_naissance' => "1990-09-05", // format année-mois-jour
            'ville' => "Paris",
            'pays' => "France"
        ];
        // Timeline formation
        $etapes = [
            'Premier module' => 'IT Essentials',
            'Deuxième module' => 'Networking Essentials',
            'Troisième module' => 'Virtualisation',
            'Quatrième module' => 'Bases Linux',
            'Cinquième module' => 'HTML CSS JS',
            'Sixième module' => 'Algorithmique appliquée C#',
            'Septième module' => 'Infrastructure serveur',
            'Huitième module' => 'PHP - MySQL',
        ];

        // Compétences acquises
        $competences = [
            'HTML' => 40, // en pourcentage
            'CSS' => 40,
            'PHP' => 20,
            'MySQL' => 65,
            'C#' => 50,
            'Linux' => 55,
            'Réseau' => 70,
            'Virtualisation' => 70,
        ];

        // Projets réalisés
        $projets = [
            'Portfolio en ligne' => 'Création d\'un portfolio pour présenter les projets réalisés',
            'Création d\'une clef bootable Windows' => 'Utilisation de Rufus pour créer une clef USB bootable',
            'Création d\'un réseau virtuel avec VMware' => 'Mise en place d\'un réseau virtuel pour simuler un environnement de travail',
            'Création d\'une base de données MySQL avec MariaDB/Nginx' => 'Conception et implémentation d\'une base de données pour un projet web',
            'Entraînement aux tests de logique avec C#' => 'Pratique des tests de logique et de programmation en C#',
        ];

        // Fonctions utilitaires

        function calculerProgression(){}
        function afficherCompetences(){}
    ?>
</body>
</html>