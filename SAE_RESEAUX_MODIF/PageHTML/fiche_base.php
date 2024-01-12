<?php
function matchFontSize() {
    if (!isset($_COOKIE["configTaille"])) return "1em";
    switch ($_COOKIE["configTaille"]) {
        case '75%':
            return '1.75em';
            break;
        case '100%':
            return '2em';
            break;
        case '125%':
            return '2.25em';
            break;
        case "150%":
            return "2.5em";
            break;
        case "175%":
            return "2.75em";
            break;
        case '200%':
            return '3em';
            break;
        case '225%':
            return '3.25em';
            break;
        case "250%":
            return "3.5em";
            break;
        case "275%":
            return "3.75em";
            break;
        case "300%":
            return "4em";
            break;
    }
    return "1em";
}
function getFontName(){
if (isset($_COOKIE["configPolice"]))
    return "style='font-family: ".$_COOKIE["configPolice"]."'";
}

function addIcon($cookie, $name){
    if (isset($_COOKIE['icon'.ucfirst($cookie)]) && $_COOKIE['icon'.ucfirst($cookie)] == "on"){
        echo '<span><i class="fa '.$name.' fa-4x" aria-hidden="true"></i></span>';
    }
}
function addTexte($id, $name){
    if (isset($_COOKIE['texte'.ucfirst($id)]) && $_COOKIE['texte'.ucfirst($id)] == "on"){
        echo '<label for="'.$id.'">'.$name.'</label>';
    }
}
function addTexteBox($cookie, $name){
    if (isset($_COOKIE['texte'.ucfirst($cookie)]) && $_COOKIE['texte'.ucfirst($cookie)] == "on"){
        echo $name;
    }
}
function addAudio($cookie, $path){
    if (isset($_COOKIE['audio'.ucfirst($cookie)]) && $_COOKIE['audio'.ucfirst($cookie)] == "on"){
        echo '<button type="button" style class="audiobutton" onclick="toggleAudio(\''.$path.'\')"><i class="fa fa-volume-up" aria-hidden="true"></i></button>';
    }
}

function ifform(){
    global $noform;
    if ($noform != "no"){
        echo '<form action="fiche_traitement.php" method="post">';
    }
}

function ifformfin(){
    global $noform;
    if ($noform != "no"){
        echo '</form>';
    }
}

function echoMateriaux($i){
    echo '<select id="materiaux'.$i.'" name="materiaux'.$i.'">';
    if(isset($_COOKIE['materiaux'.$i])){
        echo "<option>".$_COOKIE['materiaux'.$i]."</option>";
    }else{
        echo '<option>-- Choisir un matériau --</option>';
    }
    echo '<option>Bonde à grille pour lave-mains</option>';
    echo '<option>Bouchon laiton à visser F 1/2</option>';
    echo '<option>Chevilles à expansion avec patte à vis</option>';
    echo '<option>Chevilles à frapper</option>';
    echo '<option>Chevilles autoforeuses - Fixation plaque de plâtre</option>';
    echo '<option>Chiffons</option>';
    echo '<option>Colle acrylique de fixation pour plinthe</option>';
    echo '<option>Colle PVC</option>';
    echo '<option>Collier PVC Ø 40</option>';
    echo '<option>Colliers PVC Ø 32</option>';
    echo '<option>Colliers PVC&nbsp; Ø 100</option>';
    echo '<option>Colliers type Atlas double Ø12</option>';
    echo '<option>Colliers type Atlas Simple&nbsp;Ø12</option>';
    echo '<option>Coude cuivre 90° à souder FF Ø 12</option>';
    echo '<option>Coude PVC 87°30° FF Ø 100</option>';
    echo '<option>Coude PVC 87°30° FF Ø 32</option>';
    echo '<option>Coude PVC 87°30° FF Ø 40</option>';
    echo '<option>Faïence mur 20 x 20</option>';
    echo '<option>Mortier colle poudre</option>';
    echo '<option>Joint poudre carrelage</option>';
    echo '<option>Ecrou laiton à collet battu 12x17 Ø 12</option>';
    echo '<option>Joints d\'étanchéité suivant montages</option>';
    echo '<option>Kit robinet d\'arrêt WC équerre + flexible + joint</option>';
    echo '<option>Lave-mains</option>';
    echo '<option>Lot de 2 chevilles clips pour fixation WC 6x70</option>';
    echo '<option>Lot de 2 fixations pour lave-mains parois creuse + cheville</option>';
    echo '<option>Lot de 2 fixations pour lave-mains parois pleine + cheville</option>';
    echo '<option>Manchon cuivre à souder FF Ø 12</option>';
    echo '<option>Manchon de dilatation PVC H Ø 100</option>';
    echo '<option>Manchon mâle 243 CGU Ø 12 - M 12x17</option>';
    echo '<option>Manchon mâle 243 CGU Ø 12 - M 15x21</option>';
    echo '<option>Manchon PVC Ø 100</option>';
    echo '<option>Manchon PVC Ø 32</option>';
    echo '<option>Manchon PVC Ø 40</option>';
    echo '<option>Mélangeur pour lave-mains + Fléxibles de raccordement</option>';
    echo '<option>Pack WC à poser sortie horizontale</option>';
    echo '<option>Panneau bois (OSB ou aggloméré)</option>';
    echo '<option>Papier de verre grain 120</option>';
    echo '<option>Papier de verre grain 80</option>';
    echo '<option>Pates à vis</option>';
    echo '<option>Pipe coudée WC 90° 110 mm</option>';
    echo '<option>Pipe droite WC 110 mm</option>';
    echo '<option>Planche de coffrage</option>';
    echo '<option>Réduction PVC Ø 40/32</option>';
    echo '<option>Robinet de puisage de lave-linge + platine de fixation</option>';
    echo '<option>Robinet simple pour lave-mains + fléxible de raccordement</option>';
    echo '<option>Rosaces coniques H19</option>';
    echo '<option>Siphon lavabo/lave-mains à visser sortie Ø 32</option>';
    echo '<option>Système de vidage PVC pour machine à laver</option>';
    echo '<option>Tampon de réduction simple PVC Ø 100/40</option>';
    echo '<option>Tampon de visite PVC avec bouchon M/F Ø 100</option>';
    echo '<option>Tampon de visite PVC avec bouchon M/F Ø 32</option>';
    echo '<option>Té égal cuivre à souder FFF Ø 12</option>';
    echo '<option>Té pied de biche 87°30 FF PVC Ø 100</option>';
    echo '<option>Té pied de biche 87°30 FF PVC Ø 32</option>';
    echo '<option>Té pied de biche 87°30 FF PVC Ø 40</option>';
    echo '<option>Tube cuivre Ø 12</option>';
    echo '<option>Tube PVC Ø 100</option>';
    echo '<option>Tube PVC Ø 32</option>';
    echo '<option>Tube PVC Ø 40</option>';
    echo '<option>Vanne d\'arrêt MF 1/4 de tour - 12x17</option>';
    echo '<option>Verrou à bouton - cylindre 40 mm</option>';
    echo '<option>Vis à bois 30 mm</option>';
    echo '<option>Vis TRPF</option>';
    echo '<option>Vis TTPC 25</option>';
    echo '<option>Vis TTPC 35</option>';
    echo '</select>';
}
?>