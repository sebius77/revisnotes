// /web/js/refreshList.js

$(document).ready(function() {

    // On récupère la liste déroulante
    var $select = $('#appbundle_note_categorie');

    refresh();


    $select.change(function() {

        try {

            //console.log($select.attr());
            //console.log($(this).val());

           $(this).attr('selected');
            //alert('test');
        } catch(err) {
            alert(err);
        }

         var id = $(this).val();
         var option = $('option[value='+id+']');
         var cat = option.text();

        $('#idMere').html(cat);

    });


});



// Fonction permettant l'affichage des catégories et de leurs enfants
// dans la liste déroulante
function parseArray(tab) {

    // On récupère la liste déroulante
    var $select = $('#appbundle_note_categorie');

    $select.empty();

    $select.append('<option value="0" selected disabled>Choisissez une catégorie</option>');
    tab.forEach(function(elt) {

        $select.append('<option value="'+ elt.id +'">' + elt.nom + '</option>');

        if(elt.children)
        {
            //console.log(elt.nom + 'enfants');
            parseArray(elt.children);
        }
    });
}

// Fonction Ajax permettant d'actualiser la liste déroulante
// au chargement de la page et lorsque l'on ajoute une catégorie
function refresh() {

    // On récupère la liste déroulante
    var $select = $('#appbundle_note_categorie');

    // on vide la liste déroulante
    $select.empty();

    // On effectue une requête Ajax pour récupérer les informations de la base de données
    $.ajax({
        type: "GET",
        url: refreshList,
        success: function (reponse) {

            var listCat = reponse.listCategories;
            parseArray(listCat);


        }
    });
}
