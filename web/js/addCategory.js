// /web/js/addCategory.js


// On récupère la div pour le message d'ajout d'une catégorie que l'on cache
$catMessage = $('#catMessage');
$catMessage.hide();

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
        $form.toggle("slide");
    });


    // Dans le cas où l'on clique sur le bouton delButton, on cache le formulaire
    $delButton.click(function(e) {
        e.preventDefault();
        $form.toggle("slide");
    });


    // Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
    $('#formCat').submit(function(e) {
        e.preventDefault();

        var formdata = new FormData(this);



        // reguête AJAX permettant l'ajout d'une catégorie
        $.ajax({
            type: "POST",
            url: Ajouter,
            contentType: false,
            processData: false,
            data: formdata,
            success: function(reponse) {
                $catMessage.show();
                $catMessage.fadeOut(5000);
                refresh();

            }
        });

    });

});