<?php
include 'templates/head.php';
include 'config/conn_bdd.php';
include 'config/start_session.php';
include 'config/delete_reservation.php';

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']){	
	$lastname = $_SESSION['lastname'];
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM reservation";
	$result = $conn->query($sql);

  echo '<h2 class="pt-5 text-center">Réservations</h2>';

	include 'includes/tableau_reservation.php';

	
	echo '
	<form class="form_reserv card  mx-auto col-lg-6 " action="reservation_action.php?t='.time().'" method="post">
		<table class="table border-0 table-bordered">
			<tr class="border-0">
				<th class="border-0">Nom :</th>
				<td class="border-0"><input type="text" class="form-control" name="username" value="' . htmlspecialchars($username) . '"></td>
			</tr>
			<tr class="border-0">
				<th class="border-0">Prénom :</th>
				<td><input type="text" class="form-control" name="user_lastname" value="' . htmlspecialchars($lastname) . '"></td>
			</tr>
			<tr>
				<th>Tel :</th>
				<td><input type="text" class="form-control" name="tel" value="' . htmlspecialchars($tel) . '"></td>
			</tr>
			<tr class="border-0">
				<th>Nombre de couverts :</th>
            <td>
            <select id="nb_couverts" name="nb_couverts" >
            </select>        
          </td>
			</tr>
			<tr>
				<th>Date :</th>
				<td>
					<input type="date" class="form-control" name="date" value="' . date('Y-m-d') . '" id="reservation-date">
					<p id="nb_reservations_restantes"></p>
				</td>
			</tr>
			<tr>
				<th>Heure :</th>
				<td>
					<select class="form-control" name="time">';
					$start_time_1 = strtotime("12:00");
					$end_time_1 = strtotime("13:15");
					$interval_1 = 15 * 60; // 15min en secondes
					for ($i=$start_time_1; $i<$end_time_1; $i+=$interval_1) {
						$time_str = date("H:i", $i);
						echo '<option value="'.$time_str.'">'.$time_str.'</option>';
					}
		
					$start_time_2 = strtotime("19:00");
					$end_time_2 = strtotime("22:15");
					$interval_2 = 15 * 60; // 15min en secondes
					for ($i=$start_time_2; $i<$end_time_2; $i+=$interval_2) {
						$time_str = date("H:i", $i);
						echo '<option value="'.$time_str.'">'.$time_str.'</option>';
					}
					echo '
					</select>
				</td>
			</tr>
			<tr>
				<th>Allergie :</th>
				<td><input type="text" class="form-control" name="user_allergy" value="'.htmlspecialchars($user_allergy).'"></td>
			</tr>

			<label class="d-none" for="user_id">Id de l\'utilisateur :</label>
			<input class="d-none" type="text" name="user_id" value="' . htmlspecialchars($user_id) . '" readonly>
	
		</table>
		<input class="btn btn-success" type="submit" value="Réserver">
	</form>';
	

} else {
	
	header("Location: login.php");
	exit;
}
include 'templates/footer.php';
?>

<script src="js/nb_reservation.js"></script>