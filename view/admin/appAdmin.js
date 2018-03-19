

function modificationEtudiant(id)
{
    $("#"+id).find("input").prop('disabled', false);
    $("#"+id+" td:last").hide();
    $("#"+id).append("<td><button onclick=enregistreEtudiant("+id+") data-toggle='modal' data-target='#message' class='btn btn-primary' >Enregistrer modification</button></td> ");
}

function enregistreEtudiant(id)
{

    $.ajax({
        url : '../../model/dao/gestionEtudiant.php?p=enregistreEtudiant',
        type : 'POST', // Le type de la requête HTTP, ici devenu POST
        dataType: 'html',
        data:'idEtudiant='+id+'&nom='+$('#nom'+id).val()+'&prenom='+$('#prenom'+id).val()+'&mail='+$('#mail'+id).val()+'&identifiant='+$('#identifiant'+id).val()+'&mdp='+$('#mdp'+id).val()
    }).done(function () {

        $("#"+id).find("input").prop('disabled', true);
        $("#"+id+" td:last").remove();
        $("#"+id+" td:last").show();
    });
}

function notification(msg)
{
    $("#messageContenu").html(msg);
    $("#message").modal();
}


$( document ).ready(function() {

    $.ajax({
        url: '../../model/dao/gestionEtudiant.php?p=professeurs',
        content: 'text/html'
    })
        .done(function( html ) {
            $('#tableauEtudiant').append(html);
        });

    $("#gestionEtudiant").click(function () {

        $.ajax({
            url: "gestionEtudiant.php",
            cache: false
        })
            .done(function( html ) {

                $("li").removeClass("active");
                $("#gestionEtudiant").addClass("active");
                $("#appContent").empty();

                $("#appContent").append("<button id='ajouteEtudiant' data-toggle='modal' data-target='#contact' class='btn btn-primary btn-lg'> Ajouter un etudiant </button>")

                $( "#appContent" ).append( html );

            });

    });



     //   Gere le modal // -----------------------------------------------

    var panels = $('.vote-results');
    var panelsButton = $('.dropdown-results');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('Hide Results');
            }
            else
            {
                currentButton.html('View Results');
            }
        })
    });

});


