
if (isset($_SESSION['id_user']) && $_SESSION['is_admin'] == true){
  var_dump(SESSION);
  } else {
    header("Location: index.php");
    exit;
  }
  ?> -->
