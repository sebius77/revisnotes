

// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$(':button').click(function() {


    var deleteNote = "http://localhost/revisnotes/web/app_dev.php/deleteCat/" + $(this).val();

    $.get(deleteNote , function(reponse){

        console.log(reponse.message);

        if(reponse.message === true) {
            $('#divMessage').append('<div class="alert alert-success">La catégorie a bien été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
            location.reload();
        } else {
            $('#divMessage').append('<div class="alert alert-danger">La catégorie n\' a pas été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
        }
    })
});