// web/js/countNote.js

function countNote()
{

    //alert('test de fonctionnement');

    // On récupère la balise span pour le nombre des notes à réviser
    var $span = $('#nbNote');


    // on vide la liste déroulante
    $span.empty();

    // On effectue une requête Ajax pour récupérer les informations de la base de données
    $.ajax({
        type: "GET",
        url: nbNote,
        success: function (reponse) {
          $span.append(reponse.message);
        }

    });
}


$(document).ready(function() {

    countNote();

});
