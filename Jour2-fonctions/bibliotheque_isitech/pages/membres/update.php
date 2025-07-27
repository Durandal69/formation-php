<?php

require_once '../../config/database.php';
require_once '../../classes/Membre.php';

$membreModel = new Membre($pdo);
$membre = $membreModel->findById($_GET['id']);

if ($_POST) {
    $Nom = $_POST['Nom'] ?? '';
    $Prénom = $_POST['Prénom'] ?? '';
    $Email = $_POST['Email'] ?? '';
    $Téléphone = $_POST['Téléphone'] ?? '';
    $Adresse = $_POST['Adresse'] ?? '';
    $Date_de_naissance = isset($_POST['Date_de_naissance']) && $_POST['Date_de_naissance'] !== '' ? $_POST['Date_de_naissance'] : null  ;
    $Statut = $_POST['Statut'] ?? '';

    $membreModel->update($membre->ID, $Nom, $Prénom, $Email, $Téléphone, $Adresse, $Date_de_naissance, $Statut);
    header('Location: ../../index.php?message=updated');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un membre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <h1>Modifier un membre</h1>
    <form method="POST">
        <div>
            <label for="Nom">Nom :</label>
            <input type="text" name="Nom" id="Nom" value="<?php echo htmlspecialchars($membre->Nom ?? ''); ?>" required>
        </div>
        <div>
            <label for="Prénom">Prénom :</label>
            <input type="text" name="Prénom" id="Prénom" value="<?php echo htmlspecialchars($membre->Prénom ?? ''); ?>" required>
        </div>
        <div>
            <label for="Email">Email :</label>
            <input type="email" name="Email" id="Email" value="<?php echo htmlspecialchars($membre->Email ?? ''); ?>" required>
        </div>
        <div>
            <label for="Téléphone">Téléphone :</label>
            <input type="text" name="Téléphone" id="Téléphone" value="<?php echo htmlspecialchars($membre->Téléphone ?? ''); ?>">
        </div>
        <div>
            <label for="Adresse">Adresse :</label>
            <input type="text" name="Adresse" id="Adresse" value="<?php echo htmlspecialchars($membre->Adresse ?? ''); ?>">
        </div>
        <div>
            <label for="Date_de_naissance">Date de naissance :</label>
            <input type="date" name="Date_de_naissance" id="Date_de_naissance" value="<?php echo !empty($membre->Date_de_naissance) ? date('Y-m-d', strtotime($membre->Date_de_naissance)) : ''; ?>">
        </div>
        <div>
            <label for="Statut">Statut :</label>
            <input type="text" name="Statut" id="Statut" value="<?php echo htmlspecialchars($membre->Statut ?? ''); ?>">
        </div>
        <input type="submit" value="Mettre à jour" class="btn-action">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>
</body>
</html>