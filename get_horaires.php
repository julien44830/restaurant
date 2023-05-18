<?php
include 'config/conn_bdd.php';

if (isset($_GET['jour_de_la_semaine'])) {
    $jourSemaine = $_GET['jour_de_la_semaine'];
    
    // Préparation de la requête SQL pour récupérer les horaires en fonction du jour de semaine
    $sqlHoraires = "SELECT heure_ouverture_midi, heure_fermeture_midi, heure_ouverture_soir, heure_fermeture_soir, ferme_midi, ferme_soir FROM horaires WHERE jour_de_la_semaine = ?";
    $stmtHoraires = $conn->prepare($sqlHoraires);
    $stmtHoraires->bind_param("s", $jourSemaine);
    $stmtHoraires->execute();
    $resultHoraires = $stmtHoraires->get_result();
    
    if ($resultHoraires && $resultHoraires->num_rows > 0) {
        $rowHoraires = $resultHoraires->fetch_assoc();
        
        // Construction du tableau des horaires
        $horaires = [
            'jour_de_la_semaine' => $jourSemaine,
            'heure_ouverture_midi' => $rowHoraires['heure_ouverture_midi'],
            'heure_fermeture_midi' => $rowHoraires['heure_fermeture_midi'],
            'heure_ouverture_soir' => $rowHoraires['heure_ouverture_soir'],
            'heure_fermeture_soir' => $rowHoraires['heure_fermeture_soir'],
            'ferme_midi' => $rowHoraires['ferme_midi'],
            'ferme_soir' => $rowHoraires['ferme_soir']
        ];
        
        // Conversion du tableau en format JSON
        $jsonHoraires = json_encode($horaires);
        
        // Envoi de la réponse JSON
        header('Content-Type: application/json');
        echo $jsonHoraires;
    } else {
        // Si aucune donnée d'horaires n'est trouvée pour le jour de la semaine
        echo "Aucun horaire trouvé pour le jour de la semaine : " . $jourSemaine;
    }
    

}

// Fermeture de la connexion à la base de données

?>
