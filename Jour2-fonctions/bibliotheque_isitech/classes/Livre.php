<?php
class Livre
{
    // Propriétés (= colonnes de votre table)
    private $pdo;         // Instance PDO pour la base de données

    // Constructeur
    public function __construct($pdo)
    {
        // Initialisation + validation
        $this->pdo = $pdo;
    }

    // Méthodes CRUD

    // CREATE - Ajouter un livre
    public function create($titre, $isbn, $auteurId, $genreId, $annee_publication, $nb_pages, $resume, $status_disponibilite, $index_appropries)
    {
        $sql = "INSERT INTO `livres`(`Titre`, `ISBN`, `Reference_vers_auteur`, `Reference_vers_genre`, `Annee_de_publication`, `Nombre_de_pages`, `Resume`, `Status_de_disponibilite`, `Index_appropries`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titre, $isbn, $auteurId, $genreId, $annee_publication, $nb_pages, $resume, $status_disponibilite, $index_appropries]);
    }




    // READ - Récupérer tous les livres
    public function getAll()
    {
        $sql = "SELECT livres.*,
            CONCAT(auteurs.Nom, ' ', auteurs.Prénom) as Nom_complet_auteur,
            genres.Nom_du_genre as Nom_du_genre
            FROM livres
            JOIN auteurs ON Reference_vers_auteur = auteurs.id
            JOIN genres ON Reference_vers_genre = genres.id
            ORDER BY date_ajout_automatique DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ou FETCH_OBJ selon si j'utilise $livre->id
    }

    // READ - Récupérer un livre par son ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT livres.*,
            CONCAT(auteurs.Nom, ' ', auteurs.Prénom) as Nom_complet_auteur,
            genres.Nom_du_genre as Nom_du_genre
            FROM livres
            JOIN auteurs ON Reference_vers_auteur = auteurs.id
            JOIN genres ON Reference_vers_genre = genres.id
            WHERE livres.id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data ?: null;
    }

    // UPDATE - Mettre à jour un livre
    public function update($id, $titre, $isbn, $auteurId, $genreId, $annee_publication, $nb_pages, $resume, $status_disponibilite, $index_appropries)
    {
        $sql = "UPDATE `livres` SET `Titre` = ?, `ISBN` = ?, `Reference_vers_auteur` = ?, `Reference_vers_genre` = ?, `Annee_de_publication` = ?, `Nombre_de_pages` = ?, `Resume` = ?, `Status_de_disponibilite` = ?, `Index_appropries` = ? WHERE `id` = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titre, $isbn, $auteurId, $genreId, $annee_publication, $nb_pages, $resume, $status_disponibilite, $index_appropries, $id]);
    }

    // DELETE - Supprimer un livre
    public function delete($id)
    {
        $sql = "DELETE FROM `livres` WHERE `id` = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    // SEARCH - Rechercher des livres par titre
    public function searchByTitle($searchTerm)
    {
        $sql = "SELECT * FROM livres WHERE Titre LIKE ? ORDER BY Titre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
