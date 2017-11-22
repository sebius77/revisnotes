// web/js/delUser.js

console.log('test au chargement du fichier js');

<<<<<<< HEAD
    var deleteUser = Routing.generate('deleteUser', { id: $(this).val() });

    $.get(deleteUser , function(reponse){

        console.log(reponse.message);
=======
// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$(':button').click(function() {

    var deleteUser = Routing.generate('deleteUser', { id: $(this).val() });

    console.log(deleteUser);

    $.get(deleteUser, function(reponse){
>>>>>>> 151687f08da07315e2dfcdfdb1088bf44bae1201

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
