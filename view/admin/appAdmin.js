

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

function getFormAddProjet()
{
    $("#appContent").children().hide();
    $("#formAjouteProjet").show();
}

function afficheProjet() {

    $.ajax({
        url: "../../controller/controller.php?action=projets",
        cache: false
    })
        .done(function (html) {

            $("#tableauProjets").append(html);

        });
}

$( document ).ready(function() {

    $("#txtEditor").Editor();
    afficheProjet();
    $("#appEtudiant").hide();
    $("#appProfesseur").hide();
    $("#formAjouteProjet").hide();

    $("#gestionEtudiant").click(function () {

        $.ajax({
            url: "../../controller/controller.php?action=etudiants",
            cache: false
        })
            .done(function( html ) {

                $("li").removeClass("active");
                $("#gestionEtudiant").addClass("active");
                $("#appContent").children().hide();
                $("#tableauEtudiant tr").remove();
                $("#appEtudiant").show();
                $("#appContent").append("<button id='ajouteEtudiant' data-toggle='modal' data-target='#contact' class='btn btn-primary btn-lg'> Ajouter un etudiant </button>")
                $( "#tableauEtudiant" ).append( html );

            });

    });

    $("#ajouteProjet").click(function () {
        getFormAddProjet();
    });

    $("#gestionProfesseur").click(function () {

        $.ajax({
            url: "../../controller/controller.php?action=professeurs",
            cache: false
        })
            .done(function( html ) {

                $("li").removeClass("active");
                $("#gestionProfesseur").addClass("active");
                $("#appContent").children().hide();
                $("#tableauProfesseur tr").remove();
                $("#appProfesseur").show();
                $( "#tableauProfesseur" ).append( html );

            });
    });

    $("#enregistreProjet").click(function () {

        alert(1);

        $.ajax({
            url: "../../controller/controller.php?action=ajouteProjet",
            type : 'POST', // Le type de la requête HTTP, ici devenu POST
            dataType: 'html',
            data:"titre="+$("#titre").val()+"&technologie="+$("#technologie").val()+"&description="+$("#txtEditor").val()+"&nbEtudiant="+$("#nbEtudiant").val()+"&file="+$("#projFile").val()
        })
            .done(function( html ) {

                alert(html);
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


