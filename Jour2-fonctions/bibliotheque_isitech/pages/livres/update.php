<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Livre.php';

    $livreModel = new Livre($pdo);
    $livre = $livreModel->findById($_GET['id']);

    $id = $_GET['id'];

    $errors = [];
    $success = false;

    if ($_POST) {
        $livreData = [
            'id' => $id,
            'titre' => $_POST['Titre'],
            'isbn' => $_POST['ISBN'],
            'auteurId' => isset($_POST['Reference_vers_auteur']) ? (int)$_POST['Reference_vers_auteur'] : null,
            'genreId' => isset($_POST['Reference_vers_genre']) ? (int)$_POST['Reference_vers_genre'] : null,
            'annee_publication' => isset($_POST['Annee_de_publication']) ? (int)$_POST['Annee_de_publication'] : '0000', // Valeur 0000 par défaut si vide
            'nb_pages' => isset($_POST['Nombre_de_pages']) ? (int)$_POST['Nombre_de_pages'] : null, // Valeur null par défaut si vide
            'status_disponibilite' => $_POST['Status_de_disponibilite'] ?? '',
            'resume' => $_POST['Resume'] ?? '',
            'index_appropries' => $_POST['Index_appropries'] ?? '',
        ];

        $livreModel->update(
            $livreData['id'],
            $livreData['titre'],
            $livreData['isbn'],
            $livreData['auteurId'],
            $livreData['genreId'],
            $livreData['annee_publication'],
            $livreData['nb_pages'],
            $livreData['resume'],
            $livreData['status_disponibilite'],
            $livreData['index_appropries']
        );
        header('Location: ../../index.php?message=updated'); // Redirection après mise à jour réussie

    }
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
    <div class="bubble bubble4"></div>
    <div class="bubble bubble5"></div>
    <h1>Mettre à jour un livre</h1>
    <form method="POST">
        <div>
            <label for="Titre">Titre:</label>
            <input type="text" name="Titre" id="Titre" value="<?php echo htmlspecialchars($livre->Titre ?? ''); ?>" required>
        </div>
        <div>
            <label for="ISBN">ISBN:</label>
            <input type="text" name="ISBN" id="ISBN" value="<?php echo htmlspecialchars($livre->ISBN ?? ''); ?>" required>
        </div>
        <div>
            <label for="Reference_vers_auteur">Auteur ID:</label>
            <input type="number" name="Reference_vers_auteur" id="Reference_vers_auteur" value="<?php echo htmlspecialchars($livre->Reference_vers_auteur ?? ''); ?>">
        </div>
        <div>
            <label for="Reference_vers_genre">Genre ID:</label>
            <input type="number" name="Reference_vers_genre" id="Reference_vers_genre" value="<?php echo htmlspecialchars($livre->Reference_vers_genre ?? ''); ?>">
        </div>
        <div>
            <label for="Annee_de_publication">Année de publication:</label>
            <input type="number" name="Annee_de_publication" id="Annee_de_publication" min="0000" max="6000" value="<?php echo htmlspecialchars($livre->Annee_de_publication ?? ''); ?>">
        </div>
        <div>
            <label for="Nombre_de_pages">Nombre de pages:</label>
            <input type="number" name="Nombre_de_pages" id="Nombre_de_pages" value="<?php echo htmlspecialchars($livre->Nombre_de_pages ?? ''); ?>">
        </div>
        <div>
            <label for="Resume">Résumé:</label>
            <textarea name="Resume" id="Resume"><?php echo htmlspecialchars($livre->Resume ?? ''); ?></textarea>
        </div>
        <div>
            <label for="Status_de_disponibilite">Statut de disponibilité:</label>
            <select name="Status_de_disponibilite" id="Status_de_disponibilite">
                <option value="disponible" <?php if ($livre->Status_de_disponibilite == 'disponible') echo 'selected'; ?>>Disponible</option>
                <option value="non_disponible" <?php if ($livre->Status_de_disponibilite == 'non_disponible') echo 'selected'; ?>>Non disponible</option>
                <option value="non_reference" <?php if ($livre->Status_de_disponibilite == 'non_reference') echo 'selected'; ?>>Non référencé</option>
            </select>
        </div>
        <div>
            <label for="Index_appropries">Index appropriés:</label>
            <input type="text" name="Index_appropries" id="Index_appropries" value="<?php echo htmlspecialchars($livre->Index_appropries ?? ''); ?>">
        </div>



        <input type="submit" value="Mettre à jour">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>





</body>

</html>