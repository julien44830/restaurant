<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['id_user'])){
  $id_user = $_SESSION['id_user'];
} else {
  $id_user = "";
}


if (isset($_SESSION['username'])){
  $username = $_SESSION['username'];
} else {
  $username = "";
}

if (isset($_SESSION['lastname'])){
  $lastname = $_SESSION['lastname'];
} else {
  $lastname = "";
}

if (isset($_SESSION['tel'])) {
  $tel = $_SESSION['tel'];
} else {
  $tel = "";
}

if (isset($_SESSION['nb_default_user'])) {
  $nb_default_user = $_SESSION['nb_default_user'];
} else {
  $nb_default_user = "";
}

if (isset($_SESSION['user_allergy'])) {
  $user_allergy = $_SESSION['user_allergy'];
} else {
  $user_allergy = "";
}

if (isset($_SESSION['user_lastname'])) {
  $user_lastname = $_SESSION['user_lastname'];
} else {
  $user_lastname = "";
}

if (isset($_SESSION['date'])) {
  $date = $_SESSION['date'];
} else {
  $date = "";
}

if (isset($_SESSION['time'])) {
  $time = $_SESSION['time'];
} else {
  $time = "";
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = "";
}

if (isset($_SESSION['is_admin'])) {
  $is_admin = $_SESSION['is_admin'];
} else {
  $is_admin = "";
}

if (isset($_SESSION['images'])) {
  $images = $_SESSION['images'];
} else {
  $images = "";
}

if (isset($_SESSION['url'])) {
  $url = $_SESSION['url'];
} else {
  $url = "";
}

if (isset($_SESSION['target_file'])) {
  $target_file = $_SESSION['target_file'];
} else {
  $target_file = "";
}

if (isset($_SESSION['file_path'])) {
  $file_path = $_SESSION['file_path'];
} else {
  $file_path = "";
}

if (isset($_SESSION['date'])) {
  $date = $_SESSION['date'];
} else {
  $date = "";
}

if (isset($_SESSION['nb_reservations'])) {
  $nb_reservations  = $_SESSION['nb_reservations '];
} else {
}

if (isset($_SESSION['legend'])) {
  $legend  = $_SESSION['legend'];
} else {
  $legend = "";
}

if (isset($_POST['nb_couverts'])) {
  $nb_couverts = $_POST['nb_couverts'];
} else {
  $nb_couverts = ""; 
}

if (isset($_POST['result_menu'])) {
  $result_menu = $_POST['result_menu'];
} else {
  $result_menu = ""; 
}

if (isset($_SESSION['infos'])) {
  $infos = $_SESSION['infos'];
} else {
  $infos = ""; 
}

if (isset($_SESSION['jourSemaine'])) {
  $jourSemaine = $_SESSION['jourSemaine'];
} else {
  $jourSemaine = "";
}

?>