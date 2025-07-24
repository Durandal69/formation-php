<?php

class Bibliotheque {
    private $livres = [];      // Collection de livres
    private $membres = [];     // Collection de membres
    private $emprunts = [];    // Emprunts en cours
    private $nom;              // Nom de la bibliothèque
    
    public function __construct($nom) {
        $this->nom = $nom;
    }
    
    // Gestion des livres
    public function ajouterLivre($livre) { // Vérifier unicité ISBN
    foreach($this->livres as $l) {
        if($l->getIsbn() === $livre->getIsbn()) {
            throw new Exception("ISBN déjà existant");
        }
    }
    $this->livres[] = $livre;
}

public function rechercherLivre($terme) {
    $resultats = [];
    foreach($this->livres as $livre) {
        if(stripos($livre->getTitre(), $terme) !== false ||
           stripos($livre->getAuteur(), $terme) !== false) {
            $resultats[] = $livre;
        }
    }
    return $resultats;
}
    
    // Gestion des membres  
    public function inscrireMembre($membre) {  }
    public function rechercherMembre($email) {  }
    
    // Gestion des emprunts
    public function creerEmprunt($emailMembre, $isbnLivre) {     
        $membre = $this->rechercherMembre($emailMembre);
    $livre = $this->rechercherLivreParIsbn($isbnLivre);
    
    $emprunt = new Emprunt($membre, $livre);
    $this->emprunts[] = $emprunt;
    return $emprunt;
}
    public function obtenirStatistiques() {
    return [
        'total_livres' => count($this->livres),
        'total_membres' => count($this->membres),
        'emprunts_en_cours' => count($this->emprunts),
        'emprunts_en_retard' => $this->compterRetards()
    ];
}

public function listerEmpruntsEnRetard() {
    $retards = [];
    foreach($this->emprunts as $emprunt) {
        if($emprunt->calculerRetard() > 0) {
            $retards[] = $emprunt;
        }
    }
    return $retards;
}

public function genererRapport() {
    $stats = $this->obtenirStatistiques();
    $retards = $this->listerEmpruntsEnRetard();
    
    // Générer HTML du rapport
    return $this->formaterRapportHTML($stats, $retards);
}
}

?>