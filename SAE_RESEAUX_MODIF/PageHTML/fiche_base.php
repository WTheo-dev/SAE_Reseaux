<?php

include_once "../../APIFinale/fonctions.php";

function matchFontSize() {
    if (!isset($_COOKIE["configTaille"])){return "1em";}
    switch ($_COOKIE["configTaille"]) {
        default:
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
if (isset($_COOKIE["configPolice"])){return $_COOKIE["configPolice"];}
    
}

function addIcon($cookie, $name, $id = "noid"){
    if (isset($_COOKIE['icon'.ucfirst($cookie)]) && $_COOKIE['icon'.ucfirst($cookie)] == "on"){
        echo '<span><i class="icon fa '.$name.'" id="'.$id.'" aria-hidden="true"></i></span>';
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
        echo '<button type="button" style class="audiobutton" onclick="toggleAudio(\''
        .$path.'\')"><i class="fa fa-volume-up" aria-hidden="true"></i></button>';
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

function afficherMateriaux($descriptionDemande, $i) {
    echo '<select id="materiaux'.$i.'" name="materiaux'.$i.'">';
    if(isset($_COOKIE['materiaux'.$i])){
        echo "<option>".$_COOKIE['materiaux'.$i]."</option>";
    }else{
        echo '<option>-- Choisir un matériau --</option>';
    }
    $materiaux = array();

    switch ($descriptionDemande) {
        case "Finition":
            $materiaux = array(
                "Champlat",
                "Chiffons",
                "Colle acrylique de fixation pour plinthe",
                "Colle pour toile de verre",
                "Croisillons épaisseur 2 mm",
                "Enduit à joint",
                "Enduit de rebouchage",
                "Etagère bois 20 x 60",
                "Faïence mur 20 x 20",
                "Joint poudre carrelage",
                "Lot de colorants universels de peintre",
                "Mortier colle poudre",
                "Panneau bois (OSB ou aggloméré)",
                "Papier de verre grain 120",
                "Papier de verre grain 80",
                "Peinture acrylique satinée",
                "Peinture boiseries acrylique brillant",
                "Peinture impression",
                "Planche de coffrage",
                "Plaque de Plâtre BA13",
                "Plinthe MDF ou bois brut",
                "Pointes tête homme",
                "Portemanteau mural bois 2 têtes",
                "Rail R48",
                "Revêtement à peindre - toile de verre (largeur 1 m)",
                "Serrure satandard encastrable NF Cylindre européen",
                "Serrure standard en L encastrable",
                "Tablette bois",
                "Tasseau raboté",
                "Verrou à bouton - cylindre 40 mm",
                "Vis à bois 30 mm",
                "Vis TRPF",
                "Vis TTPC 25",
                "Vis TTPC 35",
            );
            break;
        case "Plomberie":
            $materiaux = array(
                "Bonde à grille pour lave-mains",
                "Bouchon laiton à visser F 1/2",
                "Chevilles à expansion avec patte à vis",
                "Chevilles à frapper",
                "Chevilles autoforeuses - Fixation plaque de plâtre",
                "Chiffons",
                "Colle acrylique de fixation pour plinthe",
                "Colle PVC",
                "Collier PVC Ø 40",
                "Colliers PVC Ø 32",
                "Colliers PVC&nbsp; Ø 100",
                "Colliers type Atlas double Ø12",
                "Colliers type Atlas Simple&nbsp;Ø12",
                "Coude cuivre 90° à souder FF Ø 12",
                "Coude PVC 87°30° FF Ø 100",
                "Coude PVC 87°30° FF Ø 32",
                "Coude PVC 87°30° FF Ø 40",               
                "Faïence mur 20 x 20",
                "Mortier colle poudre",
                "Joint poudre carrelage",
                "Ecrou laiton à collet battu 12x17 Ø 12",
                "Joints d'étanchéité suivant montages",
                "Kit robinet d'arrêt WC équerre + flexible + joint",
                "Lave-mains",
                "Lot de 2 chevilles clips pour fixation WC 6x70",
                "Lot de 2 fixations pour lave-mains parois creuse + cheville",
                "Lot de 2 fixations pour lave-mains parois pleine + cheville",
                "Manchon cuivre à souder FF Ø 12",
                "Manchon de dilatation PVC H Ø 100",
                "Manchon mâle 243 CGU Ø 12 - M 12x17",
                "Manchon mâle 243 CGU Ø 12 - M 15x21",
                "Manchon PVC Ø 100",
                "Manchon PVC Ø 32",
                "Manchon PVC Ø 40",
                "Mélangeur pour lave-mains + Fléxibles de raccordement",
                "Pack WC à poser sortie horizontale",
                "Panneau bois (OSB ou aggloméré)",
                "Papier de verre grain 120",
                "Papier de verre grain 80",
                "Pates à vis",
                "Pipe coudée WC 90° 110 mm",
                "Pipe droite WC 110 mm",
                "Planche de coffrage",
                "Réduction PVC Ø 40/32",
                "Robinet de puisage de lave-linge + platine de fixation",
                "Robinet simple pour lave-mains + fléxible de raccordement",
                "Rosaces coniques H19",
                "Siphon lavabo/lave-mains à visser sortie Ø 32",
                "Système de vidage PVC pour machine à laver",
                "Tampon de réduction simple PVC Ø 100/40",
                "Tampon de visite PVC avec bouchon M/F Ø 100",
                "Tampon de visite PVC avec bouchon M/F Ø 32",
                "Té égal cuivre à souder FFF Ø 12",
                "Té pied de biche 87°30 FF PVC Ø 100",
                "Té pied de biche 87°30 FF PVC Ø 32",
                "Té pied de biche 87°30 FF PVC Ø 40",
                "Tube cuivre Ø 12",
                "Tube PVC Ø 100",
                "Tube PVC Ø 32",
                "Tube PVC Ø 40",
                "Vanne d'arrêt MF 1/4 de tour - 12x17",
                "Verrou à bouton - cylindre 40 mm",
                "Vis à bois 30 mm",
                "Vis TRPF",
                "Vis TTPC 25",
                "Vis TTPC 35",
            );
            break;
        case "Aménagement d'intérieur":
            $materiaux = array(
                "Bande à joint",
                "Bande armée à joint",
                "Champlat",
                "Chevilles à expansion avec patte à vis",
                "Chevilles à frapper",
                "Chevilles autoforeuses - Fixation plaque de plâtre",
                "Chiffons",
                "Colle acrylique de fixation pour plinthe",
                "Colle pour toile de verre",
                "Croisillons épaisseur 2 mm",
                "Cylindre double entrée profil européen",
                "Enduit à joint",
                "Enduit de rebouchage",
                "Ensemble de porte - Clé I",
                "Ensemble de porte - Clé L",
                "Ensemble intérupteur SA/VV - encastrable",
                "Ensemble Prise 2P+T - encastrable",
                "Etagère bois 20 x 60",
                "Faïence mur 20 x 20",
                "Joint poudre carrelage",
                "Lot de colorants universels de peintre",
                "Montant M48",
                "Mortier colle poudre",
                "Panneau bois (OSB ou aggloméré)",
                "Papier de verre grain 120",
                "Papier de verre grain 80",
                "Peinture acrylique satinée",
                "Peinture boiseries acrylique brillant",
                "Peinture impression",
                "Planche de coffrage",
                "Plaque de Plâtre BA13",
                "Plinthe MDF ou bois brut",
                "Pointes tête homme",
                "Portemanteau mural bois 2 têtes",
                "Rail R48",
                "Revêtement à peindre - toile de verre (largeur 1 m)",
                "Serrure satandard encastrable NF Cylindre européen",
                "Serrure standard en L encastrable",
                "Tablette bois",
                "Tasseau raboté",
                "Verrou à bouton - cylindre 40 mm",
                "Vis à bois 30 mm",
                "Vis TRPF",
                "Vis TTPC 25",
                "Vis TTPC 35",   
            );
            break;
        case "Serrurerie":
            $materiaux = array(
                "Bande à joint",
                "Bande armée à joint",
                "Champlat",
                "Chevilles à expansion avec patte à vis",
                "Chevilles à frapper",
                "Chevilles autoforeuses - Fixation plaque de plâtre",
                "Chiffons",
                "Colle acrylique de fixation pour plinthe",
                "Croisillons épaisseur 2 mm",
                "Cylindre double entrée profil européen",
                "Enduit à joint",
                "Enduit de rebouchage",
                "Ensemble de porte - Clé I",
                "Ensemble de porte - Clé L",
                "Etagère bois 20 x 60",
                "Faïence mur 20 x 20",
                "Joint poudre carrelage",
                "Lot de colorants universels de peintre",
                "Montant M48",
                "Mortier colle poudre",
                "Panneau bois (OSB ou aggloméré)",
                "Papier de verre grain 120",
                "Papier de verre grain 80",
                "Peinture acrylique satinée",
                "Peinture boiseries acrylique brillant",
                "Peinture impression",
                "Planche de coffrage",
                "Plaque de Plâtre BA13",
                "Plinthe MDF ou bois brut",
                "Pointes tête homme",
                "Portemanteau mural bois 2 têtes",
                "Rail R48",
                "Revêtement à peindre - toile de verre (largeur 1 m)",
                "Serrure standard encastrable NF Cylindre européen",
                "Serrure standard en L encastrable",
                "Tablette bois",
                "Tasseau raboté",
                "Verrou à bouton - cylindre 40 mm",
                "Vis à bois 30 mm",
                "Vis TRPF",
                "Vis TTPC 25",
                "Vis TTPC 35",
            );
            break;
        case "ELECTRICITE":
            $materiaux = array(
                "Ampoule E 27",
                "Bornes connection rapide - 3 entrées",
                "Bornes connection rapide - 2 entrées",
                "Colliers type Atlas double Ø12",
                "Colliers type Atlas Simple Ø12",
                "Conducteur HO7VU 1,5² Bleu",
                "Conducteur HO7VU 1,5² Noir",
                "Conducteur HO7VU 1,5² Orange",
                "Conducteur HO7VU 1,5² Rouge",
                "Conducteur HO7VU 1,5² Vert/Jaune",
                "Conducteur HO7VU 2,5² Bleu",
                "Conducteur HO7VU 2,5² Rouge",
                "Conducteur HO7VU 2,5² Vert/Jaune",
                "Convecteur électrique",
                "Enduit de rebouchage",
                "Ensemble intérupteur SA/VV - encastrable",
                "Ensemble Prise 2P+T - encastrable",
                "Fiche DCL et douille électrique E27",
                "Gaine ICTA Ø 20",
                "Intérupteur automatique avec détecteur de mouvement",
                "Plaque de Plâtre BA13",
                "Montant M48",
                "Vis TTPC 25",
            );
            break;
        default:
            $materiaux = array("-- Choisir une catégorie --");
            break;
    }

    return $materiaux;
}




?>