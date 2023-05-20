const heure_Actuelle = new Date();
console.log(heure_Actuelle);
const dateInput = document.getElementById('reservation-date');
let heureFermeture = new Date();
heureFermeture.setHours(23, 15); // Remplacez ces valeurs par l'heure de fermeture de votre restaurant

const selectHeure = document.querySelector('select[id="time"]');
const nbCouvertsSelect = document.getElementById('nb_couverts');
const nbReservationsRestantesElement = document.querySelector('#nb_reservations_restantes');

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


// Écouter les changements de la date sélectionnée
dateInput.addEventListener('change', function() {
  updateHeureOptions();
});

// Écouter les changements de l'heure sélectionnée
selectHeure.addEventListener('change', function() {
  const selectedDate = dateInput.value;
  const selectedTime = selectHeure.value;

  let selectedPeriod;
  let selectedHour;

  if (parseInt(selectedTime.split(':')[0]) < 16) {
    selectedPeriod = 'midi';
    selectedHour = selectedTime;
  } else {
    selectedPeriod = 'soir';
    selectedHour = selectedTime;
  }

  updateReservationsCount(selectedDate, selectedPeriod, selectedHour);
});

function updateReservationsCount(date, periode, heure) {
  // Envoyer une requête AJAX pour récupérer le nombre de réservations pour cette date, période et heure
  fetch('get_reservation_count.php?date=' + date + '&periode=' + periode + '&heure=' + heure)
    .then(response => response.json())
    .then(data => {
      if (data === null) {
        console.error('La requête a retourné un résultat invalide.');
        return;
      }

      if (!('total_couverts' in data)) {
        console.error('Le champ total_couverts est manquant dans le résultat de la requête.');
        return;
      }

      const total_couverts = data.total_couverts;
      const nb_personnes_restantes = 20 - total_couverts;

      if (nb_personnes_restantes <= 0) {
        nbReservationsRestantesElement.textContent = `Le nombre de réservations maximum pour le ${periode} est atteint.`;
        document.getElementById("btn").disabled = true;
      } else {
        nbReservationsRestantesElement.textContent = `Il reste ${nb_personnes_restantes} places pour le ${date} au ${periode}`;
        document.getElementById("btn").disabled = false;
      }

      // Mettre à jour la liste déroulante du nombre de couverts
      updateSelectOptions(nb_personnes_restantes);
    })
    .catch(error => {
      console.error('Une erreur s\'est produite lors de la récupération des données : ', error);
    });
}

function updateSelectOptions(nbCouvertsRestants) {
  nbCouvertsSelect.innerHTML = '';
  for (let i = 1; i <= nbCouvertsRestants; i++) {
    const option = document.createElement('option');
    option.value = i;
    option.text = i;
    nbCouvertsSelect.appendChild(option);
  }
}

// Obtenir la date actuelle et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
const currentDate = new Date().toISOString().split('T')[0];
updateHeureOptions();
updateReservationsCount(currentDate, 'midi', '');
updateReservationsCount(currentDate, 'soir', '');

// Écouter les changements de la date sélectionnée et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
dateInput.addEventListener('change', function() {
  const selectedDate = dateInput.value;
  const selectedTime = selectHeure.value;

  let selectedPeriod;
  let selectedHour;

  if (parseInt(selectedTime.split(':')[0]) < 16) {
    selectedPeriod = 'midi';
    selectedHour = selectedTime;
  } else {
    selectedPeriod = 'soir';
    selectedHour = selectedTime;
  }

  updateReservationsCount(selectedDate, selectedPeriod, selectedHour);
});
