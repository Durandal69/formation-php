<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Emprunt.php';

    $empruntModel = new Emprunt($pdo);
    $emprunt = $empruntModel->findById($_GET['id']);

    if ($_POST) {
        $ID_livre = $_POST['ID_livre'] ?? '';
        $ID_membre = $_POST['ID_membre'] ?? '';
        $Date_emprunt = $_POST['Date_emprunt'] ?? '';
        $Date_retour_prévue = $_POST['Date_retour_prévue'] ?? '';
        $Date_retour_effective = isset($_POST['Date_retour_effective']) && $_POST['Date_retour_effective'] !== '' ? $_POST['Date_retour_effective'] : null;
        $Prolongation = isset($_POST['Prolongation']) && $_POST['Prolongation'] !== '' ? $_POST['Prolongation'] : null;
        $Notes = isset($_POST['Notes']) && $_POST['Notes'] !== '' ? $_POST['Notes'] : null;


        $empruntModel->update($emprunt->ID, $ID_livre, $ID_membre, $Date_emprunt, $Date_retour_prévue, $Date_retour_effective, $Prolongation, $Notes);
        header('Location: ../../index.php?message=updated');
        exit;
    }
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}

$pageTitle = 'Modifier un emprunt';
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
        <h1>Modifier un emprunt</h1>
        <form method="POST">
            <div>
                <label for="ID_livre">ID Livre :</label>
                <input type="number" name="ID_livre" id="ID_livre" value="<?php echo htmlspecialchars($emprunt->ID_livre ?? ''); ?>" required>
            </div>
            <div>
                <label for="ID_membre">ID Membre :</label>
                <input type="number" name="ID_membre" id="ID_membre" value="<?php echo htmlspecialchars($emprunt->ID_membre ?? ''); ?>" required>
            </div>
            <div>
                <label for="Date_emprunt">Date Emprunt :</label>
                <input type="date" name="Date_emprunt" id="Date_emprunt" value="<?php echo date('Y-m-d', strtotime($emprunt->Date_emprunt ?? '')); ?>" required>
            </div>
            <div>
                <label for="Date_retour_prévue">Date Retour Prévue :</label>
                <input type="date" name="Date_retour_prévue" id="Date_retour_prévue" value="<?php echo date('Y-m-d', strtotime($emprunt->Date_retour_prévue ?? '')); ?>" required>
            </div>
            <div>
                <label for="Date_retour_effective">Date Retour Effective :</label>
                <input type="date" name="Date_retour_effective" id="Date_retour_effective" value="<?php echo !empty($emprunt->Date_retour_effective) ? date('Y-m-d', strtotime($emprunt->Date_retour_effective)) : ''; ?>">
            </div>
            <div>
                <label for="Prolongation">Prolongation :</label>
                <input type="date" name="Prolongation" id="Prolongation" value="<?php echo !empty($emprunt->Prolongation) ? date('Y-m-d', strtotime($emprunt->Prolongation)) : ''; ?>">
            </div>
            <div>
                <label for="Notes">Notes :</label>
                <textarea name="Notes" id="Notes"><?php echo htmlspecialchars($emprunt->Notes ?? ''); ?></textarea>
            </div>
            <input type="submit" value="Mettre à jour" class="btn-action">
            <input type="reset" class="btn-action" value="Annuler">
            <a href="../../index.php" class="btn-action">Retour</a>
        </form>
    </main>

    <?php require_once '../../includes/footer.php'; ?>
</body>

</html>