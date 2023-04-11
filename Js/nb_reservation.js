// Récupérer la date actuelle
var date = new Date();

// Récupérer le décalage horaire du fuseau horaire de l'utilisateur
var offset = date.getTimezoneOffset();

// Convertir le décalage en millisecondes
var offsetMs = offset * 60 * 1000;

// Ajouter ou soustraire le décalage à la date actuelle pour obtenir la date locale
var localDate = new Date(date.getTime() - offsetMs);

// Récupérer l'élément input date
var inputDate = document.getElementById("reservation-date");

// Définir la valeur minimale de l'attribut min sur la date locale
inputDate.min = localDate.toISOString().slice(0, 10);

// Récupérer l'élément input date
var inputDate = document.getElementById("reservation-date");

// Définir la valeur minimale de l'attribut min sur la date locale
inputDate.min = localDate.toISOString().slice(0, 10);









window.addEventListener('load', function() {
  console.log('test2');
  const dateInput = document.getElementById('reservation-date');
  const nbReservationsRestantesElement = document.querySelector('#nb_reservations_restantes');

  function updateReservationsCount(date) {
    // Envoyer une requête AJAX pour récupérer le nombre de réservations pour cette date
    fetch('get_reservation_count.php?date=' + date)
      .then(response => response.json())
      .then(data => {
        // Afficher le nombre de réservations restantes
        const nb_reservations_restantes = 20 - data.count;
        const message = `Il reste ${nb_reservations_restantes} réservations pour le ${date}`;
        nbReservationsRestantesElement.textContent = message;
      })
      .catch(error => console.error(error));
  }

  // Obtenir la date actuelle et mettre à jour le nombre de réservations restantes
  const currentDate = new Date().toISOString().split('T')[0];
  updateReservationsCount(currentDate);

  // Écouter les changements de la date sélectionnée et mettre à jour le nombre de réservations restantes
  dateInput.addEventListener('change', function() {
    const selectedDate = dateInput.value;
    updateReservationsCount(selectedDate);
  });
});
