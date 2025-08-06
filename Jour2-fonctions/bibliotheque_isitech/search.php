<?php
$pageTitle = 'Recherche - Bibliothèque';

try {
    require_once 'config/database.php';

    $type = $_GET['type'] ?? 'livres';
    $query = trim($_GET['q'] ?? '');
    $results = [];

    if ($query !== '') {
        switch ($type) {
            case 'auteurs':
                require_once 'classes/Auteur.php';
                $auteurModel = new Auteur($pdo);
                $results = $auteurModel->searchByName($query);
                break;
            case 'membres':
                require_once 'classes/Membre.php';
                $membreModel = new Membre($pdo);
                $results = $membreModel->searchByName($query);
                break;
            case 'livres':
            default:
                require_once 'classes/Livre.php';
                $livreModel = new Livre($pdo);
                $results = $livreModel->searchByTitle($query);
        }
    }
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue lors de la recherche : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    
    <main class="container">
        <h1>Résultats pour « <?= htmlspecialchars($query) ?> » dans <?= htmlspecialchars($type) ?></h1>
        
        <?php if (empty($results)): ?>
            <p>Aucun résultat trouvé.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <?php if ($type === 'livres'): ?>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Année</th>
                            <th>Actions</th>
                        <?php elseif ($type === 'auteurs'): ?>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Nationalité</th>
                            <th>Actions</th>
                        <?php elseif ($type === 'membres'): ?>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <?php if ($type === 'livres'): ?>
                                <td><?= htmlspecialchars($result->id) ?></td>
                                <td><?= htmlspecialchars($result->Titre) ?></td>
                                <td><?= htmlspecialchars($result->Annee_de_publication ?? 'N/A') ?></td>
                                <td>
                                    <a href="pages/livres/read.php?id=<?= $result->id ?>">📖</a>
                                    <a href="pages/livres/update.php?id=<?= $result->id ?>">📝</a>
                                </td>
                            <?php elseif ($type === 'auteurs'): ?>
                                <td><?= htmlspecialchars($result->id) ?></td>
                                <td><?= htmlspecialchars($result->Nom) ?></td>
                                <td><?= htmlspecialchars($result->Prénom) ?></td>
                                <td><?= htmlspecialchars($result->Nationalité ?? 'N/A') ?></td>
                                <td>
                                    <a href="pages/auteurs/read.php?id=<?= $result->id ?>">📖</a>
                                    <a href="pages/auteurs/update.php?id=<?= $result->id ?>">📝</a>
                                </td>
                            <?php elseif ($type === 'membres'): ?>
                                <td><?= htmlspecialchars($result->ID) ?></td>
                                <td><?= htmlspecialchars($result->Nom) ?></td>
                                <td><?= htmlspecialchars($result->Prénom) ?></td>
                                <td><?= htmlspecialchars($result->Email ?? 'N/A') ?></td>
                                <td>
                                    <a href="pages/membres/read.php?id=<?= $result->ID ?>">📖</a>
                                    <a href="pages/membres/update.php?id=<?= $result->ID ?>">📝</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <a href="index.php" class="btn-action">Retour à l'accueil</a>
    </main>

    <?php require_once 'includes/footer.php'; ?>
</body>
</html>