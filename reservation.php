<?php
include 'templates/nav.php';
include 'templates/head.php';
include 'templates/header.php';
include 'config/ctrl_conn.php';



echo '
<form action="reservation_action.php" method="post">

    <label for="username">Nom :</label>
    <input type="text" name="username" value="' . htmlspecialchars($username) . '">

    <label for="user_last_lastname ">prénom :</label>
    <input type="text" name="user_lastname" value="' . htmlspecialchars($lastname) . '">

    <label for="tel">tel :</label>
    <input type="text" name="tel" value="' . htmlspecialchars($tel) . '">

    <label for="nb_user">nombre de couvert :</label>
    <input type="text" name="nb_user" value="' . htmlspecialchars($nb_user) . '">

    <label for="date">date :</label>
    <input type="date" name="date" value="">

    <label for="time">heure :</label>
    <input type="time" name="time" value="12.00">

    <label for="allergy">allergy :</label>
    <input type="text" name="allergy" value="">

    <input type="submit" value="réserver">



</form>
';

include 'templates/footer.php';
?>
