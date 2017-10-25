// web/js/revisCat.js

$(':checkbox').click(function() {

      var idCat = $(this).val();


      if($(this).is(':checked'))
      {
          var enable = "http://localhost/revisnotes/web/app_dev.php/enableCat/" + $(this).val();
          console.log('mise à jour ' + $(this).val());
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
          var disable = "http://localhost/revisnotes/web/app_dev.php/disableCat/" + $(this).val();
          console.log('retrait ' + $(this).val());
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





