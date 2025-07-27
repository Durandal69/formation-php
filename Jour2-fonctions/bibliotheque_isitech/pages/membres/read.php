<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Membre.php';

    $membreModel = new Membre($pdo);
    $membre = $membreModel->findById($_GET['id']);
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
    <title>Détails du membre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <h1>Détails du membre</h1>
    <?php if ($membre): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Date de naissance</th>
                    <th>Date inscription</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($membre->ID); ?></td>
                    <td><?php echo htmlspecialchars($membre->Nom); ?></td>
                    <td><?php echo htmlspecialchars($membre->Prénom); ?></td>
                    <td><?php echo htmlspecialchars($membre->Email); ?></td>
                    <td><?php echo htmlspecialchars($membre->Téléphone ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($membre->Adresse ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($membre->Date_de_naissance ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($membre->Date_inscription); ?></td>
                    <td><?php echo htmlspecialchars($membre->Statut); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $membre->ID; ?>">📝</a>
                        <a href="delete.php?id=<?php echo $membre->ID; ?>" onclick="return confirm('Supprimer ce membre ?');">❌</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="../../index.php" class="btn-action">Retour</a>
    <?php else: ?>
        <p>Membre introuvable.</p>
    <?php endif; ?>
</body>

</html>