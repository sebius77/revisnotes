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
                console.log(reponse);
                if(reponse.message === true) {
                    $catMessage.append('<div class="alert alert-success">La catégorie a été ajoutée avec succès !!</div>');
                    $catMessage.show();
                } else if (reponse.message === 1) {
                    $catMessage.append('<div class="alert alert-danger">Le fichier n\'est pas au bon format !!</div>');
                    $catMessage.show();
                } else if (reponse === 2){
                    $catMessage.append('<div class="alert alert-danger">La taille de votre fichier est trop grande !!</div>');
                    $catMessage.show();
                }

                $catMessage.fadeOut(5000);
                $catMessage.html();
                refresh();

            }

        });

    });

});