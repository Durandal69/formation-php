<?php
require_once '../../config/database.php';
require_once '../../classes/Livre.php';

$livreModel = new Livre($pdo);

$errors = [];

// Traitement du formulaire
if ($_POST) {
    $titre = $_POST['Titre'] ?? ''; // Si ça n'existe pas, on met une chaîne vide
    $isbn = $_POST['ISBN'] ?? '';
    $auteurId = isset($_POST['Reference_vers_auteur']) && $_POST['Reference_vers_auteur'] !== '' ? (int)$_POST['Reference_vers_auteur'] : null;
    $genreId = isset($_POST['Reference_vers_genre']) && $_POST['Reference_vers_genre'] !== '' ? (int)$_POST['Reference_vers_genre'] : null;
    $annee_publication = isset($_POST['Annee_de_publication']) && $_POST['Annee_de_publication'] !== '' ? (int)$_POST['Annee_de_publication'] : '0000'; // Valeur 0000 par défaut si vide
    $nb_pages = isset($_POST['Nombre_de_pages']) && $_POST['Nombre_de_pages'] !== '' ? (int)$_POST['Nombre_de_pages'] : null; // Valeur null par défaut si vide (comme pour auteurID et genreId)
    $resume = $_POST['Resume'] ?? '';
    $status_disponibilite = $_POST['Status_de_disponibilite'] ?? '';
    $index_appropries = $_POST['Index_appropries'] ?? '';

    // Validation des données (plus tard)

    // Gestion des erreurs (plus tard)
    $livreModel->create($titre, $isbn, $auteurId, $genreId, $annee_publication, $nb_pages, $resume, $status_disponibilite, $index_appropries);
    header('Location: ../../index.php?message=created'); // Redirection après création réussie

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation d'un livre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
    <div class="bubble bubble4"></div>
    <div class="bubble bubble5"></div>
    <h1>Créer un nouveau livre</h1>
    <form method="POST">
        <div>
            <label for="Titre">Titre:</label>
            <input type="text" name="Titre" id="Titre" required>
        </div>
        <div>
            <label for="ISBN">ISBN:</label>
            <input type="text" name="ISBN" id="ISBN" required>
        </div>
        <div>
            <label for="Reference_vers_auteur">Auteur ID:</label>
            <input type="number" name="Reference_vers_auteur" id="Reference_vers_auteur">
        </div>
        <div>   
            <label for="Reference_vers_genre">Genre ID:</label>
            <input type="number" name="Reference_vers_genre" id="Reference_vers_genre">
        </div>
        <div>
            <label for="Annee_de_publication">Année de publication:</label>
            <input type="number" name="Annee_de_publication" id="Annee_de_publication" min="0000" max="6000">
        </div>
        <div>
            <label for="Nombre_de_pages">Nombre de pages:</label>
            <input type="number" name="Nombre_de_pages" id="Nombre_de_pages">
        </div>
        <div>
            <label for="Resume">Résumé:</label>
            <textarea name="Resume" id="Resume"></textarea>
        </div>
        <div>
            <label for="Status_de_disponibilite">Statut de disponibilité:</label>
            <select name="Status_de_disponibilite" id="Status_de_disponibilite">
                <option value="disponible">Disponible</option>
                <option value="non_disponible">Non disponible</option>
                <option value="non_reference">Non référencé</option>
            </select>
        </div>
        <div>
            <label for="Index_appropries">Index appropriés:</label>
            <input type="text" name="Index_appropries" id="Index_appropries">
        </div>
        


        <input type="submit" value="Ajouter">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>
</body>
</html>