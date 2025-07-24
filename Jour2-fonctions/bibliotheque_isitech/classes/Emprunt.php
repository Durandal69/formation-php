<?php
class Emprunt
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // CREATE - Créer un nouvel emprunt

    public function create($id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $prolongation, $notes)
    {
        $sql = "INSERT INTO emprunts (ID_livre, ID_membre, Date_emprunt, Date_retour_prévue, Prolongation, Notes)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $prolongation, $notes]);
    }

    // READ - Récupérer tous les emprunts
    public function getAll()
    {
        $sql = "SELECT * FROM emprunts ORDER BY Date_emprunt DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // READ - Récupérer un emprunt par son ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM emprunts WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data ?: null;
    }

    // UPDATE - Mettre à jour un emprunt
    public function update($id, $id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effective, $prolongation, $notes)
    {
        $sql = "UPDATE emprunts SET ID_livre = ?, ID_membre = ?, Date_emprunt = ?, Date_retour_prévue = ?, Date_retour_effective = ?, Prolongation = ?, Notes = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_livre, $id_membre, $date_emprunt, $date_retour_prevue, $date_retour_effective !== '' ? $date_retour_effective : null, $prolongation !== '' ? $prolongation : null, $notes, $id]);
    }

    // DELETE - Supprimer un emprunt
    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM emprunts WHERE id = ?');
        return $stmt->execute([$id]);
    }

}
