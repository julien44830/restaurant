	<?php
$sql = "SELECT * FROM horaires ORDER BY FIELD(jour_de_la_semaine, 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche')";
$result = mysqli_query($conn, $sql);
$horaires = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<footer class="footer-basic">

	<div class="marquee">
<span>
    <?php foreach ($horaires as $horaire): ?>
        <span><?php echo ucfirst($horaire['jour_de_la_semaine']) . ' ' . substr($horaire['heure_ouverture_midi'], 0, 5) . '-' . substr($horaire['heure_fermeture_midi'], 0, 5); ?><?php if ($horaire['heure_ouverture_soir'] && $horaire['heure_fermeture_soir']) {echo ' ' . substr($horaire['heure_ouverture_soir'], 0, 5) . '-' . substr($horaire['heure_fermeture_soir'], 0, 5);} ?></span>
    <?php endforeach; ?>
</span>

		
	</div>

	<div>
		<div>
			<div class="social">
				<a href="https://www.instagram.com/"><i class="icon ion-social-instagram fa fa-instagram"></i></a>
				<a href="https://www.snapchat.com/fr-FR"><i class="icon ion-social-snapchat fa fa-snapchat"></i></a>
				<a href="https://www.twitter.com"><i class="icon ion-social-twitter fa fa-twitter"></i></a>
				<a href="https://www.facebook.com/"><i class="icon ion-social-facebook fa fa-facebook"></i></a>
			</div>
			<ul class="list-inline">
				<li class="list-inline-item"><a href="index.php">Accueil</a></li>
				<li class="list-inline-item"><a href="reservation.php">Réservation</a></li>
				<li class="list-inline-item"><a href="mention_legales.php">Mention légales</a></li>
			</ul>
			<p class="copyright">LE QUAI ANTIQUE © 2023</p>
		</div>		
	</div>
	
</footer>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</body>
</html>