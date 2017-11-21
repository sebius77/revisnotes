// web/js/revisCat.js

$(':checkbox').click(function() {

      var idCat = $(this).val();


      if($(this).is(':checked'))
      {
<<<<<<< HEAD
          var enable = "http://sebastiengaudin.alwaysdata.net/enableCat/" + $(this).val();
=======
          //var enable = "http://localhost/revisnotes/web/app_dev.php/enableCat/" + $(this).val();
          var enable = Routing.generate('enableCat', { id: $(this).val() });
>>>>>>> 6048920b6a9909527db53d02d64d43c6c5095d94
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
<<<<<<< HEAD
          var disable = "http://sebastiengaudin.alwaysdata.net/disableCat/" + $(this).val();
=======
          //var disable = "http://localhost/revisnotes/web/app_dev.php/disableCat/" + $(this).val();
          var disable = Routing.generate('disableCat', { id: $(this).val() });
>>>>>>> 6048920b6a9909527db53d02d64d43c6c5095d94
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





