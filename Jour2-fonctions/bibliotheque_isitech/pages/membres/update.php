<?php

require_once '../../config/database.php';
require_once '../../classes/Membre.php';

$membreModel = new Membre($pdo);
$membre = $membreModel->findById($_GET['id']);

if ($_POST) {
    $membreModel->update(
        $_GET['id'],
        $_POST['Nom'],
        $_POST['Prénom'],
        $_POST['Email'],
        $_POST['Téléphone'],
        $_POST['Adresse'],
        $_POST['Date_de_naissance'],
        $_POST['Statut']
    );
    header('Location: index.php?message=updated');
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
        <input type="text" name="Nom" value="<?php echo htmlspecialchars($membre->Nom ?? ''); ?>" required>
        <input type="text" name="Prénom" value="<?php echo htmlspecialchars($membre->Prénom ?? ''); ?>" required>
        <input type="email" name="Email" value="<?php echo htmlspecialchars($membre->Email ?? ''); ?>" required>
        <input type="text" name="Téléphone" value="<?php echo htmlspecialchars($membre->Téléphone ?? ''); ?>">
        <input type="text" name="Adresse" value="<?php echo htmlspecialchars($membre->Adresse ?? ''); ?>">
        <input type="date" name="Date_de_naissance" value="<?php echo htmlspecialchars($membre->Date_de_naissance ?? ''); ?>">
        <input type="text" name="Statut" value="<?php echo htmlspecialchars($membre->Statut ?? ''); ?>">
        <input type="submit" value="Mettre à jour" class="btn-action">
        <a href="index.php" class="btn-action">Annuler</a>
    </form>
</body>
</html>