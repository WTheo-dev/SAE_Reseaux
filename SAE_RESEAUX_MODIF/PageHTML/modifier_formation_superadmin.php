<?php
include_once("../../APIFinale/fonctions.php");
$forms = listeFormations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
    <?php foreach ($forms as $form): ?>
       <li><?php echo $form['Intitulé de la Formation'] ?></li>
        <br>
    <?php endforeach; ?>
    </ul>

    <button onclick="redirigerVersExportExcel()">Exporter vers Excel</button>

<script>
    function redirigerVersExportExcel() {
        window.location.href = 'export-excel-formations.php';
    }
</script>
</body>
</html>