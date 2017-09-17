// /web/js/addCategory.js

$(document).ready(function() {

    // On récupère le formulaire Catégorie que l'on cache
    $form = $('#formCategorie');
    $form.hide();

    // On récupère le bouton d'ajout pour l'affichage du formulaire des catégories
    $addCategory = $('#addCategory');

    // On récupère les boutons pour l'ajout en base de données et pour cacher le formulaire
    $delButton = $('#delButton');


    // Dans le cas ou l'on clique sur le bouton ajout de catégorie, on affiche le formulaire
    $addCategory.click(function(e) {
        e.preventDefault();
        $('#containerForm').append($form);
        $form.show();
    });


    // Dans le cas où l'on clique sur le bouton delButton, on cache le formulaire
    $delButton.click(function(e) {
        e.preventDefault();
        $form.hide();
    });


    // Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
    $('#formCat').submit(function(e) {
        e.preventDefault();

        var formdata = new FormData(this);



        // Test simple d'affichage du champ nom catégorie
        //console.log($(this.elements['nom']));


        alert('test');
        //var nom = $(this).find("#appbundle_categorie_nom").val();
        //var image = $(this).find('#appbundle_categorie_image').val();
        //var form = $('#formCat');



        $.ajax({
            type: "POST",
            url: Ajouter,
            contentType: false,
            processData: false,
            data: formdata,
            success: function(reponse) {
                console.log(reponse);
            }
        });


    });

});