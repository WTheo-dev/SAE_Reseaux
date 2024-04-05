<?php
session_start();
include_once "../../APIFinale/fonctions.php";

if (!isset($_SESSION['personnel']) && !isset($_SESSION['superadmin'])) {
    header('Location: index.php');
    exit();
}


function matchFontSize()
{
    $fontSizes = [
        '75%' => '1.75em',
        '100%' => '2em',
        '125%' => '2.25em',
        '150%' => '2.5em',
        '175%' => '2.75em',
        '200%' => '3em',
        '225%' => '3.25em',
        '250%' => '3.5em',
        '275%' => '3.75em',
        '300%' => '4em'
    ];

    $cookieValue = isset($_COOKIE["configTaille"]) ? $_COOKIE["configTaille"] : null;

    return isset($fontSizes[$cookieValue]) ? $fontSizes[$cookieValue] : '1em';
}


function getFontName()
{
if (isset($_COOKIE["configPolice"])) {return $_COOKIE["configPolice"];}
    
}

function addIcon($cookie, $name, $id = "noid")
{
    if (isset($_COOKIE['icon'.ucfirst($cookie)]) && $_COOKIE['icon'.ucfirst($cookie)] == "on") {
        echo '<span><i class="icon fa '.$name.'" id="'.$id.'" aria-hidden="true"></i></span>';
    }
}
function addTexte($id, $name)
{
    if (isset($_COOKIE['texte'.ucfirst($id)]) && $_COOKIE['texte'.ucfirst($id)] == "on") {
        echo '<label for="'.$id.'">'.$name.'</label>';
    }
}
function addTexteBox($cookie, $name)
{
    if (isset($_COOKIE['texte'.ucfirst($cookie)]) && $_COOKIE['texte'.ucfirst($cookie)] == "on") {
        echo $name;
    }
}
function addAudio($cookie, $path)
{
    if (isset($_COOKIE['audio'.ucfirst($cookie)]) && $_COOKIE['audio'.ucfirst($cookie)] == "on") {
        echo '<button type="button" style class="audiobutton" onclick="toggleAudio(\''
        .$path.'\')"><i class="fa fa-volume-up" aria-hidden="true"></i></button>';
    }
}

function ifform()
{
    global $noform;
    if ($noform != "no") {
        echo '<form action="fiche_traitement.php" method="post">';
    }
}

function ifformfin()
{
    global $noform;
    if ($noform != "no") {
        echo '</form>';
    }
}

function echoMateriaux($i, $description_demande)
{
    echo '<select id="materiaux' . $i . '" name="materiaux' . $i . '">';
    if (isset($_COOKIE['materiaux' . $i])) {
        echo "<option>" . $_COOKIE['materiaux' . $i] . "</option>";
    } else {
        echo '<option>-- Choisir un matériaux --</option>';
    }

    // Vérifier si une description_demande est spécifiée
    if ($description_demande) {
        $conn = connexionBD();
        $sql = "SELECT nom_materiaux FROM materiaux WHERE description_demande = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$description_demande]);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option>' . $row["nom_materiaux"] . '</option>';
        }

        $conn = null;
    } else {
        echo "<option disabled>Veuillez sélectionner une catégorie.</option>";
    }
    echo '</select>';
}




?>

