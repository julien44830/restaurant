<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'conn_bdd.php';
include 'start_session.php';

if (isset($_POST['id_reservation'])) {
    $id_reservation = $_POST['id_reservation'];

    // Supprime la réservation de la base de données
    $sql = "DELETE FROM reservation WHERE id_reservation = '$id_reservation'";
    if ($conn->query($sql) === TRUE) {
        echo "La réservation a été supprimée avec succès.";
        header("Location: ../reservation.php");

    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

?>