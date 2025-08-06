<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Emprunt.php';

    $empruntModel = new Emprunt($pdo);
    $emprunt = $empruntModel->findById($_GET['id']);
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}

$pageTitle = 'Détails de l\'emprunt';
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
        <h1>Détails de l'emprunt</h1>
        <?php if ($emprunt): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Livre</th>
                        <th>Membre</th>
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
                        <td><?php echo htmlspecialchars($emprunt->Titre); ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Nom_complet); ?></td>
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
    </main>

    <?php require_once '../../includes/footer.php'; ?>
</body>

</html>