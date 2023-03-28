<?php
include 'templates/nav.php';
include 'templates/head.php';
include 'templates/header.php';
include 'config/conn_bdd.php';
include 'config/start_session.php';
include 'config/delete_reservation.php';

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']){	
	$lastname = $_SESSION['lastname'];
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM reservation";
	$result = $conn->query($sql);

	echo '<h2>Réservations</h2>';

	include 'includes/tableau_reservation.php';

	echo '
	<form action="reservation_action.php?t=<?php echo time(); ?>" method="post">

		<label for="username">Nom :</label>
		<input type="text" name="username" value="" >

		<label for="user_last_lastname ">prénom :</label>
		<input type="text" name="user_lastname" value="" >

		<label for="tel">tel :</label>
		<input type="text" name="tel" value="">

		<label for="nb_default_user">nombre de couvert :</label>
		<input type="text" name="nb_default_user" value="">

		<label for="date">date :</label>
		<input type="date" name="date" value="' . date('Y-m-d') . '" id="reservation-date">

		<p id="nb_reservations_restantes"></p>

		<label for="time">heure :</label>
		<select name="time">';
			$start_time = strtotime("12:00");
			$end_time = strtotime("13:15");
			$interval = 15 * 60; // 15min en secondes
			for ($i=$start_time; $i<$end_time; $i+=$interval) {
					$time_str = date("H:i", $i);
					echo '<option value="'.$time_str.'">'.$time_str.'</option>';
			}
		echo '
		</select>
		<label for="user_allergy">allergie :</label>
		<input type="text" name="user_allergy" value="">
		<input type="submit" value="réserver">
		<label for="user_id">Id de l\'utilisateur :</label>
		<input type="text" name="user_id" value="' . htmlspecialchars($user_id) . '" readonly>
	</form>';

} else {
	
	header("Location: login.php");
	exit;
}
include 'templates/footer.php';
?>

<script src="js/nb_reservation.js"></script>