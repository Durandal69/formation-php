<?php

require_once '../../config/database.php';
require_once '../../classes/Emprunt.php';

$empruntModel = new Emprunt($pdo);
$emprunt = $empruntModel->findById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détails de l'emprunt</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <h1>Détails de l'emprunt</h1>
    <?php if ($emprunt): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Livre</th>
                    <th>ID Membre</th>
                    <th>Date Emprunt</th>
                    <th>Date Retour Prévue</th>
                    <th>Date Retour Effective</th>
                    <th>Prolongation</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($emprunt->ID); ?></td>
                    <td><?php echo htmlspecialchars($emprunt->ID_livre); ?></td>
                    <td><?php echo htmlspecialchars($emprunt->ID_membre); ?></td>
                    <td><?php echo htmlspecialchars($emprunt->Date_emprunt); ?></td>
                    <td><?php echo date($emprunt->Date_retour_prévue ?? ""); ?></td>
                    <td><?php echo date($emprunt->Date_retour_effective ?? "/"); ?></td>
                    <td><?php echo date($emprunt->Prolongation ?? "/"); ?></td>
                    <td><?php echo htmlspecialchars($emprunt->Notes ?? "N/A"); ?></td>
                    <td>
                        <a href="update_read.php?id=<?php echo $emprunt->ID; ?>">📝</a>
                        <a href="delete.php?id=<?php echo $emprunt->ID; ?>" onclick="return confirm('Supprimer cet emprunt ?');">❌</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="../../index.php" class="btn-action">Retour</a>
    <?php else: ?>
        <p>Emprunt introuvable.</p>
    <?php endif; ?>
</body>

</html>