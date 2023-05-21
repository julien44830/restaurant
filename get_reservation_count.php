<?php
include 'config/conn_bdd.php';

// Récupérer la date passée en paramètre
$date = isset($_GET['date']) ? $_GET['date'] : '';
$periode = isset($_GET['periode']) ? $_GET['periode'] : '';

// Vérifier si les paramètres sont présents
if (!empty($date) && !empty($periode)) {

  // Préparer la requête SQL
  $sql = "SELECT SUM(nb_couverts) as total_couverts FROM reservation WHERE date = ? AND periode = ?";
  $stmt = $conn->prepare($sql);


    // Lier les paramètres à la requête préparée
    $stmt->bind_param("ss", $date, $periode);
    $stmt->execute();

    // Obtenir le résultat de la requête
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // Retourner le résultat en JSON
    echo json_encode($data);
  }

?>
