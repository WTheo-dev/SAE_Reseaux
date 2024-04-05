

<?php
  session_start();
  include_once "../../APIFinale/fonctions.php";

  if (!isset($_SESSION['apprenti'])) {
    header('Location: index.php');
    exit();
  }


?>

<?php

define('FICHE_LOCATION', 'location: fiche');

if (isset($_POST['precedent'])) {
    $numpage = $_POST['precedent'];
    $index = $numpage - 1;
    $direction = "precedent";
    header(FICHE_LOCATION . $index.".php");
} elseif (isset($_POST['sauvegarder'])) {
    if ($_POST['sauvegarder'] == "total") {
        header("location: fiche_total.php");
    }else {
        $numpage = $_POST['sauvegarder'];
        $index = $numpage;
        $direction = "sauvegarder";
        header(FICHE_LOCATION . $_POST['sauvegarder'].".php");
    }
} elseif (isset($_POST['quitter'])) {
    if ($_POST['quitter'] == "total") {
        header("location: fiche_total.php");
    }else {
        $numpage = $_POST['quitter'];
        $index = $numpage;
        $direction = "quitter";
        header("location: index.php");
    }
} elseif (isset($_POST['suivant'])) {
    $numpage = $_POST['suivant'];
    $index = $numpage + 1;
    $direction = "suivant";
    header(FICHE_LOCATION . $index.".php");
} elseif (isset($_POST['from-fiche-valeur'])) {
    header("location: fiche_valeur.php");
}

foreach ($_POST as $param => $value) {
    $value = htmlspecialchars($value);
    setcookie($param, $value, time() + (86400 * 60));
    if ((str_starts_with($param, "Texte") || str_starts_with($param, "Icon") || str_starts_with($param, "Audio"))
    && !isset($_POST[$param])) {
        unset($_COOKIE[$param]);
        setcookie($param, '', -1);
    }
}



function uncheckCheckbox($param, $pagenum)
{
    global $numpage;
    if (($numpage == $pagenum || $pagenum == "total") && !isset($_POST[$param])) {
        unset($_COOKIE[$param]);
        setcookie($param, '', -1);
    }
}

uncheckCheckbox("Améliorative", 4);
uncheckCheckbox("Préventive", 4);
uncheckCheckbox("Corrective", 4);
uncheckCheckbox("Aménagement", 5);
uncheckCheckbox("Finitions", 5);
uncheckCheckbox("Installation_sanitaire", 5);
uncheckCheckbox("Nécessite_un_nouvelle_intervention", 7);


