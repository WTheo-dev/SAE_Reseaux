<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste d'élèves</title>
  <style>
    table {
      border-collapse: collapse;
      width: 50%;
      margin: 20px;
    }
    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    button {
      padding: 5px;
      cursor: pointer;
    }

    .header_modifier_liste_eleve{
    background-color: rgb(130,106,251); 
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }
    .child-info{
      font-family: 'Cinzel', 'sans-serif';
      font-size: 25px;
      padding-right: 1em;
    }
    .body_page_modifier_liste_eleve{
    flex-direction: column;
    margin: 0;
    padding: 0;
    height: 100vh;
    background-color: #f0f0f0;
    }

  #btnretour{
    font-family: 'Cormorant', sans-serif;
    font-size: 25px;
    margin-top: 10rem;
    background-color: blue;
    cursor: pointer;
    color: white;
  }
  </style>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body class="body_page_modifier_liste_eleve">

<?php
include_once("../../APIFinale/fonctions.php"); 
$apprentis = listeApprenti();
?>

  

  <header class="header_modifier_liste_eleve">
    <div class="header_text"><img class="logo_modifier_liste_eleve" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
  </header>

  <h2>Liste d'élèves</h2>

  <table>
    <thead>
      <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($apprentis as $apprenti) : ?>
    <tr>
        <td><?= $apprenti['prenom'] ?></td>
        <td><?= $apprenti['nom'] ?></td>
        <td>
            <button class="btn btn-primary" onclick="setModifierApprentiId(<?= $apprenti['id_apprenti'] ?>, '<?= $apprenti['prenom'] ?>', '<?= $apprenti['nom'] ?>')" data-toggle="modal" data-target="#modifierModal">Modifier</button>
            <button onclick="supprimerLigne(this)">Supprimer</button>
        </td>
    </tr>
<?php endforeach; ?>
    </tbody>
  </table>

  <div class="modal" id="modifierModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier élève</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="modificationForm">
                <input type="hidden" id="apprentiId" name="apprentiId" value="">
                  <div class="form-group">
                    <label for="nouveauNom">Nouveau Nom:</label>
                    <input type="text" class="form-control" id="nouveauNom">
                  </div>
                  <div class="form-group">
                    <label for="nouveauPrenom">Nouveau Prénom:</label>
                    <input type="text" class="form-control" id="nouveauPrenom">
                  </div>
                  <button type="submit" class="btn btn-primary">Modifier</button>
              </form>
            </div>
        </div>
    </div>
  </div>


<button onclick="redirigerVersExportExcel()">Exporter vers Excel</button>

<script src="modifier_liste_eleve.js"></script>

<div class="bouton_retour">
  <button id="btnretour" onclick="goToPagePostCoSuperAdmin()">Retour</button>
</div>

</body>
</html>
