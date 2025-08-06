<?php

class Membre
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $dateInscription;
    private $actif;
    private $empruntsEnCours;
    private $limiteEmprunts; // Par défaut 3
    private $pdo;

    public function __construct($pdo, $nom = null, $prenom = null, $email = null)
    {
        $this->pdo = $pdo;

        if ($nom && $prenom && $email) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->dateInscription = date('Y-m-d H:i:s');
            $this->actif = 1;
            $this->empruntsEnCours = 0;
            $this->limiteEmprunts = 3;
        }
    }

    public function peutEmprunter()
    {
        // Vérifie si peut emprunter
    }

    public function ajouterEmprunt($livre)
    {
        // Logique d'emprunt
    }

    private function validerEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function create($nom, $prenom, $email, $telephone, $adresse, $date_naissance, $statut)
    {
        $sql = "INSERT INTO membres (Nom, Prénom, Email, Téléphone, Adresse, Date_de_naissance, Date_inscription, Statut)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $date_naissance, $statut]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM membres ORDER BY Date_inscription DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM membres WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function update($id, $nom, $prenom, $email, $telephone, $adresse, $date_naissance, $statut)
    {
        $sql = "UPDATE membres SET Nom = ?, Prénom = ?, Email = ?, Téléphone = ?, Adresse = ?, Date_de_naissance = ?, Statut = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $date_naissance, $statut, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM membres WHERE id = ?');
        return $stmt->execute([$id]);
    }

    // SEARCH - Rechercher des membres par nom, prénom ou email
    public function searchByName($searchTerm)
    {
        $sql = "SELECT * FROM membres WHERE Nom LIKE ? OR Prénom LIKE ? OR Email LIKE ? ORDER BY Nom";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $searchTerm . '%', '%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } // pour m'expliquer à moi-même : LIKE permet de faire des recherches floues, le % est un joker qui remplace n'importe quelle chaîne de caractères, le ? est un placeholder pour éviter les injections SQL. Et il y a trois placeholders car on cherche dans trois colonnes différentes (Nom, Prénom, Email). Donc on met chaque terme de recherche dans les trois placeholders, ce qui permet de trouver des membres qui ont le terme recherché dans n'importe quelle colonne.

    public function getMemberStats($id)
    {
        $sql = "SELECT 
                COUNT(*) as total_emprunts,
                COUNT(CASE WHEN Date_retour_effective IS NULL THEN 1 END) as emprunts_en_cours,
                COUNT(CASE WHEN Date_retour_effective IS NOT NULL THEN 1 END) as emprunts_termines
            FROM emprunts 
            WHERE ID_membre = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getMemberEmprunts($id)
    {
    $sql = "SELECT emprunts.*, livres.Titre 
            FROM emprunts 
            JOIN livres ON emprunts.ID_livre = livres.id 
            WHERE emprunts.ID_membre = ? 
            ORDER BY emprunts.Date_emprunt DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
