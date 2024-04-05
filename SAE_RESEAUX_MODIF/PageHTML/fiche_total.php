<?php include_once "fiche_head.php"; ?>

<?php
  include_once "../../APIFinale/fonctions.php";
?>

<body>

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

$numpage = "1";
include_once "fiche1.php";
$numpage = "1";
include_once "fiche2.php";
$numpage = "1";
include_once "fiche3.php";
$numpage = "1";
include_once "fiche4.php";
$numpage = "1";
include_once "fiche5.php";
$numpage = "1";
include_once "fiche6.php";
$numpage = "1";
include_once "fiche7.php";
$numpage = "1";
include_once "fiche8.php";

$nofoot = "yes";
$nobutton = "yes";
$numpage = "total";

include_once "fiche_button.php";
?>

</form>
