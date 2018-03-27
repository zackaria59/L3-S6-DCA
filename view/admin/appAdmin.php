<!doctype html>
<html lang="fr">

<head>

	<link href="appAdmin.css" rel="stylesheet">
    <link href="gestionEtudiant.css" rel="stylesheet">
    <link href="modalAjouteEtudiant.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>


    <link href="editor.css" type="text/css" rel="stylesheet"/>
    <script src="editor.js"></script>


    <script src="appAdmin.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

</head>

<body class="home">
    <div class="display-table app">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a hef="home.html">
					<img src="../image/logo_uvhc.png" alt="Logo UVHC" class="hidden-xs hidden-sm">
                        </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class="active"><a href="appAdmin.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Projet diponible</span></a></li>
                        <li id="gestionEtudiant"><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion etudiant</span></a></li>
                        <li id="gestionProfesseur"><a href="#"><i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion professeur</span></a></li>
						<li><a href="#"><i class="glyphicon glyphicon-book" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion projet</span></a></li>
						<li><a href="#"><i class="glyphicon glyphicon-th-large" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion groupe</span></a></li>
                      </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">

											<?php
												 session_start();
												 echo ' <h4>Bienvenue ' .  $_SESSION['nom'] . ' ! </h4>';
											 ?>

                </div>



                <div id="appContent">


                    <?php
                    require("gestionProjet.html");
                    require("gestionEtudiant.html");
                    require("gestionProfesseur.html");
                    require("formAjouteProjet.html");
                    ?>

                </div>
            </div>
        </div>

    </div>

    <?php

    require("modalAjouteEtudiant.html");
    require("modalAjouteProfesseur.html");
    ?>

</body>

<script>

$(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});

</script>


</html>
