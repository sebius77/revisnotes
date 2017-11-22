// web/js/revisCat.js

$(':checkbox').click(function() {

      var idCat = $(this).val();


      if($(this).is(':checked'))
      {
          var enable = Routing.generate('enableCat', { id: $(this).val() });

          $.get(enable , function(reponse) {

              if(reponse.message === true) {
                  $('#catMessage').append('<div class="alert alert-success">Mise à jour effectuée !!!</div>');
                  $('#catMessage').fadeOut(5000);
                  location.reload();
              } else {
                  $('#catMessage').append('<div class="alert alert-danger">La mise à jour n\'a pas fonctionnée !!!</div>');
                  $('#catMessage').fadeOut(5000);
              }
          })

      } else {
          var disable = Routing.generate('disableCat', { id: $(this).val() });
          $.get(disable , function(reponse) {

              if(reponse.message === true) {
                  $('#catMessage').append('<div class="alert alert-success">Mise à jour effectuée !!!</div>');
                  $('#catMessage').fadeOut(5000);
                  location.reload();
              } else {
                  $('#catMessage').append('<div class="alert alert-danger">La mise à jour n\'a pas fonctionnée !!!</div>');
                  $('#catMessage').fadeOut(5000);
              }
          })
      }
});





