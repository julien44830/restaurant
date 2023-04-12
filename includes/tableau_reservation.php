<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($result->num_rows > 0) {

        echo '<div class="container-md admin">';
        echo '<div class="row">';
        echo '<div class="col">';

        echo '<table class="table table-striped ">';
        echo '<thead>
                <tr>
                  <th>Date</th>
                  <th>Heure</th>
                  <th>Nombre de couverts</th>
                  <th>Allergies</th>
                  <th>téléphone</th>
                  <th>nom</th>
                  <th>prenom</th>
                  <th>supprimer</th>
                </tr>
              </thead>';

        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';

            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td class="text-center">' . $row['nb_couverts'] . '</td>';
            echo '<td>' . $row['user_allergy'] . '</td>';
						echo '<td>' . $row['tel'] . '</td>';
						echo '<td>' . $row['username'] . '</td>';
						echo '<td>' . $row['user_lastname'] . '</td>';

						echo '<td >';
						echo '<form class="p-2" method="post" action="config/delete_reservation.php">';
						echo '<input type="hidden" name="id_reservation" value="' . $row['id_reservation'] . '">';
						echo '<button type="submit"><i class="fa fa-trash"></i></button>';
						echo '</form>';
						echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';


				$conn->close();
    } else {
        echo 'Vous n\'avez pas encore effectué de réservation.';
    }
    ?>
