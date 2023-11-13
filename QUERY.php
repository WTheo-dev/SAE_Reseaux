<?php

/*
* --------------------------------------------------------------------------------------------------------------------------------
* ---------------------------------------------- LISTE DES REQUETES --------------------------------------------------------------
* -------------------------------------------------- 'ajouter' -------------------------------------------------------------------
* -------------------------------------------------- 'supprimer' -----------------------------------------------------------------
* -------------------------------------------------- 'modifier' ------------------------------------------------------------------
* -------------------------------------------------- 'vérifier' ------------------------------------------------------------------
* -------------------------------------------------- 'récupérer' -----------------------------------------------------------------
* --------------------------------------------------------------------------------------------------------------------------------
*/

//! --------------------------------------------- APPRENTI ----------------------------------------------------------------------- 

// Requête pour AJOUTER un apprenti à la BD
$qAjouterUnApprenti = 'INSERT INTO apprenti (Nom, Prenom, ID_Connexion, motdepasse VALUES (:nom, :prénom, :login, :mdp, )';

// Requête pour SUPPRIMER un apprenti de la BD selon son ID_Apprenti
$qSupprimerUnApprenti = 'DELETE FROM apprenti where ID_Apprenti = :id_apprenti';

// Requête pour SUPPRIMER la photo d'un enfant par rapport à son ID_Apprenti
$qSupprimerImageSurApprenti = '';

// Requête pour AJOUTER la photo d'un enfant par rapport à son ID_Apprenti
$qAjouterImageSurApprenti = '';

//! ------------------------------------------ FICHE INTERVENTION ----------------------------------------------------------------
$qAjouterFicheIntervention = 'INSERT INTO fiche_intervention (Numéro, Nom_Demandeur, Date_Demande, Date_Intervention, Durée_Intervention, Localisation, Description_Demande, Degré_Urgence, Type_Intervention, Nature_Intervention, Couleur_Intervention, Etat_Fiche, Date_Création VALUES :numéro, :nom_du_demandeur, :date_demande, :date_intervention, :durée_intervention, :localisation, : description_demande, :degré_urgence, :type_intervention, :nature_intervention, :couleur_intervention, :etat_fiche, :date_création';

//! -------------------------------------------- GENERALES -----------------------------------------------------------------------

/**
 * connexionBd
 * est une fonction qui permet de se connecter à la BD
 * @return PDO
 */
function connexionBd(): PDO
{
    // informations de connection
    $SERVER = '127.0.0.1';
    $DB = 'apeaj';
    $LOGIN = 'root';
    $MDP = '';
    // tentative de connexion à la BD
    try {
        // connexion à la BD
        $linkpdo = new PDO("mysql:host=$SERVER;dbname=$DB", $LOGIN, $MDP);
    } catch (Exception $e) {
        die('Erreur ! Problème de connexion à la base de données : ' . $e->getMessage());
    }
    // retourne la connection
    return $linkpdo;
}

/**
 * champRempli
 * est une fonction qui vérifie que les champs dont le nom est donné en paramètre sont bien remplis
 * @param  array $field
 * @return bool
 */
function champRempli(array $field): bool
{
    // parcoure la liste des champs
    foreach ($field as $name) {
        if (empty($_POST[$name])) {
            // au moins un champs vides
            return false;
        }
    }
    // si tout les champs remplis
    return true;
}

/**
 * clean
 * est une fonction qui permet de sécurisé ( en nettoyant ) les données reçus en paramètre
 * @param  mixed $champEntrant
 * @return mixed
 */
    function clean($champEntrant)
    {
        // permet d'enlever les balises html, xml, php
        $champEntrant = strip_tags($champEntrant);
        // permet d'enlève les tags HTML et PHP
        $champEntrant = htmlspecialchars($champEntrant);
        return $champEntrant;
    }

    /**
     * saltHash
     * est une fonction de hashage pour les mdp de la BD
     * @param  string $mdp
     * @return string
     */

    function saltHash(string $mdp): string
    {
        // ajout du sel au mdp
        $code = $mdp ;
        // hashage du mdp 
        return password_hash($code, PASSWORD_DEFAULT);
    }

function ajouterApprenti(string $nom, string $prenom, string $login, string $mdp) : int {
    $linkpdo = connexionBd();
    $req  = $linkpdo->prepare($GLOBALS['qAjouterApprenti']);
    if ($req == false) {
        die('Erreur ! Il y a un problème lors de la préparation de la requête : qAjouterApprenti');
    }
    $req -> execute(array(
        ':nom'=> clean($nom),
        ':prenom'=> clean($prenom),
        ':login'=> clean($login),
        ':mdp' =>clean($mdp)
    ));
    if ($req == false) {
        die('Erreur ! Il y a un problème lors de la préparation de la requête : qAjouterApprenti');
    }
    return $req -> rowCount();
}