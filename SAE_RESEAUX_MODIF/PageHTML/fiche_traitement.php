<?php

if (isset($_POST['precedent'])) {
    $numpage = $_POST['precedent'];
    $index = $numpage - 1;
    $direction = "precedent";
    header("location: fiche".$index.".php");
} elseif (isset($_POST['sauvegarder'])) {
    if ($_POST['sauvegarder'] == "total") {
        header("location: fiche_total.php");
    }else {
        $numpage = $_POST['sauvegarder'];
        $index = $numpage;
        $direction = "sauvegarder";
        header("location: fiche".$_POST['sauvegarder'].".php");
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
    header("location: fiche".$index.".php");
} elseif (isset($_POST['from-fiche-valeur'])) {
    header("location: fiche_valeur.php");
}

foreach ($_POST as $param => $value) {
    $value = htmlspecialchars($value);
    setcookie($param, $value, time() + (86400 * 60));
    if ((str_starts_with($name, "Texte") || str_starts_with($name, "Icon") || str_starts_with($name, "Audio"))
    && !isset($_POST[$name])) {
        unset($_COOKIE[$name]);
        setcookie($name, '', -1);
    }
}

function uncheckCheckbox($name, $pagenum)
{
    global $numpage;
    if (($numpage == $pagenum || $pagenum == "total") && !isset($_POST[$name])) {
        unset($_COOKIE[$name]);
        setcookie($name, '', -1);
    }
}
uncheckCheckbox("Améliorative", 4);
uncheckCheckbox("Préventive", 4);
uncheckCheckbox("Corrective", 4);
uncheckCheckbox("Aménagement", 5);
uncheckCheckbox("Finitions", 5);
uncheckCheckbox("Installation_sanitaire", 5);
uncheckCheckbox("Nécessite_un_nouvelle_intervention", 7);
exit;

