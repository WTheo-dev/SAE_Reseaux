<?php

include_once "../../APIFinale/fonctions.php";

function matchFontSize()
{
    if (!isset($_COOKIE["configTaille"])) {return "1em";}
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

function afficherSelect($id, $name, $cookieValue)
{
    echo '<select id="' . $id . '" name="' . $name . '">';
    if (isset($cookieValue)) {
        echo "<option>" . $cookieValue . "</option>";
    } else {
        echo '<option>-- Choisir un matériau --</option>';
    }
    echo '</select>';
}

define('COLLE_ACRYLIQUE_FIXATION', 'Colle acrylique de fixation pour plinthe');
define('CROISILLONS_2_MM', 'Croisillons épaisseur 2 mm');
define('ENDUIT_A_JOINT', 'Enduit à joint');
define('ENDUIT_DE_REBOUCHAGE', 'Enduit de rebouchage');
define('ETAGERE_BOIS', 'Etagère bois 20 x 60');
define('FAIENCE_MUR', 'Faïence mur 20 x 20');
define('JOINT_POUDRE_CARRELAGE', 'Joint poudre carrelage');
define('COLORANTS_UNIVERSELS', 'Lot de colorants universels de peintre');
define('MORTIER_COLLE_POUDRE', 'Mortier colle poudre');
define('PANNEAU_BOIS', 'Panneau bois (OSB ou aggloméré)');
define('PAPIER_VERRE_120', 'Papier de verre grain 120');
define('PAPIER_VERRE_80', 'Papier de verre grain 80');
define('PEINTURE_SATINEE', 'Peinture acrylique satinée');
define('PEINTURE_BRILLANTE', 'Peinture boiseries acrylique brillant');
define('PEINTURE_IMPRESSION', 'Peinture impression');
define('PLAN_COFFRAGE', 'Planche de coffrage');
define('PLAQUE_PLATRE_BA13', 'Plaque de Plâtre BA13');
define('PLINTHE_MDF_BOIS', 'Plinthe MDF ou bois brut');
define('POINTES_TETE_HOMME', 'Pointes tête homme');
define('PORTEMANTEAU_MURAL', 'Portemanteau mural bois 2 têtes');
define('RAIL_R48', 'Rail R48');
define('REVETEMENT_TOILE_VERRE', 'Revêtement à peindre - toile de verre (largeur 1 m)');
define('SERRURE_STANDARD_EN_L', 'Serrure standard en L encastrable');
define('TABLETTE_BOIS', 'Tablette bois');
define('TASSEAU_RABOTE', 'Tasseau raboté');
define('VERROU_BOUTON_CYLINDRE_40MM', 'Verrou à bouton - cylindre 40 mm');
define('VIS_BOIS_30MM', 'Vis à bois 30 mm');
define('VIS_TRPF', 'Vis TRPF');
define('VIS_TTPC_25', 'Vis TTPC 25');
define('VIS_TTPC_35', 'Vis TTPC 35');
define('CHEVILLES_EXPANSION', 'Chevilles à expansion avec patte à vis');
define('CHEVILLES_FRAPPER', 'Chevilles à frapper');
define('CHEVILLES_AUTOFOREUSES', 'Chevilles autoforeuses - Fixation plaque de plâtre');
define('MONTANT_M48', 'Montant M48');

function getMateriauxForFinition()
{
    return array(
        "Champlat",
        "Chiffons",
        COLLE_ACRYLIQUE_FIXATION,
        "Colle pour toile de verre",
        CROISILLONS_2_MM,
        ENDUIT_A_JOINT,
        ENDUIT_DE_REBOUCHAGE,
        ETAGERE_BOIS,
        FAIENCE_MUR,
        JOINT_POUDRE_CARRELAGE,
        COLORANTS_UNIVERSELS,
        MORTIER_COLLE_POUDRE,
        PANNEAU_BOIS,
        PAPIER_VERRE_120,
        PAPIER_VERRE_80,
        PEINTURE_SATINEE,
        PEINTURE_BRILLANTE,
        PEINTURE_IMPRESSION,
        PLAN_COFFRAGE,
        PLAQUE_PLATRE_BA13,
        PLINTHE_MDF_BOIS,
        POINTES_TETE_HOMME,
        PORTEMANTEAU_MURAL,
        RAIL_R48,
        REVETEMENT_TOILE_VERRE,
        "Serrure satandard encastrable NF Cylindre européen",
        SERRURE_STANDARD_EN_L,
        TABLETTE_BOIS,
        TASSEAU_RABOTE,
        VERROU_BOUTON_CYLINDRE_40MM,
        VIS_BOIS_30MM,
        VIS_TRPF,
        VIS_TTPC_25,
        VIS_TTPC_35,
        // Add other materials for Finition
    );
}

function getMateriauxForPlomberie()
{
    return array(
        "Bonde à grille pour lave-mains",
        "Bouchon laiton à visser F 1/2",
        CHEVILLES_EXPANSION,
        CHEVILLES_FRAPPER,
        CHEVILLES_AUTOFOREUSES,
        "Chiffons",
        COLLE_ACRYLIQUE_FIXATION,
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
        FAIENCE_MUR,
        MORTIER_COLLE_POUDRE,
        JOINT_POUDRE_CARRELAGE,
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
        PANNEAU_BOIS,
        PAPIER_VERRE_120,
        PAPIER_VERRE_80,
        "Pates à vis",
        "Pipe coudée WC 90° 110 mm",
        "Pipe droite WC 110 mm",
        PLAN_COFFRAGE,
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
        VERROU_BOUTON_CYLINDRE_40MM,
        VIS_BOIS_30MM,
        VIS_TRPF,
        VIS_TTPC_25,
        VIS_TTPC_35,
    );
}

function getMateriauxForAmenagementInterieur()
{
    return array(
        "Bande à joint",
        "Bande armée à joint",
        "Champlat",
        CHEVILLES_EXPANSION,
        CHEVILLES_FRAPPER,
        CHEVILLES_AUTOFOREUSES,
        "Chiffons",
        COLLE_ACRYLIQUE_FIXATION,
        "Colle pour toile de verre",
        CROISILLONS_2_MM,
        "Cylindre double entrée profil européen",
        ENDUIT_A_JOINT,
        ENDUIT_DE_REBOUCHAGE,
        "Ensemble de porte - Clé I",
        "Ensemble de porte - Clé L",
        "Ensemble intérupteur SA/VV - encastrable",
        "Ensemble Prise 2P+T - encastrable",
        ETAGERE_BOIS,
        FAIENCE_MUR,
        JOINT_POUDRE_CARRELAGE,
        COLORANTS_UNIVERSELS,
        MONTANT_M48,
        MORTIER_COLLE_POUDRE,
        PANNEAU_BOIS,
        PAPIER_VERRE_120,
        PAPIER_VERRE_80,
        PEINTURE_SATINEE,
        PEINTURE_BRILLANTE,
        PEINTURE_IMPRESSION,
        PLAN_COFFRAGE,
        PLAQUE_PLATRE_BA13,
        PLINTHE_MDF_BOIS,
        POINTES_TETE_HOMME,
        PORTEMANTEAU_MURAL,
        RAIL_R48,
        REVETEMENT_TOILE_VERRE,
        "Serrure satandard encastrable NF Cylindre européen",
        SERRURE_STANDARD_EN_L,
        TABLETTE_BOIS,
        TASSEAU_RABOTE,
        VERROU_BOUTON_CYLINDRE_40MM,
        VIS_BOIS_30MM,
        VIS_TRPF,
        VIS_TTPC_25,
        VIS_TTPC_35,
        // Add other materials for Aménagement d'intérieur
    );
}

function getMateriauxForSerrurerie()
{
    return array(
        "Bande à joint",
        "Bande armée à joint",
        "Champlat",
        CHEVILLES_EXPANSION,
        CHEVILLES_FRAPPER,
        CHEVILLES_AUTOFOREUSES,
        "Chiffons",
        COLLE_ACRYLIQUE_FIXATION,
        CROISILLONS_2_MM,
        "Cylindre double entrée profil européen",
        ENDUIT_A_JOINT,
        ENDUIT_DE_REBOUCHAGE,
        "Ensemble de porte - Clé I",
        "Ensemble de porte - Clé L",
        ETAGERE_BOIS,
        FAIENCE_MUR,
        JOINT_POUDRE_CARRELAGE,
        COLORANTS_UNIVERSELS,
        MONTANT_M48,
        MORTIER_COLLE_POUDRE,
        PANNEAU_BOIS,
        PAPIER_VERRE_120,
        PAPIER_VERRE_80,
        PEINTURE_SATINEE,
         PEINTURE_BRILLANTE,
        PEINTURE_IMPRESSION,
        PLAN_COFFRAGE,
        PLAQUE_PLATRE_BA13,
        PLINTHE_MDF_BOIS,
        POINTES_TETE_HOMME,
        PORTEMANTEAU_MURAL,
        RAIL_R48,
        REVETEMENT_TOILE_VERRE,
        "Serrure standard encastrable NF Cylindre européen",
        SERRURE_STANDARD_EN_L,
        TABLETTE_BOIS,
        TASSEAU_RABOTE,
        VERROU_BOUTON_CYLINDRE_40MM,
        VIS_BOIS_30MM,
        VIS_TRPF,
        VIS_TTPC_25,
        VIS_TTPC_35,
        // Add other materials for Serrurerie
    );
}

function getMateriauxForElectricite()
{
    return array(
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
        ENDUIT_DE_REBOUCHAGE,
        "Ensemble intérupteur SA/VV - encastrable",
        "Ensemble Prise 2P+T - encastrable",
        "Fiche DCL et douille électrique E27",
        "Gaine ICTA Ø 20",
        "Intérupteur automatique avec détecteur de mouvement",
        "Plaque de Plâtre BA13",
        MONTANT_M48,
        VIS_TTPC_25,
        // Add other materials for Electricité
    );
}

function afficherMateriaux($descriptionDemande, $i)
{
    $cookieName = 'materiaux' . $i;
    $cookieValue = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;

    echo '<select id="materiaux' . $i . '" name="materiaux' . $i . '">';
    if ($cookieValue !== null) {
        echo "<option>" . $cookieValue . "</option>";
    } else {
        echo '<option>-- Choisir un matériau --</option>';
    }

    $materiaux = array();
    switch ($descriptionDemande) {
        case "Finition":
            $materiaux = getMateriauxForFinition();
            break;
        case "Plomberie":
            $materiaux = getMateriauxForPlomberie();
            break;
        case "Aménagement d'intérieur":
            $materiaux = getMateriauxForAmenagementInterieur();
            break;
        case "Serrurerie":
            $materiaux = getMateriauxForSerrurerie();
            break;
        case "ELECTRICITE":
            $materiaux = getMateriauxForElectricite();
            break;
        default:
            $materiaux = array("-- Choisir une catégorie --");
            break;
    }

    foreach ($materiaux as $materiau) {
        echo "<option>$materiau</option>";
    }
    echo '</select>';
}



