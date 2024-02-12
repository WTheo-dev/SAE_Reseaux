<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<?php include "fiche_head.php"; ?>

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
include "fiche1.php";
$numpage = "1";
include "fiche2.php";
$numpage = "1";
include "fiche3.php";
$numpage = "1";
include "fiche4.php";
$numpage = "1";
include "fiche5.php";
$numpage = "1";
include "fiche6.php";
$numpage = "1";
include "fiche7.php";
$numpage = "1";
include "fiche8.php";

$nofoot = "yes";
$nobutton = "yes";
$numpage = "total";

include "fiche_button.php";
?>

</form>