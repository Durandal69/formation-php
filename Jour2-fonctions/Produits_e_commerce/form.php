<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="classe_produit.php" method="post">
        <div class="produit">
        <label for="nom">Nom du produit:</label>
        <input type="text" id="nom" name="nom" required><br>
        </div>

        <div class="produit">
        <label for="prix">Prix:</label>
        <input type="number" id="prix" name="prix" step="0.01" required><br>
        </div>

        <div class="produit">
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br>
        </div>

        <div class="produit">
        <label for="actif">Actif:</label>
        <select id="actif" name="actif">
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select><br>
        </div>

        <div class="produit">
        <input type="submit" value="Créer le produit">
        </div>
    </form>


</body>
</html>