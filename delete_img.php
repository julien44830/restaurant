<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
  header("Location: index.php");
  exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: index.php");
  exit();
}

include 'config/conn_bdd.php';

$id = $_GET['id'];
$sql = "SELECT file_path FROM images WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
  header("Location: index.php");
  exit();
}

$row = $result->fetch_assoc();
$file_path = $row['file_path'];

$sql = "DELETE FROM images WHERE id = $id";
$conn->query($sql);
unlink($file_path);

header("Location: index.php");
exit();
?>
