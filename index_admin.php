<?php


if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
?>

<div class="container">

		
    <div class="row  gx-3">
        <?php
						$sql = "SELECT id, file_path FROM images";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo '<div class="col-md-6 col-lg-4">';
								echo '<img src="' . $row["file_path"] . '" alt="" name="" class="img-fluid img-thumbnail custom-image">';
								echo '<a href="delete_img.php?id=' . $row["id"] . '">Supprimer</a>';
								echo '</div>';
							}
            }
        ?>
    </div>
</div>




		<form action="upload.php" method="post" enctype="multipart/form-data">
			<input type="file" name="image">
			<input type="submit" name="submit" value="Upload">
		</form>


<?php
}else{
	header("Location: index.php");
}
include 'templates/footer.php';
?>