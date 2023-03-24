<?php
include 'config/conn_bdd.php';

session_start();

$username = $_POST['username'];
$user_lastname = $_POST['user_lastname'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$time = $_POST['time'];
$nb_user = $_POST['nb_user'];
$allergy = $_POST['allergy'];


$sql = "INSERT INTO reservation (username, user_lastname, tel, date, time, nb_user, allergy) 
        VALUES ('$username', '$user_lastname', '$tel', '$date', '$time', '$nb_user', '$allergy')";

if ($conn->query($sql) === TRUE) {
    echo "Réservation ajoutée avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
