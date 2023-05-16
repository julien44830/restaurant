document.addEventListener('DOMContentLoaded', function() {
  const selectTime = document.getElementById('select-time');

  function getSelectedDayOfWeek(selectedDate) {
    const dateObj = new Date(selectedDate);
    const dayOfWeek = dateObj.getDay();

    // Convertir le jour de la semaine en chiffre (lundi: 1, mardi: 2, ..., dimanche: 7)
    return dayOfWeek === 0 ? 7 : dayOfWeek;
  }

  function updateSelectOptions(selectedDate) {
    const selectedDayOfWeek = getSelectedDayOfWeek(selectedDate);
    console.log(selectedDayOfWeek);

    // Effectuer une requête AJAX pour récupérer les horaires depuis le serveur
    fetch(`get_horaires.php?jour_de_la_semaine=${selectedDayOfWeek}`)
      .then(response => response.json())
      .then(data => {
        
        console.log('Données récupérées depuis get_horaires.php:', data);
        
        const horaires = data;
        console.log('Horaires:', horaires);
        console.log(horaires.ferme_midi);
        console.log(horaires.ferme_soir);
        console.log(horaires.jour_de_la_semaine);


        const heuresDisponibles = [];
        console.log('Heures disponibles après mise à jour:', heuresDisponibles);

        if (horaires.ferme_midi == 1) {
          selectTime.innerHTML = '<option value="" disabled>Restaurant fermé le midi</option>';
        } else {
          let currentTime = new Date();
          currentTime.setHours(horaires.heure_ouverture_midi.split(':')[0], horaires.heure_ouverture_midi.split(':')[1]);
          const endTime = new Date();
          endTime.setHours(horaires.heure_fermeture_midi.split(':')[0], horaires.heure_fermeture_midi.split(':')[1]);

          while (currentTime < endTime) {
            heuresDisponibles.push(currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' }));
            currentTime.setMinutes(currentTime.getMinutes() + 15);
          }
          selectTime.innerHTML = heuresDisponibles.map(heure => `<option value="${heure}">${heure}</option>`).join('');
        }

        if (horaires.ferme_soir == 1) {
          selectTime.innerHTML = '<option value="" disabled>Restaurant fermé le soir</option>';
        } else {
          let currentTime = new Date();
          currentTime.setHours(horaires.heure_ouverture_soir.split(':')[0], horaires.heure_ouverture_soir.split(':')[1]);
          const endTime = new Date();
          endTime.setHours(horaires.heure_fermeture_soir.split(':')[0], horaires.heure_fermeture_soir.split(':')[1]);

          while (currentTime < endTime) {
            heuresDisponibles.push(currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' }));
            currentTime.setMinutes(currentTime.getMinutes() + 15);
          }
          selectTime.innerHTML = heuresDisponibles.map(heure => `<option value="${heure}">${heure}</option>`).join('');

        }

        console.log('Heures disponibles après mise à jour:', heuresDisponibles);

        // Mettre à jour les options du select avec les heures disponibles
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la récupération des horaires : ', error);
      });
  }

  // Mettre à jour les horaires disponibles au chargement de la page
  const currentDate = new Date().toISOString().split('T')[0];
  updateSelectOptions(currentDate);

  // Écouter les changements de la date et mettre à jour les horaires disponibles
  document.getElementById('reservation-date').addEventListener('change', function() {
    const selectedDate = this.value;
    console.log('Changement de date détecté:', this.value);


    updateSelectOptions(selectedDate);
  });
});
