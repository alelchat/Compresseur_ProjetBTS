//ÉTUDIANT 3
$(document).ready(function() {
  $('#myButton').click(function() {
    $.ajax({
      url: './pageCompresseurConfigurationCompte.php',
      type: 'POST',
      data: {action: 'mafonction'},
      success: function(data) {
        // Traitement à effectuer lorsque la fonction est exécutée avec succès
      },
      error: function() {
        // Traitement à effectuer en cas d'erreur
      }
    });
  });
});
