<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<?php

class Produit {

    public $nom;
    public $prix;
    public $stock;
    public $actif;

    public function __construct($nom, $prix, $stock, $actif) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->actif = $actif;
    }

    public function afficher() {
        echo "<div class='produit'>Produit choisi : <strong>{$this->nom}</strong><br> Prix : {$this->prix} €<br> Stock : {$this->stock} unités<br>";
        echo "Statut : " . ($this->actif ? "Actif" : "Inactif") . "</div>";
    }

    public function estDisponible() {
        return $this->stock > 0 && $this->actif;
    }

    public function vendreQuantite($quantite) {
        if ($this->estDisponible() && $quantite <= $this->stock) {
            $this->stock -= $quantite;
            return true;
        }
        return false;
    }

    public function ajouterStock($quantite) {
        if ($quantite > 0) {
            $this->stock += $quantite;
            return true;
        }
        return false;
    }
}



$MonProduit = new Produit($_POST['nom'], $_POST['prix'], $_POST['stock'], $_POST['actif']);


$MonProduit->afficher();

if ($MonProduit->estDisponible()) {
    echo "<p>Le produit est disponible.</p>";
} else {
    echo "<p>Le produit n'est pas disponible.</p>";
}








?>
    <form action="classe_produit.php" method="post">
        <div class="produit">
        <label for="nom">Nom du produit à vendre:</label>
        <input type="text" id="nom" name="nom"><br>
        <label for="quantite">Quantité à vendre:</label>
        <input type="number" id="quantite" name="quantite">
        <input type="submit" value="Vendre">
        </div>

        <div class="produit">
        <label for="nom">Nom du produit à ajouter au stock:</label>
        <input type="text" id="nom" name="nom"><br>
        <label for="quantite">Quantité à ajouter au stock:</label>
        <input type="number" id="quantite" name="quantite">
        <input type="submit" value="Ajouter">
        </div>
    </form>

<?php
$MonProduit->vendreQuantite($_POST['quantite']);

$MonProduit->ajouterStock($_POST['quantite']);

echo '<a href="form.php">Retour au formulaire</a>';
?>

</body>
</html>