// web/js/delUser.js

// Dans le cas ou l'on clique sur le bouton d'ajout en Bdd, on exécute une requête Ajax.
$('#delButtonUser').click(function() {


<<<<<<< HEAD
    var deleteUser = "http://sebastiengaudin.alwaysdata.net/admin/deleteUser/" + $(this).val();
=======
    //var deleteUser = "http://localhost/revisnotes/web/app_dev.php/admin/deleteUser/" + $(this).val();
    var deleteUser = Routing.generate('deleteUser', { id: $(this).val() });
>>>>>>> 6048920b6a9909527db53d02d64d43c6c5095d94


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
