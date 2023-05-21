document.addEventListener('DOMContentLoaded', function() {
  const selectTime = document.getElementById('time');
  const selectPeriod = document.querySelector('select[id="time"]');
  const heure_Actuelle = new Date();
  let currentPeriod = getCurrentPeriod(heure_Actuelle); // Stocker la période sélectionnée

  function getSelectedDayOfWeek(selectedDate) {
    const dateObj = new Date(selectedDate);
    const dayOfWeek = dateObj.getDay();

    // Tableau de correspondance entre les jours de la semaine en chiffres et les jours de la semaine en texte
    const joursSemaineTexte = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    // Convertir le jour de la semaine en texte
    return joursSemaineTexte[dayOfWeek];
  }

  function updateSelectOptions(selectedDate) {
    const selectedDayOfWeek = getSelectedDayOfWeek(selectedDate);

    selectPeriod.value = currentPeriod;
   

    // Effectuer une requête AJAX pour récupérer les horaires depuis le serveur
    fetch(`get_horaires.php?jour_de_la_semaine=${selectedDayOfWeek}`)
      .then(response => response.json())
      .then(data => {
        const horaires = data;

        const heuresDisponibles = [];
        if (horaires.ferme_midi == 1) {
          heuresDisponibles.push('<option value="" disabled>Restaurant fermé le midi</option>');
        } else {
          let currentTimemidi = new Date();
          if (selectedDate === currentDate && currentPeriod === 'midi') {
            const currentHour = currentTimemidi.getHours();
            const currentMinute = currentTimemidi.getMinutes();
            const openingHour = parseInt(horaires.heure_ouverture_midi.split(':')[0]);
            const openingMinute = parseInt(horaires.heure_ouverture_midi.split(':')[1]);

            if (currentHour < openingHour || (currentHour === openingHour && currentMinute < openingMinute)) {
              currentTimemidi.setHours(openingHour, openingMinute);
            } else {
              currentTimemidi.setMinutes(currentTimemidi.getMinutes() + 15);
            }
          } else {
            currentTimemidi.setHours(horaires.heure_ouverture_midi.split(':')[0], horaires.heure_ouverture_midi.split(':')[1]);
          }

          const endTimemidi = new Date();
          
          const heureFermetureMidi = new Date();
          heureFermetureMidi.setHours(horaires.heure_fermeture_midi.split(':')[0], horaires.heure_fermeture_midi.split(':')[1]);
          heureFermetureMidi.setMinutes(heureFermetureMidi.getMinutes() - 45);
          endTimemidi.setHours(heureFermetureMidi.getHours(), heureFermetureMidi.getMinutes());
                    console.log(endTimemidi +- 1);

          while (currentTimemidi < endTimemidi) {
            heuresDisponibles.push(`<option name="periode" value="${currentTimemidi.toLocaleTimeString('fr-FR', { hour: '2-digit' , minute: '2-digit' })}">${currentTimemidi.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</option>`);
            currentTimemidi.setMinutes(currentTimemidi.getMinutes() + 15);
          }
        }

        if (horaires.ferme_soir == 1) {
          heuresDisponibles.push('<option value="" disabled>Restaurant fermé le soir</option>');
        } else {
          let currentTimesoir = new Date();
          if (selectedDate === currentDate && currentPeriod === 'soir') {
            const currentHour = currentTimesoir.getHours();
            const currentMinute = currentTimesoir.getMinutes();
            const openingHour = parseInt(horaires.heure_ouverture_soir.split(':')[0]);
            const openingMinute = parseInt(horaires.heure_ouverture_soir.split(':')[1]);

            if (currentHour < openingHour || (currentHour === openingHour && currentMinute < openingMinute)) {
              currentTimesoir.setHours(openingHour, openingMinute);
            } else {
              currentTimesoir.setMinutes(currentTimesoir.getMinutes() + 15);
            }
          } else {
            currentTimesoir.setHours(horaires.heure_ouverture_soir.split(':')[0], horaires.heure_ouverture_soir.split(':')[1]);
          }

          const endTimesoir = new Date();
          const heureFermeturesoir = new Date();
          heureFermeturesoir.setHours(horaires.heure_fermeture_soir.split(':')[0], horaires.heure_fermeture_soir.split(':')[1]);
          heureFermeturesoir.setMinutes(heureFermeturesoir.getMinutes() - 45);
          endTimesoir.setHours(heureFermeturesoir.getHours(), heureFermeturesoir.getMinutes());
          console.log(endTimesoir);

          while (currentTimesoir < endTimesoir) {
            heuresDisponibles.push(`<option name="periode" value="${currentTimesoir.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}">${currentTimesoir.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</option>`);
            currentTimesoir.setMinutes(currentTimesoir.getMinutes() + 15);
          }
        }

        selectTime.innerHTML = heuresDisponibles.join('');
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
    currentPeriod = getCurrentPeriod(heure_Actuelle); // Mettre à jour la période sélectionnée
    updateSelectOptions(selectedDate);
  });

  // Déterminer la période actuelle en fonction de l'heure
  function getCurrentPeriod(currentTime) {
    const heureOuvertureSoir = new Date();
    heureOuvertureSoir.setHours(18, 0); // Remplacez cette valeur par l'heure d'ouverture du soir

    // Récupérer l'heure sélectionnée du champ select-time
    const selectedTime = selectTime.value;
    const selectedHour = parseInt(selectedTime.split(':')[0]);

    if (selectedHour < 16) {
      return 'midi';
    } else if (currentTime < heureOuvertureSoir) {
      return 'midi';
    } else {
      return 'soir';
    }
  }
});
