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
}
