<?php
class Auteur
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // CREATE - Ajouter un auteur
    public function create($nom, $prenom, $nationalite, $date_naissance, $biographie)
    {
        $sql = "INSERT INTO `auteurs` (`Nom`, `Prénom`, `Nationalité`, `Date_de_naissance`, `Biographie`, `Date_de_création`)
                    VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $nationalite, $date_naissance, $biographie]);
    }

    // READ - Récupérer tous les auteurs
    public function getAll()
    {
        $sql = "SELECT * FROM auteurs ORDER BY Date_de_création DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // READ - Récupérer un auteur par son ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM auteurs WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data ?: null;
    }

    // UPDATE - Mettre à jour un auteur
    public function update($id, $nom, $prenom, $nationalite, $date_naissance, $biographie)
    {
        $sql = "UPDATE `auteurs` SET `Nom` = ?, `Prénom` = ?, `Nationalité` = ?, `Date_de_naissance` = ?, `Biographie` = ? WHERE `id` = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $nationalite, $date_naissance, $biographie, $id]);
    }

    // DELETE - Supprimer un auteur
    public function delete($id)
    {
        $sql = "DELETE FROM `auteurs` WHERE `id` = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
