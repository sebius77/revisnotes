// /web/js/refreshList.js

$(document).ready(function() {

    // On récupère la liste déroulante
    var $select = $('#appbundle_note_categorie');

    refresh();


    // fonction au changement du choix dans la liste déroulante
    $select.change(function() {


         // modification de l'option sélectionnée
         $(this).attr('selected');

         // On récupère l'id du parent
         var id = $(this).val();

        $('#appbundle_categorie_image').removeAttr('disabled');

         // On récupère le nom de l'option sélectionnée
         var option = $('option[value='+id+']');
         var cat = option.text();

         // On ajoute l'id du parrent dans le champ caché
         $('#appbundle_categorie_idParent').val(id);

        $('#idMere').html(cat);

        if(id > 0)
        {
            $('#appbundle_categorie_image').attr('disabled','disabled');
        }

        console.log(id);

    });

});


// Fonction permettant l'affichage des catégories et de leurs enfants
// dans la liste déroulante
function parseArray(tab) {

    // On récupère la liste déroulante
    var $select = $('#appbundle_note_categorie');

    tab.forEach(function(elt) {

        if(elt.niveau === 2){
            $select.append('<option value="'+ elt.id +'" level="'+elt.niveau+'">---- ' + elt.nom + '</option>');
        } else if (elt.niveau === 3)
        {
            $select.append('<option value="'+ elt.id +'" level="'+elt.niveau+'">-------- ' + elt.nom + '</option>');
        } else {
            $select.append('<option value="'+ elt.id +'" level="'+elt.niveau+'">' + elt.nom + '</option>');
        }

        if(elt.children)
        {
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

    $select.append('<option value="0" level="null" selected>Choisissez une catégorie</option>');

    // On effectue une requête Ajax pour récupérer les informations de la base de données
    $.ajax({
        type: "GET",
        url: refreshList,
        success: function (reponse) {
            parseArray(reponse);
        }
    });
}
