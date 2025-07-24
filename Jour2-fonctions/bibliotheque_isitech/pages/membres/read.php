<?php

require_once '../../config/database.php';
require_once '../../classes/Membre.php';

$membreModel = new Membre($pdo);
$membre = $membreModel->findById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du membre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <h1>Détails du membre</h1>
    <?php if ($membre): ?>
    <table>
        <tr><th>ID</th><td><?php echo htmlspecialchars($membre->id); ?></td></tr>
        <tr><th>Nom</th><td><?php echo htmlspecialchars($membre->Nom); ?></td></tr>
        <tr><th>Prénom</th><td><?php echo htmlspecialchars($membre->Prénom); ?></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($membre->Email); ?></td></tr>
        <tr><th>Téléphone</th><td><?php echo htmlspecialchars($membre->Téléphone); ?></td></tr>
        <tr><th>Adresse</th><td><?php echo htmlspecialchars($membre->Adresse); ?></td></tr>
        <tr><th>Date de naissance</th><td><?php echo htmlspecialchars($membre->Date_de_naissance); ?></td></tr>
        <tr><th>Date inscription</th><td><?php echo htmlspecialchars($membre->Date_inscription); ?></td></tr>
        <tr><th>Statut</th><td><?php echo htmlspecialchars($membre->Statut); ?></td></tr>
    </table>
    <a href="update.php?id=<?php echo $membre->id; ?>" class="btn-action">Modifier</a>
    <a href="delete.php?id=<?php echo $membre->id; ?>" class="btn-action" onclick="return confirm('Supprimer ce membre ?');">Supprimer</a>
    <a href="index.php" class="btn-action">Retour</a>
    <?php else: ?>
    <p>Membre introuvable.</p>
    <?php endif; ?>
</body>
</html>