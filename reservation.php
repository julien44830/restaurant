<?php
ob_start(); // Démarre la mise en mémoire tampon de la sortie
include 'config/conn_bdd.php';
include 'get_reservation_count.php';
include 'config/delete_reservation.php';
include 'templates/head.php';
include 'templates/nav.php';

date_default_timezone_set('Europe/Paris');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
  include 'reservation_admin.php';
} elseif (isset($_SESSION['lastname'])) {
  $lastname = $_SESSION['lastname'];
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];

  $sql = "SELECT * FROM reservation WHERE id_user = '$user_id'";
  $result = $conn->query($sql);

  echo '<h2 class="pt-5 text-center">Mes réservations</h2>';

  include 'includes/tableau_reservation.php';

  echo '
  <form class="form_reserv card mx-auto col-md-4 card" action="reservation_action.php?t='.time().'" method="post">
    <table class="table border-0 table-bordered">
      <tr class="border-0">
        <th class="border-0">Nom :</th>
        <td class="border-0"><input type="text" class="form-control" name="username" value="' . htmlspecialchars($username) . '"></td>
      </tr>
      <tr class="border-0">
        <th class="border-0">Prénom :</th>
        <td class="border-0"><input type="text" class="form-control" name="user_lastname" value="' . htmlspecialchars($lastname) . '"></td>
      </tr>
      <tr class="border-0">
        <th class="border-0">Tel :</th>
        <td class="border-0"><input type="text" class="form-control" name="tel" value="' . htmlspecialchars($tel) . '"></td>
      </tr>
      <tr class="border-0">
        <th class="border-0">Nombre de couverts :</th>
        <td class="border-0">
          <select id="nb_couverts" name="nb_couverts"></select>
        </td>
      </tr>
      <tr class="border-0">
        <th class="border-0">Date :</th>
        <td class="border-0">
          <input type="hidden" name="timezone_offset" id="timezone-offset" value="">
          <input type="date" class="form-control" name="date" value="' . date('Y-m-d') . '" min="' . date('Y-m-d') . '" id="reservation-date">
          <p id="nb_reservations_restantes"></p>


        </td>
      </tr>
      <tr class="border-0">
        <th class="border-0">heure :</th>
        <td class="border-0">
          <select class="form-control" name="time" id="time">
          </select>
        </td>
      </tr>
      <tr class="border-0">
        <th class="border-0">Allergie :</th>
        <td class="border-0"><input type="text" class="form-control" name="user_allergy" value="'.htmlspecialchars($user_allergy).'"></td>
      </tr>
      <label class="d-none" for="user_id">Id de l\'utilisateur :</label>
      <input class="d-none" type="text" name="user_id" value="' . htmlspecialchars($user_id) . '" readonly>
    </table>
    <input id="btn" class="btn btn-success" type="submit" value="Réserver">
  </form>
  ';
} else {
  header("Location: login.php");
  exit;
}

include 'templates/footer.php';
ob_end_flush(); // Envoie la sortie mise en mémoire tampon
?>

<script src="js/date_reservation.js"></script>
<script src="js/nb_reservation.js"></script>
