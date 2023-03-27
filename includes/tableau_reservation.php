<?php

if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Date</th><th>Heure</th><th>Nombre de couverts</th><th>Allergies</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';

            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td>' . $row['nb_default_user'] . '</td>';
            echo '<td>' . $row['user_allergy'] . '</td>';
            echo '<td>' . $row['id_user'] . '</td>';
						echo '<td>' . $row['tel'] . '</td>';
						echo '<td>' . $row['username'] . '</td>';

						echo '<td>';
						echo '<form method="post" action="config/delete_reservation.php">';
						echo '<input type="hidden" name="id_reservation" value="' . $row['id_reservation'] . '">';
						echo '<button type="submit"><i class="fa fa-trash"></i></button>';
						echo '</form>';
						echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';

				$conn->close();
    } else {
        echo 'Vous n\'avez pas encore effectué de réservation.';
    }
    ?>