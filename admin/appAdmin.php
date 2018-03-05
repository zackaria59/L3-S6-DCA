<!doctype html>
<html lang="fr">

<head>

	<link href="appAdmin.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                        <li class="active"><a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Projet diponible</span></a></li>
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion etudiant</span></a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion professeur</span></a></li>
						<li><a href="#"><i class="glyphicon glyphicon-book" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion projet</span></a></li>
						<li><a href="#"><i class="glyphicon glyphicon-th-large" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion groupe</span></a></li>
                      </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
											<?php
												 session_start();
												 echo ' Bienvenue ' .  $_SESSION['nom'] . ' !';
											 ?>
                    </header>
                </div>

				<div class="row">
					<div class="col-md-10">
						<h1> Projets diponible</h1>
					</div>
				</div>

                <div class="table-container">
							<table class="table">
								<thead>
									<tr id="tableTitre">

										<td width="40%" class="colonneTitre">
										Titre
										</td>

										<td width="20%" class="colonneTitre">
										Auteur
										</td>

										<td width="20%" class="colonneTitre">
										Thème
										</td>

										<td width="15%" class="colonneTitre">
										Nb d'étudiants max
										</td>

										<td width="15%" class="colonneTitre">
										Date
										</td>

										<td width="5%" class="colonneTitre">
										Télécharger
										</td>
									</tr>
								</thead>

								<tbody>
								</tbody>

							</table>
						</div>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <input type="text" placeholder="Project Title" name="name">
                            <input type="text" placeholder="Post of Post" name="mail">
                            <input type="text" placeholder="Author" name="passsword">
                            <textarea placeholder="Desicrption"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>

</body>

<script>

$(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});

</script>


</html>
