<?php
include 'config/conn_bdd.php';
include 'config/start_session.php';

$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$date = isset($_POST['date']) ? $_POST['date'] : "";
$time = isset($_POST['time']) ? $_POST['time'] : "";
$user_lastname = isset($_POST['user_lastname']) ? $_POST['user_lastname'] : "";
$username = isset($_POST['username']) ? $_POST['username'] : "";
$tel = isset($_POST['tel']) ? $_POST['tel'] : "";
$nb_default_user = isset($_POST['nb_default_user']) ? intval($_POST['nb_default_user']) : 0;
$user_allergy = isset($_POST['user_allergy']) ? $_POST['user_allergy'] : "";
$nb_reservations = isset($_POST['nb_reservations']) ? $_POST['nb_reservations'] : "";

$sql = "SELECT COUNT(*) AS nb_reservations FROM reservation WHERE date = '$date'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($nb_reservations >= 20) {
  echo "Désolé, il n'est plus possible de réserver pour cette date.";
} else {
    $sql = "INSERT INTO reservation (id_user, username, user_lastname, tel, date, time, nb_default_user, user_allergy) 
    VALUES ('$user_id', '$username', '$user_lastname', '$tel', '$date', '$time', '$nb_default_user', '$user_allergy')";

if ($conn->query($sql) === TRUE) {
header("Location: reservation.php");
} else {
echo "Erreur : " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

?>
