document.addEventListener('DOMContentLoaded', function() {
  const selectTime = document.getElementById('select-time');
  const heure_Actuelle = new Date();

  function getSelectedDayOfWeek(selectedDate) {
    const dateObj = new Date(selectedDate);
    const dayOfWeek = dateObj.getDay();
  
    // Tableau de correspondance entre les jours de la semaine en chiffres et les jours de la semaine en texte
    const joursSemaineTexte = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
  
    // Convertir le jour de la semaine en texte
    return joursSemaineTexte[dayOfWeek];
  }
  
  function updateSelectOptions(selectedDate) {
    const selectedDayOfWeek = getSelectedDayOfWeek(selectedDate);
    console.log('selectedDayOfWeek:', selectedDayOfWeek);
  
    // Effectuer une requête AJAX pour récupérer les horaires depuis le serveur
    fetch(`get_horaires.php?jour_de_la_semaine=${selectedDayOfWeek}`)
      .then(response => response.json())
      .then(data => {
        console.log('Données récupérées depuis get_horaires.php:', data);
        const horaires = data;
  
        const heuresDisponibles = [];
  
        if (horaires.ferme_midi == 1) {
          heuresDisponibles.push('<option value="" disabled>Restaurant fermé le midi</option>');
        } else {
          let currentTime = new Date();
          currentTime.setHours(horaires.heure_ouverture_midi.split(':')[0], horaires.heure_ouverture_midi.split(':')[1]);
          const endTime = new Date();
          endTime.setHours(horaires.heure_fermeture_midi.split(':')[0], horaires.heure_fermeture_midi.split(':')[1]);
  
          while (currentTime < endTime) {
            if (currentTime >= heure_Actuelle) {
              heuresDisponibles.push(`<option value="${currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}">${currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</option>`);
            }
            currentTime.setMinutes(currentTime.getMinutes() + 15);
          }
        }
  
        if (horaires.ferme_soir == 1) {
          heuresDisponibles.push('<option value="" disabled>Restaurant fermé le soir</option>');
        } else {
          let currentTime = new Date();
          currentTime.setHours(horaires.heure_ouverture_soir.split(':')[0], horaires.heure_ouverture_soir.split(':')[1]);
          const endTime = new Date();
          endTime.setHours(horaires.heure_fermeture_soir.split(':')[0], horaires.heure_fermeture_soir.split(':')[1]);
  
          while (currentTime < endTime) {
            if (currentTime >= heure_Actuelle) {
              heuresDisponibles.push(`<option value="${currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}">${currentTime.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}</option>`);
            }
            currentTime.setMinutes(currentTime.getMinutes() + 15);
          }
        }
  
        selectTime.innerHTML = heuresDisponibles.join('');
  
        console.log('Heures disponibles après mise à jour:', heuresDisponibles);
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
