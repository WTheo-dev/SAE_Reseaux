<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";

  if (!isset($_SESSION['apprenti'])) {
    header('Location: index.php');
    exit();
  }


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Suivi</title>
    <link rel="stylesheet" href="style.css">
    <header class="header-suivi_eleve">
        <div class="logo">
          <img src="Image/APEAJ_color2.png" alt="Logo APEAJ">
          <div class="child-info">
            <h2 class="header_text_postcoeleve"><?php echo $_SESSION['apprenti']; ?></h2>
        </div>
        </div>
      </header>
</head>
<body class ="body_suivi_eleve">
    <div class="h2-suivi_eleve">
        <h2>Suivez votre avancée</h2>
    </div>
<table class="table-suivi_eleve">
<caption>Suivi des Elèves</caption>
    <thead>
        <tr class="tr-suivi_eleve">
            <th class="th-suivi_eleve">Nom de l'Éducateur</th>
            <th class="th-suivi_eleve">Prénom de l'Éducateur</th>
            <th class="th-suivi_eleve">Evaluation</th>
        </tr>
    </thead>
    <tbody>
        <tr class="tr-suivi_eleve">
            <td class="td-suivi_eleve">Nom1</td>
            <td class="td-suivi_eleve">Prénom1</td>
            <td class="td-suivi_eleve">
                <audio controls class="audio-suivi_eleve">
                    <source src="chemin/audio.mp3" type="audio/mp3">
                </audio>
            </td>
        </tr>
        <tr class="tr-suivi_eleve">
            <td class="td-suivi_eleve">Nom2</td>
            <td class="td-suivi_eleve">Prénom2</td>
            <td class="td-suivi_eleve">
                <audio controls class="audio-suivi_eleve">
                    <source src="chemin/audio2.mp3" type="audio/mp3">
                </audio>
            </td>
        </tr>
    </tbody>
</table>
    <div class="btn-suivi-eleve">
        <button class="suivi_eleve_retour" onclick="retour()">Retour</button>
    </div>
    <script src="suivi_eleve.js"></script>
</body>
</html>
