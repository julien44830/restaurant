<?php
include 'config/conn_bdd.php';
include 'config/start_session.php';


// Récupérer l'identifiant de l'utilisateur
$user_id = $_SESSION['user_id'];

// Préparer la requête SQL pour récupérer le nombre de réservations de base pour l'utilisateur
$sql = "SELECT nb_default_user FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Obtenir le résultat de la requête
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Retourner le résultat en JSON
echo json_encode($data);
?>