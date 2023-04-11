window.addEventListener('load', function() {
  const dateInput = document.getElementById('reservation-date');
  
  // Récupérer l'heure actuelle en France
  const nowInFrance = new Date(Date.now() + (12 * 60 * 60 * 1000)); // 1 heure = 60 minutes * 60 secondes * 1000 millisecondes
  
  // Définir la date minimale sur la date actuelle en France
  const minDate = nowInFrance.toISOString().split('T')[0];
  dateInput.min = minDate;
});

// Récupérer le décalage horaire entre l'heure locale et UTC (en minutes)
var offset = new Date().getTimezoneOffset();

// Convertir le décalage horaire en millisecondes et l'ajouter à l'heure actuelle
var now = new Date(Date.now() + (offset * 12 * 60 * 1000));

// Définir la valeur de l'élément input avec l'offset en minutes
document.getElementById("timezone-offset").value = offset;


