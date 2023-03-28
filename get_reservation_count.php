<?php
include 'config/conn_bdd.php';

if(isset($_GET['date'])) {
    $date = $_GET['date'];

    $sql = "SELECT COUNT(*) AS nb_reservations FROM reservation WHERE date = '$date'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nb_reservations = $row['nb_reservations'];

    $data = [
        'count' => $nb_reservations
    ];

    header('Content-Type: application/json');
    echo json_encode($data);
}
