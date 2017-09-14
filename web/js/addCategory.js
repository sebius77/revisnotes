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

        alert('test');
        var form = $(this);
        $.ajax({
            type: "POST",
            contentType: 'multipart/form-data; charset=UTF-8',
            url: Ajouter,
            data: form.serialize(),
            success: function(reponse) {
                console.log('réussite');
            }
        });
    });

});