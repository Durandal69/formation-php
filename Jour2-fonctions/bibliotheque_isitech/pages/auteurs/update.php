<?php

require_once '../../config/database.php';
require_once '../../classes/Auteur.php';

$auteurModel = new Auteur($pdo);
$id = $_GET['id'];
$auteur = $auteurModel->findById($id);

if ($_POST) {
    $nom = $_POST['Nom'] ?? '';
    $prenom = $_POST['Prénom'] ?? '';
    $nationalite = isset($_POST['Nationalité']) && $_POST['Nationalité'] !== '' ? $_POST['Nationalité'] : null;
    $date_naissance = isset($_POST['Date_de_naissance']) && $_POST['Date_de_naissance'] !== '' ? $_POST['Date_de_naissance'] : null;
    $biographie = isset($_POST['Biographie']) && $_POST['Biographie'] !== '' ? $_POST['Biographie'] : null;

    $auteurModel->update($id, $nom, $prenom, $nationalite, $date_naissance, $biographie);
    header('Location: ../../index.php?message=updated');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un auteur</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
    <div class="bubble bubble4"></div>
    <div class="bubble bubble5"></div>
    <h1>Modifier un auteur</h1>
    <form method="POST">
        <div>
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" id="Nom" value="<?php echo htmlspecialchars($auteur->Nom ?? ''); ?>" required>
        </div>
        <div>
            <label for="Prénom">Prénom :</label>
            <input type="text" name="Prénom" id="Prénom" value="<?php echo htmlspecialchars($auteur->Prénom ?? ''); ?>" required>
        </div>
        <div>
            <label for="Nationalité">Nationalité :</label>
            <input type="text" name="Nationalité" id="Nationalité" value="<?php echo htmlspecialchars($auteur->Nationalité ?? ''); ?>">
        </div>
        <div>
            <label for="Date_de_naissance">Date de naissance :</label>
            <input type="date" name="Date_de_naissance" id="Date_de_naissance" value="<?php echo htmlspecialchars($auteur->Date_de_naissance ?? ''); ?>">
        </div>
        <div>
            <label for="Biographie">Biographie :</label>
            <textarea name="Biographie" id="Biographie" rows="4"><?php echo htmlspecialchars($auteur->Biographie ?? ''); ?></textarea>
        </div>
        <input type="submit" value="Mettre à jour" class="btn-action">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>
</body>

</html>