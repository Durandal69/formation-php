<?php

try {
    require_once '../../config/database.php';
    require_once '../../classes/Emprunt.php';

    $empruntModel = new Emprunt($pdo);

    if ($_POST) {
        $ID_livre = $_POST['ID_livre'] ?? '';
        $ID_membre = $_POST['ID_membre'] ?? '';
        $Date_emprunt = $_POST['Date_emprunt'] ?? '';
        $Date_retour_prévue = $_POST['Date_retour_prévue'] ?? '';
        $Date_retour_effective = isset($_POST['Date_retour_effective']) && $_POST['Date_retour_effective'] !== '' ? $_POST['Date_retour_effective'] : null;
        $Prolongation = isset($_POST['Prolongation']) && $_POST['Prolongation'] !== '' ? $_POST['Prolongation'] : null;
        $Notes = isset($_POST['Notes']) && $_POST['Notes'] !== '' ? $_POST['Notes'] : null;

        $empruntModel->create($ID_livre, $ID_membre, $Date_emprunt, $Date_retour_prévue, $Date_retour_effective, $Prolongation, $Notes);

        header('Location: ../../index.php?message=created');
        exit;
    }
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un emprunt</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <h1>Ajouter un emprunt</h1>
    <form method="POST">
        <input type="number" name="ID_livre" placeholder="ID livre" required>
        <input type="number" name="ID_membre" placeholder="ID membre" required>
        <input type="date" name="Date_emprunt" placeholder="Date emprunt" required>
        <input type="date" name="Date_retour_prévue" placeholder="Date retour prévue" required>
        <input type="date" name="Date_retour_effective" placeholder="Date retour effective">
        <input type="text" name="Prolongation" placeholder="Prolongation">
        <textarea name="Notes" placeholder="Notes"></textarea>
        <input type="submit" value="Ajouter" class="btn-action">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>
</body>

</html>