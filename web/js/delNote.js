

// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$('#delButton').click(function(e) {

   //var deleteNote = "http://localhost/revisnotes/web/app_dev.php/deleteNote/" + $(this).val();
    var deleteNote = Routing.generate('deleteNote', { id: $(this).val() });

    $.get(deleteNote , function(reponse){

        console.log(reponse.message);

        if(reponse.message === true) {
            $('#divMessage').append('<div class="alert alert-success">La note a bien été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
            location.reload();
        } else {
            $('#divMessage').append('<div class="alert alert-danger">La note n\' a pas été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
        }
    })
});