const heure_Actuelle = new Date();
console.log(heure_Actuelle);
const dateInput = document.getElementById('reservation-date');
let heureFermeture = new Date();
heureFermeture.setHours(23, 15); // Remplacez ces valeurs par l'heure de fermeture de votre restaurant

const selectHeure = document.querySelector('select[id="time"]');

function updateHeureOptions() {
  const selectedDate = new Date(dateInput.value);
  const heures = selectHeure.options;

  for (let i = 0; i < heures.length; i++) {
    const heureOption = new Date(selectedDate.getTime());
    const heureParts = heures[i].value.split(':');
    heureOption.setHours(heureParts[0], heureParts[1]);

    if (heureOption <= heure_Actuelle) {
      heures[i].style.display = 'none';
    } else {
      heures[i].style.display = 'block';
    }
  }
}

dateInput.addEventListener('change', function() {
  updateHeureOptions();
});

// Écouter les changements de l'heure sélectionnée
selectHeure.addEventListener('change', function() {
  const selectedDate = dateInput.value;
  const selectedTime = selectHeure.value;

  let selectedPeriod;

  if (parseInt(selectedTime.split(':')[0]) < 16) {
    selectedPeriod = 'midi';
  } else {
    selectedPeriod = 'soir';
  }
  console.log(selectedPeriod);
  updateReservationsCount(selectedDate, selectedPeriod);
});

// Vérifier la date de réservation par défaut
updateHeureOptions();

window.addEventListener('load', function() {
  console.log('test2');
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
  }

  function updateReservationsCount(date, periode) {
    // Envoyer une requête AJAX pour récupérer le nombre de réservations pour cette date
    fetch('get_reservation_count.php?date=' + date + '&periode=' + periode)
      .then(response => response.json())
      .then(data => {
        console.log(data);

        // Afficher le nombre de personnes restantes
        const capacite_max = 20; // Définir la capacité maximale de personnes par jour
        const total_couverts = data.total_couverts;
        const nb_personnes_restantes = capacite_max - total_couverts;

        if (data === null) {
          console.error('La requête a retourné un résultat invalide.');
          return;
        }

        // Vérifier que le total_couverts est présent dans le résultat
        if (!('total_couverts' in data)) {
          console.log(data);
          console.error('Le champ total_couverts est manquant dans le résultat de la requête.');
          return;
        }

        if (nb_personnes_restantes <= 0) {
          const btn = document.getElementsByClassName("btn");
          console.log(btn);
          btn[0].disabled = true;
          nbReservationsRestantesElement.textContent = 'Le nombre de réservations maximum pour cette période est atteint.';
          console.log(nb_personnes_restantes);
        } else {
          const btn = document.getElementsByClassName("btn");

          const message = `Il reste ${nb_personnes_restantes} places pour le ${date}`;

          nbReservationsRestantesElement.textContent = message;
          btn[0].disabled = false;

          // Mettre à jour la liste déroulante du nombre de couverts
          updateSelectOptions(nb_personnes_restantes);
        }
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des données : ', error);
      });
  }

  // Obtenir la date actuelle et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
  const currentDate = new Date().toISOString().split('T')[0];
  updateReservationsCount(currentDate, 'midi');
  updateReservationsCount(currentDate, 'soir');

  // Écouter les changements de la date sélectionnée et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
  dateInput.addEventListener('change', function() {
    const selectedDate = dateInput.value;
    console.log(selectedDate);
    updateReservationsCount(selectedDate, 'midi');
    updateReservationsCount(selectedDate, 'soir');
  });
});
