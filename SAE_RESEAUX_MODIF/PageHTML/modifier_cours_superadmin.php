<?php
   session_start();
   if (!isset($_SESSION['superadmin'])) {
     header('Location: index.php');
     exit();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Cours</title>
  <style>
    table {
      border-collapse: collapse;
      width: 50%;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    button {
      padding: 5px 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <table>
    <caption>Table</caption>
    <thead>
      <tr>
        <th>Nom du cours</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Plomberie</td>
        <td>
          <button onclick="supprimerLigne(this)">Supprimer</button>
          <button onclick="modifierNom(this)">Modifier</button>
        </td>
      </tr>
      <tr>
        <td>Aménagement intérieur</td>
        <td>
          <button onclick="supprimerLigne(this)">Supprimer</button>
          <button onclick="modifierNom(this)">Modifier</button>
        </td>
      </tr>  
      <tr>
        <td>Serrurier</td>
        <td>
          <button onclick="supprimerLigne(this)">Supprimer</button>
          <button onclick="modifierNom(this)">Modifier</button>
        </td>
      </tr>
      <tr>
        <td>Electricité</td>
        <td>
          <button onclick="supprimerLigne(this)">Supprimer</button>
          <button onclick="modifierNom(this)">Modifier</button>
        </td>
      </tr>
      <tr>
        <td>Finition</td>
        <td>
          <button onclick="supprimerLigne(this)">Supprimer</button>
          <button onclick="modifierNom(this)">Modifier</button>
        </td>
      </tr>
    </tbody>
  </table>

  <script>
    function supprimerLigne(button) {
      var row = button.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }

    function modifierNom(button) {
      var row = button.parentNode.parentNode;
      var nomCoursCell = row.cells[0];
      var nouveauNom = prompt("Entrez le nouveau nom du cours:");
      if (nouveauNom !== null) {
        nomCoursCell.textContent = nouveauNom;
      }
    }
  </script>

</body>
</html>
