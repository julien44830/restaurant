window.addEventListener('load', function() {
  const dateInput = document.getElementById('reservation-date');
  const nbCouvertsSelect = document.getElementById('nb_couverts');
  const nbReservationsRestantesElement = document.querySelector('#nb_reservations_restantes');

  function updateSelectOptions(nbCouvertsRestants) {
    nbCouvertsSelect.innerHTML = '';
    for (let i = 1; i <= nbCouvertsRestants; i++) {
      const option = document.createElement('option');
      option.value = i;
      option.text = i;
      nbCouvertsSelect.appendChild(option);
    }
  };

  function updateReservationsCount(selectedDate) {
    // Envoyer une requête AJAX pour récupérer le nombre de réservations pour cette date
    fetch(`get_reservation_count.php?date=${selectedDate}&periode=''`)
    .then(response => response.json())
      .then(data => {
        // Afficher le nombre de places restantes
        const capacite_max = 20; // Définir la capacité maximale de places par période
        let nbPlacesRestantes = capacite_max;
        console.log(selectedDate);
        // console.log(reservation);
        if (data !== null && 'reservations' in data) {
          const reservations = data.reservations;
          for (const reservation of reservations) {
            if (reservation.periode === 'midi') {
              nbPlacesRestantes -= reservation.nb_couverts;
            } else if (reservation.periode === 'soir') {
              nbPlacesRestantes -= reservation.nb_couverts;
            }
          }
        }

        if (nbPlacesRestantes <= 0) {
          const btn = document.getElementsByClassName("btn");
          btn[0].disabled = true;
          nbReservationsRestantesElement.textContent = 'Le nombre de réservations maximum pour cette période est atteint.';
        } else {
          const btn = document.getElementsByClassName("btn");
          const message = `Il reste ${nbPlacesRestantes} places pour le ${selectedDate}`;
          nbReservationsRestantesElement.textContent = message;
          btn[0].disabled = false;

          // Mettre à jour la liste déroulante du nombre de couverts
          updateSelectOptions(nbPlacesRestantes);
        }
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des données : ', error);
      });
  }

  // Obtenir la date actuelle et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
  const currentDate = new Date().toISOString().split('T')[0];
  updateReservationsCount(currentDate);

  // Écouter les changements de la date sélectionnée et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
  dateInput.addEventListener('change', function() {
    const selectedPeriod = "midi";

    const selectedDate = dateInput.value;
    updateReservationsCount(selectedDate, selectedPeriod);  });
});
