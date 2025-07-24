<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur de Mots de Passe</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f8f9fa; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #2c3e50; }
        .config { background: #e9ecef; padding: 20px; border-radius: 8px; margin-bottom: 25px; }
        .password-item { background: #f8f9fa; padding: 15px; margin: 10px 0; border-radius: 6px; border-left: 5px solid #007bff; }
        .password-text { font-family: 'Courier New', monospace; font-size: 18px; font-weight: bold; color: #2c3e50; background: white; padding: 10px; border-radius: 4px; margin: 8px 0; letter-spacing: 1px; }
        .force-faible { border-left-color: #dc3545; background: #f8d7da; }
        .force-moyen { border-left-color: #ffc107; background: #fff3cd; }
        .force-fort { border-left-color: #28a745; background: #d4edda; }
        .force-tres-fort { border-left-color: #17a2b8; background: #d1ecf1; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 12px; color: white; font-size: 12px; font-weight: bold; }
        .badge-faible { background: #dc3545; }
        .badge-moyen { background: #ffc107; color: #212529; }
        .badge-fort { background: #28a745; }
        .badge-tres-fort { background: #17a2b8; }
        .stats { background: #f1f3f4; padding: 15px; border-radius: 6px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Générateur de Mots de Passe Sécurisés</h1>
        
        <?php
        // ===== CONFIGURATION =====
        $longueur = 12;
        $nombre_mdp = 5;
        
        $caracteres = [
            'minuscules' => 'abcdefghijklmnopqrstuvwxyz',
            'majuscules' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 
            'chiffres' => '0123456789',
            'speciaux' => '!@#$%^&*()_+-=[]{}|;:,.<>?'
        ];
        
        $types_actifs = ['minuscules', 'majuscules', 'chiffres', 'speciaux'];
        
        // ===== AFFICHAGE CONFIG =====
        echo "<div class='config'>";
        echo "<h2>⚙️ Configuration</h2>";
        echo "<p><strong>Longueur :</strong> $longueur caractères</p>";
        echo "<p><strong>Nombre de mots de passe :</strong> $nombre_mdp</p>";
        echo "<p><strong>Types de caractères :</strong> " . implode(', ', $types_actifs) . "</p>";
        
        // Construire chaîne de caractères disponibles
        $chaine_caracteres = '';
        foreach ($types_actifs as $type) {
            $chaine_caracteres .= $caracteres[$type];
        }
        echo "<p><strong>Caractères disponibles :</strong> " . strlen($chaine_caracteres) . " au total</p>";
        echo "</div>";
        
        // ===== FONCTION GÉNÉRATION =====
        function genererMotDePasse($longueur, $chaine_caracteres) {
            $mot_de_passe = '';
            $nb_caracteres = strlen($chaine_caracteres);
            
            for ($i = 0; $i < $longueur; $i++) {
                $index_aleatoire = random_int(0, $nb_caracteres - 1);
                $mot_de_passe .= $chaine_caracteres[$index_aleatoire];
            }
            
            return $mot_de_passe;
        }
        
        // ===== FONCTION ANALYSE FORCE =====
        function analyserForce($mot_de_passe) {
            $longueur = strlen($mot_de_passe);
            $score = 0;
            $criteres = [];
            
            // Critère longueur
            if ($longueur >= 8) $score += 1;
            if ($longueur >= 12) $score += 1;
            if ($longueur >= 16) $score += 1;
            
            // Critères types de caractères
            if (preg_match('/[a-z]/', $mot_de_passe)) {
                $score += 1;
                $criteres[] = "minuscules";
            }
            if (preg_match('/[A-Z]/', $mot_de_passe)) {
                $score += 1;
                $criteres[] = "majuscules";
            }
            if (preg_match('/[0-9]/', $mot_de_passe)) {
                $score += 1;
                $criteres[] = "chiffres";
            }
            if (preg_match('/[^a-zA-Z0-9]/', $mot_de_passe)) {
                $score += 2; // Bonus caractères spéciaux
                $criteres[] = "spéciaux";
            }
            
            // Détection répétitions
            $caracteres_uniques = count(array_unique(str_split($mot_de_passe)));
            if ($caracteres_uniques / $longueur > 0.7) {
                $score += 1; // Bonus diversité
            }
            
            // Classification
            if ($score <= 3) {
                $force = 'Faible';
                $classe = 'faible';
            } elseif ($score <= 5) {
                $force = 'Moyen';
                $classe = 'moyen';
            } elseif ($score <= 7) {
                $force = 'Fort';
                $classe = 'fort';
            } else {
                $force = 'Très Fort';
                $classe = 'tres-fort';
            }
            
            return [
                'force' => $force,
                'classe' => $classe,
                'score' => $score,
                'criteres' => $criteres,
                'longueur' => $longueur,
                'diversite' => $caracteres_uniques
            ];
        }
        
        // ===== GÉNÉRATION DES MOTS DE PASSE =====
        echo "<h2>🎯 Mots de passe générés</h2>";
        
        $statistiques = [
            'total' => $nombre_mdp,
            'faible' => 0,
            'moyen' => 0,
            'fort' => 0,
            'tres_fort' => 0
        ];
        
        for ($i = 1; $i <= $nombre_mdp; $i++) {
            $mot_de_passe = genererMotDePasse($longueur, $chaine_caracteres);
            $analyse = analyserForce($mot_de_passe);
            
            // Statistiques
            switch ($analyse['classe']) {
                case 'faible': $statistiques['faible']++; break;
                case 'moyen': $statistiques['moyen']++; break;
                case 'fort': $statistiques['fort']++; break;
                case 'tres-fort': $statistiques['tres_fort']++; break;
            }
            
            echo "<div class='password-item force-{$analyse['classe']}'>";
            echo "<h3>Mot de passe #$i</h3>";
            echo "<div class='password-text'>$mot_de_passe</div>";
            echo "<p>";
            echo "<span class='badge badge-{$analyse['classe']}'>{$analyse['force']}</span> ";
            echo "<strong>Score :</strong> {$analyse['score']}/8 • ";
            echo "<strong>Longueur :</strong> {$analyse['longueur']} • ";
            echo "<strong>Diversité :</strong> {$analyse['diversite']} caractères uniques";
            echo "</p>";
            echo "<p><strong>Critères respectés :</strong> " . implode(', ', $analyse['criteres']) . "</p>";
            echo "</div>";
        }
        
        // ===== STATISTIQUES GLOBALES =====
        echo "<div class='stats'>";
        echo "<h2>📊 Statistiques de génération</h2>";
        echo "<div style='display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;'>";
        
        echo "<div>";
        echo "<h4>🔴 Faibles : {$statistiques['faible']}</h4>";
        echo "<p>" . round(($statistiques['faible'] / $nombre_mdp) * 100, 1) . "%</p>";
        echo "</div>";
        
        echo "<div>";
        echo "<h4>🟡 Moyens : {$statistiques['moyen']}</h4>";
        echo "<p>" . round(($statistiques['moyen'] / $nombre_mdp) * 100, 1) . "%</p>";
        echo "</div>";
        
        echo "<div>";
        echo "<h4>🟢 Forts : {$statistiques['fort']}</h4>";
        echo "<p>" . round(($statistiques['fort'] / $nombre_mdp) * 100, 1) . "%</p>";
        echo "</div>";
        
        echo "<div>";
        echo "<h4>🔵 Très Forts : {$statistiques['tres_fort']}</h4>";
        echo "<p>" . round(($statistiques['tres_fort'] / $nombre_mdp) * 100, 1) . "%</p>";
        echo "</div>";
        
        echo "</div>";
        
        echo "<h3>💡 Conseils pour un mot de passe sécurisé :</h3>";
        echo "<ul>";
        echo "<li>Au moins <strong>12 caractères</strong></li>";
        echo "<li>Mélange de <strong>minuscules, majuscules, chiffres et caractères spéciaux</strong></li>";
        echo "<li>Éviter les <strong>mots du dictionnaire</strong></li>";
        echo "<li>Utiliser un <strong>gestionnaire de mots de passe</strong></li>";
        echo "<li>Changer régulièrement les mots de passe importants</li>";
        echo "</ul>";
        
        echo "<p><small>Générateur exécuté le " . date('d/m/Y à H:i:s') . "</small></p>";
        echo "</div>";
        ?>
        
    </div>
</body>
</html>