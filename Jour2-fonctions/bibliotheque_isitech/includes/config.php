<?php
// header('Content-Type: text/html; charset=utf-8');
// try {
//     // Connexion
//     $pdo = new PDO('mysql:host=localhost:3307;dbname=bibli', 'root', '');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     // Requête simple
//     $query = "SELECT id, Titre, Reference_vers_auteur, Reference_vers_genre FROM livres ORDER BY Titre";
//     $stmt = $pdo->query($query);
    
//     // Récupérer tous les résultats
//     $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
// var_dump($livres); // Pour vérifier les données récupérées

//     // Affichage
//     echo "<h3>Livres dans la bibliothèque :</h3>";
//     foreach ($livres as $livre) {
//         echo "<p>";
//         echo "<strong>" . htmlspecialchars($livre['Titre']) . "</strong><br>";
//         echo "Auteur : " . htmlspecialchars($livre['Reference_vers_auteur']) . "<br>";
//         echo "Genre : " . htmlspecialchars($livre['Reference_vers_genre']);
//         echo "</p>";
//     }
    
// } catch (PDOException $e) {
//     echo "Erreur : " . $e->getMessage();
// }
?>