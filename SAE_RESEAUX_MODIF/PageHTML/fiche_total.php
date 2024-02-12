<?php include("fiche_head.php") ?>

<style>
    .bordure {
        min-height: auto;
    }
    .block {
        height: auto;
        padding: 1%;
        margin: 1%;
    }
    form {
        height: auto;
    }
</style>

<form action="fiche_traitement.php" method="post">

<?php
$nohead = "no";
$nofoot = "no";
$nobutton = "no";
$noform = "no";

include "fiche1.php";
include "fiche2.php";
include "fiche3.php";
include "fiche4.php";
include "fiche5.php";
include "fiche6.php";
include "fiche7.php";
include "fiche8.php";

$nofoot = "yes";
$nobutton = "yes";
$numpage = "total";

include "fiche_button.php";
?>

</form>

<?php
include "fiche_foot.php";
?>