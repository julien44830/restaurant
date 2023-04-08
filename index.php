<?php
include 'config/start_session.php';
include 'config/conn_bdd.php';
include 'templates/head.php';
include 'templates/nav.php';

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
include 'index_admin.php';

}else{
	$sql = "SELECT id, file_path, legend FROM images";
	$result = $conn->query($sql);
	
?>
<main>
	<div class="text-center">
		<h1 class="pt-5">Le quai antique</h1>
	</div>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 text-center">
				<h2 class="m-5">Bienvenue chez nous !</h2>
				<p>Le quai antique vous accueille dans une ambiance chaleureuse et traditionnelle.</p>
			</div>
		</div>

		<div class="row  gx-3">
			<?php
				// Generate <img> tags for each image path
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<div class="col-md-6 col-lg-4">';          
						echo '<img src="' . $row["file_path"] . '" alt="' . $row["legend"] . '" title="' . $row["legend"] . '" name="" class="img-fluid img-thumbnail custom-image">';
						echo '</div>';
					}
				}
			?>
		</div>
	</div>
</main>

<?php
}
include 'templates/footer.php';
?>