<?php

include_once '../../APIFinale/fonctions.php';
define('FICHE_LOCATION', 'location: fiche');

// Vérification et définition des valeurs des clés du tableau $_REQUEST
$nomDemandeur = isset($_REQUEST['nomDemandeur']) ? $_REQUEST['nomDemandeur'] : '';
$dateDemande = isset($_REQUEST['dateDemande']) ? $_REQUEST['dateDemande'] : '';
$localisation = isset($_REQUEST['localisation']) ? $_REQUEST['localisation'] : '';
$descDemande = isset($_REQUEST['descDemande']) ? $_REQUEST['descDemande'] : '';
$degreeUrgence = isset($_REQUEST['degreeUrgence']) ? $_REQUEST['degreeUrgence'] : '';

// Création de la fiche
$id_fiche = creationFiche(
    69,
    $nomDemandeur,
    $dateDemande,
    date("Y-m-d"),
    "",
    $localisation,
    $descDemande,
    $degreeUrgence,
    "", "", "", "", "", "",
    date("Y-m-d"),
    isset($_POST['id_app']) ? intval($_POST['id_app']) : 0,
    69
);

// Définition du cookie 'id_fiche'
setcookie("id_fiche", $id_fiche, -1);

// Gestion des redirections en fonction des actions
if (isset($_POST['precedent'])) {
    $numpage = $_POST['precedent'];
    $index = $numpage - 1;
    $direction = "precedent";
    header(FICHE_LOCATION . $index . ".php");
} elseif (isset($_POST['sauvegarder'])) {
    if ($_POST['sauvegarder'] == "total") {
        header("location: fiche_total.php");
    } else {
        $numpage = $_POST['sauvegarder'];
        $index = $numpage;
        $direction = "sauvegarder";
        header(FICHE_LOCATION . $_POST['sauvegarder'] . ".php");
    }
} elseif (isset($_POST['quitter'])) {
    if ($_POST['quitter'] == "total") {
        header("location: fiche_total.php");
    } else {
        $numpage = $_POST['quitter'];
        $index = $numpage;
        $direction = "quitter";
        header("location: index.php");
    }
} elseif (isset($_POST['suivant'])) {
    $numpage = $_POST['suivant'];
    $index = $numpage + 1;
    $direction = "suivant";
    header(FICHE_LOCATION . $index . ".php");
} elseif (isset($_POST['from-fiche-valeur'])) {
    header("location: fiche_valeur.php");
}

// Boucle pour traiter les données POST et définir les cookies correspondants
foreach ($_POST as $param => $value) {
    $value = htmlspecialchars($value);
    setcookie($param, $value, time() + (86400 * 60));
    if ((str_starts_with($param, "Texte") || str_starts_with($param, "Icon") || str_starts_with($param, "Audio")) && !isset($_POST[$param])) {
        unset($_COOKIE[$param]);
        setcookie($param, '', -1);
    }
}

// Fonction pour désélectionner certaines cases à cocher en fonction de la page actuelle
function uncheckCheckbox($param, $pagenum)
{
    global $numpage;
    if (($numpage == $pagenum || $pagenum == "total") && !isset($_POST[$param])) {
        unset($_COOKIE[$param]);
        setcookie($param, '', -1);
    }
}

// Appel de la fonction uncheckCheckbox pour désélectionner certaines cases à cocher
uncheckCheckbox("Améliorative", 4);
uncheckCheckbox("Préventive", 4);
uncheckCheckbox("Corrective", 4);
uncheckCheckbox("Aménagement", 5);
uncheckCheckbox("Finitions", 5);
uncheckCheckbox("Installation_sanitaire", 5);
uncheckCheckbox("Nécessite_un_nouvelle_intervention", 7);

?>
