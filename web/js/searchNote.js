// fonction permettant la recherche sur les notes de l' utilisateur

$(document).ready(function() {


    //console.log('test de fonctionnement');


    $("#rechercheNote").autocomplete({
        source: function(requete, reponse) {
        var motcle = $("#rechercheNote").val();
            $.ajax({
                type: "POST",
                url: searchNote,
                datatype: 'json',
                data: 'motcle=' + motcle,
                success: function (donnee) {
                    reponse($.map(donnee.data, function(objet){
                        return  {
                            value: objet.titre,
                            id: objet.id
                        };
                    }))
                }

            })

        },
        minLength: 3,
        select: function(event, ui) {
            //console.log(ui.item.id);
            $("#searchButton").attr('objetId', ui.item.id);
        }

    });





    $("#searchButton").click(function(e) {
        e.preventDefault();

        var id = $(this).attr('objetId');
       // console.log($(this).attr('objetId'));
        var data = 'objetId=' + $(this).attr('objetId');

        $.post(resultSearch, data, function (reponse) {
            //console.log(reponse);
            if(reponse.message === true)
            {
                $(window.location = "http://localhost/revisnotes/web/app_dev.php/read/" + id);
            }
        })
    });

});