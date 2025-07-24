<?php

require_once '../../config/database.php';
require_once '../../classes/Livre.php';

$livreModel = new Livre($pdo);

$errors = [];

$id= $_GET['id'];

$livres = $livreModel->findById($id);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>ISBN</th>
                <th>Auteur ID</th>
                <th>Genre ID</th>
                <th>Date de publication</th>
                <th>Nombre de pages</th>
                <th>Résumé</th>
                <th>Disponible</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($livres): ?>
                <tr>
                    <td><?php echo htmlspecialchars($livres->id); ?></td>
                    <td><?php echo htmlspecialchars($livres->Titre); ?></td>
                    <td><?php echo htmlspecialchars($livres->ISBN); ?></td>
                    <td><?php echo htmlspecialchars($livres->Reference_vers_auteur); ?></td>
                    <td><?php echo htmlspecialchars($livres->Reference_vers_genre); ?></td>
                    <td><?php echo htmlspecialchars($livres->Annee_de_publication); ?></td>
                    <td><?php echo htmlspecialchars($livres->Nombre_de_pages); ?></td>
                    <td><textarea name="resume" id="resume" cols="20" rows="3" readonly><?php echo htmlspecialchars($livres->Resume); ?></textarea></td>
                    <td><?php echo htmlspecialchars($livres->Status_de_disponibilite); ?></td>
                    <td><?php echo htmlspecialchars($livres->Date_ajout_automatique); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $livres->id; ?>">📝</a>
                        <a href="delete.php?id=<?php echo $livres->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">❌</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="../../index.php" class="btn-action">Retour</a>
</body>
</html>