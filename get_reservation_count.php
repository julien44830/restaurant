<?php
include 'config/conn_bdd.php';

// Récupérer la date passée en paramètre
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Récupérer le nombre total de personnes par réservation pour la date donnée
$sql = "SELECT SUM(nb_couverts) as nb_couverts FROM reservation WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Retourner le résultat en JSON
echo json_encode($data);

// Fermer la connexion à la base de données
$stmt->close();

?>
