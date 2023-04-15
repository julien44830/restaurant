const heure_Actuelle = new Date();
console.log(heure_Actuelle);
const dateInput = document.getElementById('reservation-date');
let heureFermeture = new Date();
heureFermeture.setHours(23, 15); // Remplacez ces valeurs par l'heure de fermeture de votre restaurant

const selectHeure = document.querySelector('select[name="time"]');



dateInput.addEventListener('change', function() {
  const selectedDate = new Date(dateInput.value);
  if (selectedDate < heure_Actuelle || heure_Actuelle >= heureFermeture) {
    selectHeure.style.display = 'none';
  } else {
    selectHeure.style.display = 'block';
  }
});

// Vérifier la date de réservation par défaut
if (heure_Actuelle >= heureFermeture) {
  selectHeure.style.display = 'none';
} else {
  const selectedDate = new Date(dateInput.value);
  if (selectedDate < heure_Actuelle || heure_Actuelle >= heureFermeture) {
    selectHeure.style.display = 'none';
  } else {
    selectHeure.style.display = 'block';
  }
}

window.addEventListener('load', function() {
  console.log('test2');
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

  function updateReservationsCount(date) {
    // Envoyer une requête AJAX pour récupérer le nombre de réservations pour cette date
    fetch('get_reservation_count.php?date=' + date)
      .then(response => response.json())
      .then(data => {
        console.log(data)
        // Afficher le nombre de personnes restantes
        const capacite_max = 20; // Définir la capacité maximale de personnes par jour
        const nb_personnes = data.nb_couverts;
        const nb_personnes_restantes = capacite_max - nb_personnes;

        if (data === null) {
          console.error('La requête a retourné un résultat invalide.');
          return;
        }

        // Vérifier que le nb_couverts est présent dans le résultat
        if (!('nb_couverts' in data)) {
          console.error('Le champ nb_couverts est manquant dans le résultat de la requête.');
          return;
        }

        if (nb_personnes_restantes <= 0) {
          const btn = document.getElementsByClassName("btn");
          console.log(btn);
          btn[0].disabled = true;
          nbReservationsRestantesElement.textContent = 'le nombre de réservation maximum pour ce jour est atteind';
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
  updateReservationsCount(currentDate);

  // Écouter les changements de la date sélectionnée et mettre à jour le nombre de réservations restantes et la liste déroulante du nombre de couverts
  dateInput.addEventListener('change', function() {
    const selectedDate = dateInput.value;
    updateReservationsCount(selectedDate);
  });
});
