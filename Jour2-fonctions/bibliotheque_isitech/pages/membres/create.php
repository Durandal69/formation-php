<?php
try {
    require_once '../../config/database.php';
    require_once '../../classes/Membre.php';

    $membreModel = new Membre($pdo);

    if ($_POST) {
        $nom = $_POST['Nom'];
        $prenom = $_POST['Prénom'];
        $email = $_POST['Email'];
        $telephone = isset($_POST['Téléphone']) && $_POST['Téléphone'] !== '' ? $_POST['Téléphone'] : null;
        $adresse = isset($_POST['Adresse']) && $_POST['Adresse'] !== '' ? $_POST['Adresse'] : null;
        $date_naissance = isset($_POST['Date_de_naissance']) && $_POST['Date_de_naissance'] !== '' ? $_POST['Date_de_naissance'] : null;
        $statut = isset($_POST['Statut']) && $_POST['Statut'] !== '' ? $_POST['Statut'] : 'Actif';

        $membreModel->create($nom, $prenom, $email, $telephone, $adresse, $date_naissance, $statut);
        header('Location: ../../index.php?message=created');
        exit;
    }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
    <div class="bubble bubble4"></div>
    <div class="bubble bubble5"></div>
    <h1>Ajouter un membre</h1>
    <form method="POST">
        <div>
            <label for="Nom">Nom:</label>
            <input type="text" name="Nom" id="Nom" required>
        </div>
        <div>
            <label for="Prénom">Prénom:</label>
            <input type="text" name="Prénom" id="Prénom" required>
        </div>
        <div>
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" required>
        </div>
        <div>
            <label for="Téléphone">Téléphone:</label>
            <input type="text" name="Téléphone" id="Téléphone">
        </div>
        <div>
            <label for="Adresse">Adresse:</label>
            <input type="text" name="Adresse" id="Adresse">
        </div>
        <div>
            <label for="Date_de_naissance">Date de naissance:</label>
            <input type="date" name="Date_de_naissance" id="Date_de_naissance">
        </div>
        <div>
            <label for="Statut">Statut:</label>
            <input type="text" name="Statut" id="Statut">
        </div>
        <input type="submit" value="Ajouter" class="btn-action">
        <input type="reset" class="btn-action" value="Annuler">
        <a href="../../index.php" class="btn-action">Retour</a>
    </form>
</body>

</html>