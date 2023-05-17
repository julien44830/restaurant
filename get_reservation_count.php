<?php
include 'config/conn_bdd.php';

// Récupérer la date passée en paramètre
$date = isset($_GET['date']) ? $_GET['date'] : '';
$periode = isset($_GET['periode']) ? $_GET['periode'] : '';

// Vérifier si les paramètres sont présents
if (!empty($date) && !empty($periode)) {
  // Préparer la requête SQL
  $sql = "SELECT * FROM reservation WHERE date = ? AND periode = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $date, $periode);
  $stmt->execute();
  $result = $stmt->get_result();

  // Récupérer le nombre total de personnes par réservation pour la date donnée
  $reservations = [];
  while ($row = $result->fetch_assoc()) {
    $reservations[] = $row['nb_couverts'];
  }

  // Calculer le nombre total de personnes pour la date donnée
  $totalCouverts = array_sum($reservations);

  // Retourner le résultat en JSON
  echo json_encode(['total_couverts' => $totalCouverts]);
} else {
  echo json_encode(['error' => 'Missing parameters']);
}

// Fermer la connexion à la base de données
if (isset($stmt)) {
  $stmt->close();
}
$conn->close();
?>
