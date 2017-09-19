// /web/js/refreshList.js

$(document).ready(function() {

    // On récupère la liste déroulante
    $select = $('#appbundle_note_categorie');



    $select.click(function(e) {
        // on vide la liste déroulante
        $select.empty();

        alert('test1');


        // On effectue une requête Ajax pour récupérer les informations de la base de données
        $.ajax({
            type: "GET",
            url: refreshList,
            success: function(reponse) {
               //console.log(reponse.listCategories);

                console.log(reponse);




            }
        });




    });









});
