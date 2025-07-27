<?php
try {
    require_once 'config/database.php';
    require_once 'classes/Livre.php';
    require_once 'classes/Auteur.php';
    require_once 'classes/Membre.php';
    require_once 'classes/Emprunt.php';

    $livreModel = new Livre($pdo);
    $livres = $livreModel->getAll();

    $auteurModel = new Auteur($pdo);
    $auteurs = $auteurModel->getAll();

    $membreModel = new Membre($pdo);
    $membres = $membreModel->getAll();

    $empruntModel = new Emprunt($pdo);
    $emprunts = $empruntModel->getAll();
} catch (Exception $e) {
    echo "<div style='color:red; font-weight:bold; padding:1em; background:#ffeaea; border:2px solid #e53935; margin:2em auto; max-width:600px; border-radius:8px;'>
            Une erreur est survenue : " . htmlspecialchars($e->getMessage()) . "
          </div>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibli</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>
    <div class="bubble bubble4"></div>
    <div class="bubble bubble5"></div>
    <h1>Bibliothèque</h1>



    <h1><button class="btn-action" onclick="toggleAll(true, false, false, false)">Liste des livres</button>
    <button class="btn-action" onclick="toggleAll(false, true, false, false)">Liste des auteurs</button>
    <button class="btn-action" onclick="toggleAll(false, false, true, false)">Liste des membres</button>
    <button class="btn-action" onclick="toggleAll(false, false, false, true)">Liste des emprunts</button></h1>
    <div id="tableLivres" style="display: none;">
        <a href="pages/livres/create.php">Ajouter un livre</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Date de publication</th>
                    <th>Disponible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($livre['id']); ?></td>
                        <td><?php echo htmlspecialchars($livre['Titre']); ?></td>
                        <td><?php echo htmlspecialchars($livre['Annee_de_publication'] ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($livre['Status_de_disponibilite'] ?? "N/A"); ?></td>
                        <td>
                            <a href="pages/livres/read.php?id=<?php echo $livre['id']; ?>">📖</a>
                            <a href="pages/livres/update.php?id=<?php echo $livre['id']; ?>">📝</a>
                            <a href="pages/livres/delete.php?id=<?php echo $livre['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">❌</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



    <div id="tableAuteurs" style="display: none;">
        <a href="pages/auteurs/create.php">Ajouter un auteur</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de naissance</th>
                    <th>Nationalité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($auteurs as $auteur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($auteur->id); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Nom); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Date_de_naissance ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($auteur->Nationalité ?? "N/A"); ?></td>
                        <td>
                            <a href="pages/auteurs/read.php?id=<?php echo $auteur->id; ?>">📖</a>
                            <a href="pages/auteurs/update.php?id=<?php echo $auteur->id; ?>">📝</a>
                            <a href="pages/auteurs/delete.php?id=<?php echo $auteur->id; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet auteur ?');">❌</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



<div id="tableMembres" style="display: none;">
        <a href="pages/membres/create.php">Ajouter un membre</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date d'adhésion</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($membres as $membre): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($membre->ID); ?></td>
                        <td><?php echo htmlspecialchars($membre->Nom); ?></td>
                        <td><?php echo htmlspecialchars($membre->Date_inscription ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($membre->Email ?? "N/A"); ?></td>
                        <td>
                            <a href="pages/membres/read.php?id=<?php echo $membre->ID; ?>">📖</a>
                            <a href="pages/membres/update.php?id=<?php echo $membre->ID; ?>">📝</a>
                            <a href="pages/membres/delete.php?id=<?php echo $membre->ID; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">❌</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<div id="tableEmprunts" style="display: none;">
        <a href="pages/emprunts/create.php">Ajouter un emprunt</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Membre</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour prévue</th>
                    <th>Date de retour effective</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprunts as $emprunt): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($emprunt->ID); ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Titre); ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Nom_complet ?? "N/A"); ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Date_emprunt ?? "N/A") ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Date_retour_prevue ?? "N/A") ?></td>
                        <td><?php echo htmlspecialchars($emprunt->Date_retour_effective ?? "N/A") ?></td>
                        <td>
                            <a href="pages/emprunts/read.php?id=<?php echo $emprunt->ID; ?>">📖</a>
                            <a href="pages/emprunts/update.php?id=<?php echo $emprunt->ID; ?>">📝</a>
                            <a href="pages/emprunts/delete.php?id=<?php echo $emprunt->ID; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emprunt ?');">❌</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>



    <?php if (empty($livres)): ?>
        <p>Aucun livre trouvé, <a href="">Ajoutez le premier livre</a></p>
    <?php endif; ?>
    <?php if (empty($auteurs)): ?>
        <p>Aucun auteur trouvé, <a href="">Ajoutez le premier auteur</a></p>
    <?php endif; ?>
    <?php if (empty($membres)): ?>
        <p>Aucun membre trouvé, <a href="">Ajoutez le premier membre</a></p>
    <?php endif; ?>
    <?php if (empty($emprunts)): ?>
        <p>Aucun emprunt trouvé, <a href="">Ajoutez le premier emprunt</a></p>
    <?php endif; ?>

    <script src="js/script.js"></script>
</body>

</html>