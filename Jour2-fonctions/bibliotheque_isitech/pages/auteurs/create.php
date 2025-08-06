<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Auteur.php';

    $auteurModel = new Auteur($pdo);
    $errors = [];

    if ($_POST) {
        $nom = $_POST['Nom'] ?? '';
        $prenom = $_POST['Prénom'] ?? '';
        $nationalite = isset($_POST['Nationalité']) && $_POST['Nationalité'] !== '' ? $_POST['Nationalité'] : null; // Valeur null par défaut si vide
        $date_naissance = isset($_POST['Date_de_naissance']) && $_POST['Date_de_naissance'] !== '' ? $_POST['Date_de_naissance'] : null; // Valeur null par défaut si vide
        $biographie = isset($_POST['Biographie']) && $_POST['Biographie'] !== '' ? $_POST['Biographie'] : null; // Valeur null par défaut si vide
        // Date_de_création automatique en BDD (NOW())

        $auteurModel->create($nom, $prenom, $nationalite, $date_naissance, $biographie);
        header('Location: ../../index.php?message=created');
    }
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
$pageTitle = 'Ajouter un auteur';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php require_once '../../includes/header.php'; ?>

    <main class="container">
        <h1>Ajouter un auteur</h1>
        <form method="POST">
            <div>
                <label for="Nom">Nom :</label>
                <input type="text" name="Nom" id="Nom" required>
            </div>
            <div>
                <label for="Prénom">Prénom :</label>
                <input type="text" name="Prénom" id="Prénom" required>
            </div>
            <div>
                <label for="Nationalité">Nationalité :</label>
                <input type="text" name="Nationalité" id="Nationalité">
            </div>
            <div>
                <label for="Date_de_naissance">Date de naissance :</label>
                <input type="date" name="Date_de_naissance" id="Date_de_naissance">
            </div>
            <div>
                <label for="Biographie">Biographie :</label>
                <textarea name="Biographie" id="Biographie" rows="4"></textarea>
            </div>
            <input type="submit" value="Ajouter">
            <input type="reset" class="btn-action" value="Annuler">
            <a href="../../index.php" class="btn-action">Retour</a>
        </form>
    </main>

    <?php require_once '../../includes/footer.php'; ?>
</body>

</html>