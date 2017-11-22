// web/js/delUser.js

// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$('#delButtonUser').click(function() {

    var deleteUser = Routing.generate('deleteUser', { id: $(this).val() });

    $.get(deleteUser , function(reponse){

        console.log(reponse.message);

        if(reponse.message === true) {
            $('#divMessage').append('<div class="alert alert-success">L\'utilisateur a bien été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
            location.reload();
        } else {
            $('#divMessage').append('<div class="alert alert-danger">L\'utilisateur n\' a pas été supprimée !!!</div>');
            $('#divMessage').fadeOut(5000);
        }
    })
});
