<?php
include 'config/conn_bdd.php';

// Tableau de correspondance entre les jours de la semaine en français et les chiffres
$jourSemaineMap = [
    'lundi' => 1,
    'mardi' => 2,
    'mercredi' => 3,
    'jeudi' => 4,
    'vendredi' => 5,
    'samedi' => 6,
    'dimanche' => 7
];

// Vérification de l'existence de la clé "jour_de_la_semaine" dans la requête GET
if (isset($_GET['jour_de_la_semaine'])) {
    $jourSemaine = $_GET['jour_de_la_semaine'];

    // Vérification si le jour de la semaine est valide
    if (array_key_exists($jourSemaine, $jourSemaineMap)) {
        $jourSemaineChiffre = $jourSemaineMap[$jourSemaine];

        // Préparation de la requête SQL pour récupérer les horaires en fonction du jour de semaine
        $sqlHoraires = "SELECT jour_de_la_semaine, heure_ouverture_midi, heure_fermeture_midi, heure_ouverture_soir, heure_fermeture_soir, ferme_midi, ferme_soir FROM horaires WHERE jour_de_la_semaine = ?";
        $stmtHoraires = $conn->prepare($sqlHoraires);
        $stmtHoraires->bind_param("i", $jourSemaineChiffre);
        $stmtHoraires->execute();
        $resultHoraires = $stmtHoraires->get_result();

        if ($resultHoraires && $resultHoraires->num_rows > 0) {
            $rowHoraires = $resultHoraires->fetch_assoc();

            // Construction du tableau des horaires
            $horaires = [
                'jour_de_la_semaine' => $rowHoraires['jour_de_la_semaine'],
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

        $stmtHoraires->close();
    } else {
        // Si le jour de la semaine n'est pas valide
        echo "Jour de la semaine invalide : " . $jourSemaine;
    }
} else {
    // Si la clé "jour_de_la_semaine" n'est pas présente dans la requête GET
    echo "Paramètre 'jour_de_la_semaine' manquant";
}




// Fermeture de la connexion à la base de données
$conn->close();
?>
