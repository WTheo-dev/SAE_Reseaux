<?php
include_once "../../APIFinale/fonctions.php";
$forms = listeFormations();
$update = false;

foreach ($forms as $form){
    $nomform = $form['Intitulé de la Formation'];
    $id = $form["ID"];
    $stripnomform = str_replace(" ", "_", $nomform);
    if (isset($_POST["supp".$stripnomform])){
        suppresionFormation($id);
        $update = true;
        break;
    }
    if (isset($_POST["modi".$stripnomform])){
        $nouvnom = $_POST["nom".$stripnomform];
        modifierFormation($id, $nouvnom, NULL, NULL);
        $update = true;
        break;
    }
}

$forms = listeFormations();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="creer_formation_superadmin.css">
    <title>modifier formations</title>
</head>
<body>
    <header class="header_page_creer_formation_superadmin">
        <div class="header_text"><img class="logo_page_creer_formation_superadmin" src="Image/APEAJ_color2.png" alt="pictogramme"></div>
        <div class="child-info">
            <!--
            <h2 class="header_page_creer_formation_superadmin">Nom Prénom du SuperAdmin</h2>
            -->
        </div>
    </header>
    <?php
    if ($update == true){
        if (isset($nouvnom)){
            echo "<br>formations modifier: ".$nomform." --> ".$nouvnom.".<br>";
        } else if (isset($nomform)) {
            echo "<br>formations supprimer: ".$nomform.".<br>";
        }
    }
    ?>
    <form action="modifier_formation_superadmin.php" method="post">
    <ul>
    <?php foreach ($forms as $form): ?>
       <?php $nomform = $form['Intitulé de la Formation']; ?>
       <li>
            <input type="text" name="nom<?php echo $nomform; ?>" value="<?php echo $nomform; ?>" />
        </li>
       <button type="submit" name="modi<?php echo $nomform; ?>">modifier</button>
       <button type="submit" name="supp<?php echo $nomform; ?>">supprimer</button>
       <br>
    <?php endforeach; ?>
    </ul>
    </form>

    <button onclick="redirigerVersExportExcel()">Exporter vers Excel</button>

<script>
    function redirigerVersExportExcel() {
        window.location.href = 'export-excel-formations.php';
    }
</script>
</body>
</html>