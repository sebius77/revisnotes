// web/js/delUser.js

console.log('test au chargement du fichier js');

// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$(':button').click(function() {

    var deleteUser = Routing.generate('deleteUser', { id: $(this).val() });

    console.log(deleteUser);

    $.get(deleteUser, function(reponse){

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