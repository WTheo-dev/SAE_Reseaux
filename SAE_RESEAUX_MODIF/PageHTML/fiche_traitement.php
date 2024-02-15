<?php
if (isset($_POST['precedent'])){
    $numpage = $_POST['precedent'];
    $index = $numpage - 1;
    $direction = "precedent";
    header("location: fiche".$index.".php");
} elseif (isset($_POST['sauvegarder'])) {
    if ($_POST['sauvegarder'] == "total"){
        header("location: fiche_total.php");
    }else{
        $numpage = $_POST['sauvegarder'];
        $index = $numpage;
        $direction = "sauvegarder";
        header("location: fiche".$_POST['sauvegarder'].".php");
    }
} elseif (isset($_POST['quitter'])) {
    if ($_POST['quitter'] == "total"){
        header("location: fiche_total.php");
    }else{
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

foreach ($_POST as $param => $value){
    $value=htmlspecialchars($value);
    setcookie($param, $value, time() + (86400 * 60));
    if (str_starts_with($name, "Texte") || str_starts_with($name, "Icon") ||
     str_starts_with($name, "Audio")) if (!isset($_POST[$name])){
            unset($_COOKIE[$name]);
            setcookie($name, '', -1);
        }
    }

function uncheck_checkbox($name, $pagenum){
    global $numpage;
    if (($numpage == $pagenum || $pagenum == "total") && !isset($_POST[$name])){
        unset($_COOKIE[$name]);
        setcookie($name, '', -1);
    }
}
uncheck_checkbox("Améliorative" , 4);
uncheck_checkbox("Préventive"   , 4);
uncheck_checkbox("Corrective"   , 4);
uncheck_checkbox("Aménagement"  , 5);
uncheck_checkbox("Finitions"    , 5);
uncheck_checkbox("Installation_sanitaire"             , 5);
uncheck_checkbox("Nécessite_un_nouvelle_intervention" , 7);
exit;

