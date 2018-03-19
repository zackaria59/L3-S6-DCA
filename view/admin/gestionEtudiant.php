<script src="gestionEtudiant.js"></script>
<div class="container">

    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Etudiants</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Nom" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Prenom" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Adresse mail" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Identifiant" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Mot de passe" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Modifier" disabled></th>
                </tr>
                </thead>
                <tbody id="tableauEtudiant">


                </tbody>
            </table>
        </div>
    </div>
</div>