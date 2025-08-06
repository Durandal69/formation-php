<?php
$pageTitle = 'Détails du membre';

try {
    require_once '../../config/database.php';
    require_once '../../classes/Membre.php';

    $membreModel = new Membre($pdo);
    $membre = $membreModel->findById($_GET['id']);
    
    if (!$membre) {
        throw new Exception("Membre introuvable");
    }
    
    // Récupère les statistiques d'emprunts
    $stats = $membreModel->getMemberStats($_GET['id']);
    
    // Récupère la liste des emprunts
    $emprunts = $membreModel->getMemberEmprunts($_GET['id']);
    
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
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php require_once '../../includes/header.php'; ?>
    
    <main class="container">
        <h1>Détails du membre</h1>
        
        <!-- Informations du membre -->
        <table>
            <tr><th>ID</th><td><?php echo htmlspecialchars($membre->id ?? $membre->ID); ?></td></tr>
            <tr><th>Nom</th><td><?php echo htmlspecialchars($membre->Nom); ?></td></tr>
            <tr><th>Prénom</th><td><?php echo htmlspecialchars($membre->Prénom ?? 'N/A'); ?></td></tr>
            <tr><th>Email</th><td><?php echo htmlspecialchars($membre->Email ?? 'N/A'); ?></td></tr>
            <tr><th>Téléphone</th><td><?php echo htmlspecialchars($membre->Téléphone ?? 'N/A'); ?></td></tr>
            <tr><th>Adresse</th><td><?php echo htmlspecialchars($membre->Adresse ?? 'N/A'); ?></td></tr>
            <tr><th>Date de naissance</th><td><?php echo htmlspecialchars($membre->Date_de_naissance ?? 'N/A'); ?></td></tr>
            <tr><th>Date inscription</th><td><?php echo htmlspecialchars($membre->Date_inscription ?? 'N/A'); ?></td></tr>
            <tr><th>Statut</th><td><?php echo htmlspecialchars($membre->Statut ?? 'N/A'); ?></td></tr>
        </table>

        <!-- Statistiques d'emprunts -->
        <h2>Statistiques d'emprunts</h2>
        <table>
            <tr><th>Total des emprunts</th><td><?php echo $stats->total_emprunts; ?></td></tr>
            <tr><th>Emprunts en cours</th><td><?php echo $stats->emprunts_en_cours; ?></td></tr>
            <tr><th>Emprunts terminés</th><td><?php echo $stats->emprunts_termines; ?></td></tr>
        </table>

        <!-- Liste des emprunts -->
        <?php if (!empty($emprunts)): ?>
            <h2>Historique des emprunts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Date d'emprunt</th>
                        <th>Date retour prévue</th>
                        <th>Date retour effective</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emprunts as $emprunt): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emprunt->Titre); ?></td>
                            <td><?php echo htmlspecialchars($emprunt->Date_emprunt); ?></td>
                            <td><?php echo htmlspecialchars($emprunt->Date_retour_prévue); ?></td>
                            <td>
                                <?php 
                                if (!empty($emprunt->Date_retour_effective)) {
                                    echo htmlspecialchars($emprunt->Date_retour_effective);
                                } else {
                                    echo '<span style="color: orange; font-weight: bold;">En cours</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if (empty($emprunt->Date_retour_effective)): ?>
                                    <span style="color: orange;">📚 En cours</span>
                                <?php else: ?>
                                    <span style="color: green;">✅ Rendu</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="../emprunts/read.php?id=<?php echo $emprunt->ID; ?>">📖</a>
                                <a href="../emprunts/update.php?id=<?php echo $emprunt->ID; ?>">📝</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Ce membre n'a aucun emprunt.</p>
        <?php endif; ?>

        <!-- Actions -->
        <div style="margin-top: 24px;">
            <a href="update.php?id=<?php echo $membre->id ?? $membre->ID; ?>" class="btn-action">Modifier</a>
            <a href="delete.php?id=<?php echo $membre->id ?? $membre->ID; ?>" class="btn-action" onclick="return confirm('Supprimer ce membre ?');">Supprimer</a>
            <a href="../../index.php" class="btn-action">Retour</a>
        </div>
    </main>
    
    <?php require_once '../../includes/footer.php'; ?>
</body>
</html>