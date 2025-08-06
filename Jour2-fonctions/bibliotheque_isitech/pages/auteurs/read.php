<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Auteur.php';

    $auteurModel = new Auteur($pdo);
    $id = $_GET['id'];
    $auteur = $auteurModel->findById($id);
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
$pageTitle = 'Détails de l\'auteur';
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
        <h1>Détails de l'auteur</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nationalité</th>
                    <th>Date de naissance</th>
                    <th>Biographie</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($auteur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($auteur->id); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Nom); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Prénom); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Nationalité ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Date_de_naissance ?? "N/A"); ?></td>
                        <td><textarea name="resume" id="resume" cols="20" rows="3" readonly><?php echo htmlspecialchars($auteur->Biographie ?? ""); ?></textarea></td>
                        <td><?php echo htmlspecialchars($auteur->Date_de_création); ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $auteur->id; ?>">📝</a>
                            <a href="delete.php?id=<?php echo $auteur->id; ?>" onclick="return confirm('Supprimer cet auteur ?');">❌</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../../index.php" class="btn-action">Retour</a>
    </main>

    <?php require_once '../../includes/footer.php'; ?>
</body>

</html>