<?php

/////////////////////////////////////////////////////////////////////////////
////////////////////   CONNEXION A LA BASE DE DONNEES    ////////////////////
/////////////////////////////////////////////////////////////////////////////

function connexionBD()
{
  $server = '127.0.0.1';
  $bd = 'apeaj';
  $login = 'maxlamenace';
  $mdp = 'hamza';

  try {
    $bd = new PDO("mysql:host=$server;dbname=$bd", $login, $mdp);
  } catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage());
  }
  return $bd;
}

function identification($login, $mdp)
{
  $login = htmlspecialchars($login);
  $mdp = htmlspecialchars($mdp);
  $bd = connexionBD();
  $verificationMembre = $bd->prepare('SELECT * FROM utilisateur WHERE login = ? AND mdp = ?');
  $verificationMembre->execute(array($login, $mdp));
  $bd = null;
  return $verificationMembre->rowCount() > 0;
}

function recuperationRole($login)
{
  $bd = connexionBD();
  $recuperationRoleUtilisateur = $bd->prepare('SELECT id_role FROM utilisateur WHERE login = ?');
  $recuperationRoleUtilisateur->execute(array($login));
  $bd = null;
  if ($recuperationRoleUtilisateur->rowCount() > 0) {
    foreach ($recuperationRoleUtilisateur as $row) {
      return $row['id_role'];
    }
  } else {
    return false;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////       GESTION DES UTILISATEURS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

define('SQL_QUERY', 'SELECT * FROM utilisateur WHERE id_utilisateur = ?');

function loginId($idUtilisateur)
{

  $bd = connexionBD();
  $rechercheUtilisateur = $bd->prepare(SQL_QUERY);
  $rechercheUtilisateur -> execute(array($idUtilisateur));
  $bd = null;
  if ($rechercheUtilisateur -> rowCount() > 0) {
    foreach ($rechercheUtilisateur as $row) {
      return $row['login'];
    }
  } else {
    return false;
  }
}

function idLogin($login)
{
  $bd = connexionBD();
  $rechercheUtilisateur = $bd->prepare(SQL_QUERY);
  $rechercheUtilisateur -> execute(array($login));
  $bd = null;
  if ($rechercheUtilisateur -> rowCount() > 0) {
    foreach ($rechercheUtilisateur as $row) {
      return $row['id_utilisateur'];
    }
  } else {
    return false;
  }
}

function getUtilisateur($id)
{
  $bd = connexionBD();
  $utilisateur = $bd->prepare(SQL_QUERY);
  $utilisateur->execute(array($id));
  if ($utilisateur->rowCount() > 0) {
    foreach ($utilisateur as $row) {
      return $row;
    }
  } else {
    return false;
  }
}



/////////////////////////////////////////////////////////////////////////////
////////////////////         GESTION DES COMPTES         ////////////////////
/////////////////////////////////////////////////////////////////////////////

function conversionHTML($tableauAConvertir)
{
  $tableauConverti = [];
  for ($i = 0; $i < count($tableauAConvertir); ++$i) {
    $tableauConverti[$i] = htmlspecialchars($tableauAConvertir[$i]);
  }
  return $tableauConverti;
}

function connexionApprenti($idApprenti)
{
  $bd = connexionBD();

    if (!empty($idApprenti)) {
      $verificationApprenti = $bd->prepare('SELECT * from apprenti WHERE schema = ?');
      $verificationApprenti->execute(array($idApprenti[0]));
      $bd = null;
      
      if ($verificationApprenti->rowCount() > 0) {
        foreach ($verificationApprenti as $row) {
          if (password_verify($idApprenti[1], $row['mdp'])) {
            $_SESSION['id'] = $row['id_apprenti'];
            $_SESSION['compteValide'] = $row['compteValide'];
            $_SESSION['coordinateur'] = $row['coordinateur'];
            return true;
          }
        }
      }
    }
  
  return false;
}

function connexionPersonnel($idPersonnel)
{
    $bd = connexionBD();

    if (count($idPersonnel) == 2) {
        $identitePersonnelHTML = array_map('conversionHTML', $idPersonnel);

        $verificationPersonnel = $bd->prepare('SELECT * FROM personnel WHERE schema = ?');
        $verificationPersonnel->execute(array($identitePersonnelHTML[0]));
        $bd = null;

        if ($verificationPersonnel->rowCount() > 0) {
            foreach ($verificationPersonnel as $row) {
                if (password_verify($identitePersonnelHTML[1], $row['mdp'])) {
                    // Assuming 'id_apprenti' is the correct column name, update it if needed
                    $_SESSION['id'] = $row['id_apprenti'];
                    $_SESSION['compteValide'] = $row['compteValide'];
                    return true;
                }
            }
        }

        // If the loop doesn't return true, it means the password verification failed
        return false;
    }

    // Invalid input format
    return false;
}

function saltHash(string $mdp): string
{
    // ajout du sel au mdp
    $code = $mdp . 'BrIc3 4rNaUlT 3sT &$ Le MeIlLeUr d3s / pRoFesSeUrs DU.Mond3 !';
    // hashage du mdp
    return password_hash($code, PASSWORD_DEFAULT);
}

function modifierMdp(string $mdp, int $idMembre): void
{
    // connexion a la base de donnees
    $linkpdo = connexionBd();
    //on supprime le membre
    $req = $linkpdo->prepare($GLOBALS['qModifierMotDePasseUnMembre']);
    if (!$req) {
        die('Erreur ! Il y a un problème lors de la préparation de la requête : qModifierMotDePasseUnMembre');
    }
    // execution de la Requête sql
    $req->execute(array(
        ':mdp' => saltHash($mdp),
        ':idMembre' => $idMembre
    ));
    if (!$req) {
        die('Erreur ! Il y a un problème lors l\'exécution de la requête : qModifierMotDePasseUnMembre');
    }
}
function resetPassword($id)
{
    $linkpdo = connexionBd();
    $req = $linkpdo->prepare($GLOBALS['qResetPassword']);
    if (!$req) {
        die('Erreur ! Il y a un problème lors de la préparation de la requête : qResetPassword');
    }
    // execution de la Requête sql
    $req->execute(array(
        ':password' => saltHash('password'),
        ':id' => $id
    ));
}



function validationMdp($mdp, $mdpConfirmation)
{
  if ($mdp == $mdpConfirmation && strlen($mdp) >= 5) {
    return password_hash($mdp, PASSWORD_DEFAULT);
  } else {
    return false;
  }
}

function verificationPremiereInscription($personnelIdentite)
{
  $bd = connexionBD();

  $recherchePresence = $bd->prepare('SELECT * FROM apprenti WHERE nom = ?');
  $recherchePresence->execute(array($personnelIdentite['7']));
  $bd = null;
  return $recherchePresence->rowCount() == 0;
}


function envoiMail($nouveauMotDePasse)
{
  $destinataire = "someone@example.com";
  $sujet = "Mot de passe temporaire";
  $message = "Bonjour ! Voici votre nouveau mot de passe : " . $nouveauMotDePasse . "<br>";
  $message .= "Vous pouvez le modifier en vous connectant dans votre espace compte.";
  $from = "";
  $headers = "From:" . $from;
  mail($destinataire, $sujet, $message, $headers);
}


function clean($champEntrant)
{
  // permet d'enlever les balises html, xml, php
  $champEntrant = strip_tags($champEntrant);
  // permet d'enlève les tags HTML et PHP
  $champEntrant = htmlspecialchars($champEntrant);
  return $champEntrant;
}

/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION FICHES            ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeApprenti()
{
  $bd = connexionBD();
  $listeApprenti = $bd->prepare('SELECT * FROM apprenti');
  $listeApprenti->execute(array());
  $bd = null;
  $resultat = [];

  foreach ($listeApprenti as $row) {
    array_push($resultat, array('nom' => $row['nom'],
    'prenom' => $row['prenom'], 'photo' => $row['photo'],'id_apprenti' => $row['id_apprenti']));
  }

  return $resultat;
}




/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES SUPERADMINS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

function inscriptionApprenti($nom, $prenom, $photo, $utilisateur)
{
  try {
    $bd = connexionBD();
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $photo = htmlspecialchars($photo);

    $bd->beginTransaction();

    $ajoutUtilisateur = $bd->prepare('INSERT INTO utilisateur(login, mdp, id_role) VALUES (?, ?, ?)');
    $ajoutUtilisateur->execute(array($utilisateur['login'], $utilisateur['mdp'], $utilisateur['id_role']));
    $idUtilisateur = $bd->lastInsertId();

    if (empty($nom) || empty($prenom) || empty($photo)) {
      $bd->rollBack();
      return false;
    }

    $ajoutApprenti = $bd->prepare('INSERT INTO apprenti(nom, prenom, photo, id_utilisateur) VALUES (?, ?, ?, ?)');
    $ajoutApprenti->execute(array($nom, $prenom, $photo, $idUtilisateur));

    $bd->commit();

    $success = $ajoutApprenti->rowCount() > 0;
    $bd = null;
    return $success;
  } catch (PDOException $e) {
    $bd->rollBack();
    $bd = null;
    return false;
  }
}



function supprimerApprenti($idApprenti)
{
  $bd = connexionBD();
 
  $idApprenti = htmlspecialchars($idApprenti);
  $suppressionApprenti = $bd->prepare('DELETE FROM apprenti WHERE id_apprenti = ?');
  $suppressionApprenti->execute(array($idApprenti));
  $bd = null;
  return $suppressionApprenti->rowCount() > 0;

}

function ajouterApprenti($nom, $prenom, $photo, $mdp)
{
  $bd = connexionBD();
  $nom    = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $photo  = htmlspecialchars($photo);
  $mdp    = htmlspecialchars($mdp);

  $ajout = $bd->prepare("INSERT INTO `utilisateur`
                        (`id_utilisateur`, `login`, `mdp`, `id_role`)
                        VALUES (NULL, 'login', '".$mdp."', '1');");
  $ajout->execute();

  $ajout = $bd->prepare("SELECT id_utilisateur FROM `utilisateur` WHERE mdp = ?;");
  $ajout->execute(array($mdp));
  foreach ($ajout as $row) {

    $id =  $row["id_utilisateur"];
    break;
  }

  $ajout = $bd->prepare("INSERT INTO `apprenti`
                       (`id_apprenti`, `nom`, `prenom`, `photo`, `id_utilisateur`)
                       VALUES (NULL, '".$nom."', '".$prenom."', '".$photo."', '".$id."')");


  $ajout->execute();

  $bd = null;
  return $ajout->rowCount() > 0;

}

function ajouterEducateur($nom, $prenom, $mdp, $type, $num)
{
  $bd = connexionBD();
  $nom    = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $mdp    = htmlspecialchars($mdp);
  $type   = htmlspecialchars($type);
  $num    = htmlspecialchars($num);

  $ajout = $bd->prepare("INSERT INTO `utilisateur`
                       (`id_utilisateur`, `login`, `mdp`, `id_role`)
                       VALUES (NULL, 'login', '".$mdp."', '".$type."');");

  $ajout->execute();

  $ajout = $bd->prepare("SELECT * FROM utilisateur
  u WHERE u.mdp = ? AND u.id_role = ? AND NOT EXISTS
   (SELECT * FROM personnel p WHERE u.id_utilisateur = p.id_utilisateur);");
  $ajout->execute(array($mdp, $type));
  foreach ($ajout as $row) {

    $id =  $row["id_utilisateur"];
    break;
  }

  $ajout = $bd->prepare("INSERT INTO `personnel`
                       (`id_personnel`, `nom`, `prenom`, `id_utilisateur`)
                       VALUES (NULL, '".$nom."', '".$prenom."', '".$id."')");

  $ajout->execute();

  $bd = null;
  return $ajout->rowCount() > 0;

}



function modifierApprenti($idApprenti, $nom, $prenom, $photo)
{
  $bd = connexionBD();
  $idApprenti = htmlspecialchars($idApprenti);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $photo = htmlspecialchars($photo);
  $modifierApprenti = $bd->prepare('UPDATE apprenti SET nom = ?, prenom = ?, photo = ? where id_apprenti = ?');
  $modifierApprenti->execute(array($nom, $prenom, $photo, $idApprenti));
  $bd = null;
  return $modifierApprenti->rowCount() > 0;

}

function unApprenti($idApprenti)
{
  $bd = connexionBD();
  $idApprenti = htmlspecialchars($idApprenti);
  $listeUnApprenti = $bd ->prepare('SELECT * from apprenti WHERE id_apprenti= ?');
  $listeUnApprenti->execute(array($idApprenti));
  $bd = null;
  $resultat = [];

  foreach ($listeUnApprenti as $row) {
    array_push($resultat, array('nom' => $row['nom'], 'prenom' =>
    $row['prenom'], 'photo' => $row['photo'],'id_apprenti' =>
    $row['id_apprenti'], 'id_utilisateur' => $row['id_utilisateur']));
  }

  return $resultat;

}

function apprentiDejaExistant($nom, $prenom)
{
  $bd = connexionBD();
  $apprentiExiste = $bd->prepare('SELECT * FROM apprenti WHERE nom = ? AND prenom  = ?');
  $apprentiExiste ->execute(array($nom, $prenom));
  $bd = null;

  return $apprentiExiste->rowCount() > 0;

}
/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES Personnel        ////////////////////
/////////////////////////////////////////////////////////////////////////////
function inscriptionPersonnel($nom, $prenom, $utilisateur)
{
  try {
    $bd = connexionBD();
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $bd->beginTransaction();

    $ajoutUtilisateur = $bd->prepare('INSERT INTO utilisateur(login, mdp, id_role) VALUES (?, ?, ?)');
    $ajoutUtilisateur->execute(array($utilisateur['login'], $utilisateur['mdp'], $utilisateur['id_role']));
    $idUtilisateur = $bd->lastInsertId();

    if (empty($nom) || empty($prenom)) {
      $bd->rollBack();
      return false;
    }

    $ajoutPersonnel = $bd->prepare('INSERT INTO personnel(nom, prenom, id_utilisateur) VALUES (?, ?, ?)');
    $ajoutPersonnel->execute(array($nom, $prenom, $idUtilisateur));

    $bd->commit();

    $success = $ajoutPersonnel->rowCount() > 0;
    $bd = null;
    return $success;
  } catch (PDOException $e) {
    $bd->rollBack();
    $bd = null;
    return false;
  }
}

function supprimerPersonnel($idPersonnel)
{
  $bd = connexionBD();
  $idPersonnel = htmlspecialchars($idPersonnel);
  $suppressionPersonnel = $bd->prepare('DELETE FROM personnel WHERE id_personnel = ?');
  $suppressionPersonnel->execute(array($idPersonnel));
  $bd = null;
  return $suppressionPersonnel->rowCount() > 0;

}

function modifierPersonnel($idPersonnel, $nom, $prenom)
{
  $bd = connexionBD();
  $idPersonnel = htmlspecialchars($idPersonnel);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $modifierPersonnel = $bd->prepare('UPDATE personnel SET nom = ? , prenom = ? where id_personnel = ?');
  $modifierPersonnel->execute(array($nom, $prenom, $idPersonnel));
  $bd = null;
  return $modifierPersonnel->rowCount() > 0;

}

function listePersonnel()
{
  $bd = connexionBD();
  $listePersonnel = $bd->prepare('SELECT * FROM personnel');
  $listePersonnel->execute(array());
  $bd = null;
  $resultat = [];

  foreach ($listePersonnel as $row) {
    array_push(
        $resultat,
        array(
            'nom'           => $row['nom'],
            'prenom'        => $row['prenom'],
            'id_personnel'  => $row['id_personnel'],
            'id_utilisateur'=> $row['id_utilisateur']
        )
    );
  }

  return $resultat;
}

function listeEducateur()
{
  $bd = connexionBD();

  try {
    $listePersonnel = $bd->prepare('SELECT * FROM personnel p, utilisateur u,
     role r WHERE p.id_utilisateur = u.id_utilisateur AND u.id_role = r.id_role AND r.description = "Educ Simple"');
    $listePersonnel->execute(array());
    $bd = null;
    $resultat = [];

    foreach ($listePersonnel as $row) {
      array_push(
          $resultat,
          array(
              'nom' => $row['nom'],
              'prenom' => $row['prenom'],
              'id_personnel' => $row['id_personnel'],
              'id_utilisateur' => $row['id_utilisateur']
          )
      );
    }
  } catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
  }

  return $resultat;
}
function listeSuperAdmin()
{
  $bd = connexionBD();

  try {
    $listePersonnel = $bd->prepare('SELECT * FROM personnel p,
    utilisateur u, role r WHERE p.id_utilisateur = u.id_utilisateur
    AND u.id_role = r.id_role AND r.description = "Super-Admin"');
    $listePersonnel->execute(array());
    $bd = null;
    $resultat = [];

    foreach ($listePersonnel as $row) {
      array_push(
          $resultat,
          array(
              'nom' => $row['nom'],
              'prenom' => $row['prenom'],
              'id_personnel' => $row['id_personnel'],
              'id_utilisateur' => $row['id_utilisateur']
          )
      );
    }
  } catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
  }

  return $resultat;
}

function unPersonnel($idPersonnel)
{
  $bd = connexionBD();
  $idPersonnel = htmlspecialchars($idPersonnel);
  $listeUnPersonnel = $bd ->prepare('SELECT * from personnel WHERE id_personnel= ?');
  $listeUnPersonnel->execute(array($idPersonnel));
  $bd = null;
  $resultat = [];

  foreach ($listeUnPersonnel as $row) {
    array_push(
        $resultat,
        array(
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'id_personnel' => $row['id_personnel'],
            'id_utilisateur' => $row['id_utilisateur']
      )
    );
  }

  return $resultat;

}

function personnelDejaExistant($nom, $prenom)
{
  $bd = connexionBD();
  $personnelExiste = $bd->prepare('SELECT * FROM personnel WHERE nom = ? AND prenom = ?');
  $personnelExiste ->execute(array($nom,$prenom));
  $bd = null;

  return $personnelExiste->rowCount() > 0;

}

/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION FICHES            ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFiche()
{
  $bd = connexionBD();
  $listeFiche = $bd->prepare('SELECT * from fiche_intervention');
  $listeFiche ->execute(array());
  $bd = null;
  $resultat = [];

  foreach ($listeFiche as $row) {
    array_push(
        $resultat,
        array(
            'numero' => $row['numero'],
            'nom_du_demandeur' => $row['nom_du_demandeur'],
            'date_demande' => $row['date_demande'],
            'date_intervention' => $row['date_intervention'],
            'duree_intervention' => $row['duree_intervention'],
            'localisation' => $row['localisation'],
            'description_demande' => $row['description_demande'],
            'degre_urgence' => $row['degre_urgence'],
            'type_intervention' => $row['type_intervention'],
            'nature_intervention' => $row['nature_intervention'],
            'couleur_intervention' => $row['couleur_intervention'],
            'etat_fiche' => $row['etat_fiche'],
            'date_creation' => $row['date_creation'],
            'id_fiche' => $row['id_fiche']
        )
    );
  }

  return $resultat;
}

function creationFiche(
    $numero,
    $nomDuDemandeur,
    $dateDemande,
    $dateIntervention,
    $dureeIntervention,
    $localisation,
    $descriptionDemande,
    $degreUrgence,
    $typeIntervention,
    $natureIntervention,
    $travauxRealises,
    $travauxNonRealises,
    $couleurIntervention,
    $etatFiche,
    $dateCreation,
    $idApprenti,
    $idPersonnel
) {
  $bd = connexionBD();
  $numero = htmlspecialchars($numero);
  $nomDuDemandeur = htmlspecialchars($nomDuDemandeur);
  $dateDemande = htmlspecialchars($dateDemande);
  $dateIntervention = htmlspecialchars($dateIntervention);
  $dureeIntervention = htmlspecialchars($dureeIntervention);
  $localisation = htmlspecialchars($localisation);
  $descriptionDemande = htmlspecialchars($descriptionDemande);
  $degreUrgence = htmlspecialchars($degreUrgence);
  $typeIntervention = htmlspecialchars($typeIntervention);
  $natureIntervention = htmlspecialchars($natureIntervention);
  $travauxRealises = htmlspecialchars($travauxRealises);
  $travauxNonRealises = htmlspecialchars($travauxNonRealises);
  $couleurIntervention = htmlspecialchars($couleurIntervention);
  $etatFiche = htmlspecialchars($etatFiche);
  $dateCreation = htmlspecialchars($dateCreation);
  $idApprenti = htmlspecialchars($idApprenti);
  $idPersonnel = htmlspecialchars($idPersonnel);

  $creerFiche = $bd->prepare(
    'INSERT INTO fiche_intervention(numero, nom_du_demandeur, date_demande, ' .
    'date_intervention, duree_intervention, localisation, description_demande, ' .
    'degre_urgence, type_intervention, nature_intervention, couleur_intervention, ' .
    'etat_fiche, date_creation, id_apprenti, id_personnel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);

$creerFiche->execute(array(
  $numero,
  $nomDuDemandeur,
  $dateDemande,
  $dateIntervention,
  $dureeIntervention,
  $localisation,
  $descriptionDemande,
  $degreUrgence,
  $typeIntervention,
  $natureIntervention,
  $travauxRealises,
  $travauxNonRealises,
  $couleurIntervention,
  $etatFiche,
  $dateCreation,
  $idApprenti,
  $idPersonnel
));

  $bd = null;

  return $creerFiche->rowCount() > 0;

}



function supprimerFiche($idFiche)
{
  $bd = connexionBD();
  $idFiche = htmlspecialchars($idFiche);
  $suppressionFiche = $bd->prepare('DELETE FROM fiche_intervention WHERE id_fiche = ?');
  $suppressionFiche->execute(array($idFiche));
  return $suppressionFiche->rowCount() > 0;

}


function modifierFiche(
    $idFiche,
    $numero,
    $nomDuDemandeur,
    $dateDemande,
    $dateIntervention,
    $dureeIntervention,
    $localisation,
    $descriptionDemande,
    $degreUrgence,
    $typeIntervention,
    $natureIntervention,
    $travauxRealises,
    $travauxNonRealises,
    $couleurIntervention,
    $etatFiche,
    $dateCreation,
    $idApprenti,
    $idPersonnel
) {

  $bd = connexionBD();
  $idFiche = htmlspecialchars($idFiche);
  $numero = htmlspecialchars($numero);
  $nomDuDemandeur = htmlspecialchars($nomDuDemandeur);
  $dateDemande = htmlspecialchars($dateDemande);
  $dateIntervention = htmlspecialchars($dateIntervention);
  $dureeIntervention = htmlspecialchars($dureeIntervention);
  $localisation = htmlspecialchars($localisation);
  $descriptionDemande = htmlspecialchars($descriptionDemande);
  $degreUrgence = htmlspecialchars($degreUrgence);
  $typeIntervention = htmlspecialchars($typeIntervention);
  $natureIntervention = htmlspecialchars($natureIntervention);
  $travauxRealises = htmlspecialchars($travauxRealises);
  $travauxNonRealises = htmlspecialchars($travauxNonRealises);
  $couleurIntervention = htmlspecialchars($couleurIntervention);
  $etatFiche = htmlspecialchars($etatFiche);
  $dateCreation = htmlspecialchars($dateCreation);
  $idApprenti = htmlspecialchars($idApprenti);
  $idPersonnel = htmlspecialchars($idPersonnel);


  $modifierFiche = $bd->prepare('UPDATE fiche_intervention
    SET numero = ?,
        nom_du_demandeur = ?,
        date_demande = ?,
        date_intervention = ?,
        duree_intervention = ?,
        localisation = ?,
        description_demande = ?,
        degre_urgence = ?,
        type_intervention = ?,
        nature_intervention = ?,
        couleur_intervention = ?,
        etat_fiche = ?,
        date_creation = ?,
        id_apprenti = ?,
        id_personnel = ?
    WHERE id_fiche = ?');


$modifierFiche->execute(array(
  $numero,
  $nomDuDemandeur,
  $dateDemande,
  $dateIntervention,
  $dureeIntervention,
  $localisation,
  $descriptionDemande,
  $degreUrgence,
  $typeIntervention,
  $natureIntervention,
  $travauxRealises,
  $travauxNonRealises,
  $couleurIntervention,
  $etatFiche,
  $dateCreation,
  $idApprenti,
  $idPersonnel,
  $idFiche
));


  $bd = null;

  return $modifierFiche->rowCount() > 0;

}

function uneFicheIntervention($idFiche)
{
  $bd = connexionBD();
  $idFiche = htmlspecialchars($idFiche);
  $uneFicheIntervention = $bd->prepare('SELECT * from fiche_intervention WHERE id_fiche = ?');
  $uneFicheIntervention ->execute(array($idFiche));
  $bd = null;
  $resultat = [];

  foreach ($uneFicheIntervention as $row) {
    array_push($resultat, array('numero' => $row['numero'],'nom_du_demandeur' =>
    $row['nom_du_demandeur'],'date_demande' => $row['date_demande'],'date_intervention' =>
     $row['date_intervention'],'duree_intervention' => $row['duree_intervention'],'localisation' =>
      $row['localisation'],'description_demande' => $row['description_demande'],'degre_urgence' =>
      $row['degre_urgence'],'type_intervention' => $row['type_intervention'],'nature_intervention' =>
      $row['nature_intervention'],'couleur_intervention' => $row['couleur_intervention'],'etat_fiche' =>
      $row['etat_fiche'],'date_creation' => $row['date_creation'], 'id_fiche' => $row['id_fiche']));
  }

  return $resultat;
  
}

function ficheInterventionDejaExistante($numero)
{
  $bd = connexionBD();
  $numero = htmlspecialchars($numero);
  $ficheExiste = $bd ->prepare('SELECT * from fiche_intervention WHERE numero = ?');
  $ficheExiste ->execute(array($numero));
  $bd = null;
  return $ficheExiste->rowCount() > 0;
}

/////////////////////////////////////////////////////////////////////////////
////////////////////          GESTION DES COURS          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeCours()
{
  $bd = connexionBD();
  $listeCours = $bd->prepare('SELECT * from session');
  $listeCours ->execute(array());
  $bd = null;
  $resultat = [];

  foreach ($listeCours as $row) {
    array_push($resultat, array('Thème' => $row['theme'],'Cours' => $row['cours'],
    'Durée du Cours' => $row['duree'], 'ID_Formation' => $row['id_formation']));
  }

  return $resultat;
}


function unCours($cours)
{
  $bd = connexionBD();
  $unCours = $bd->prepare('SELECT * from session WHERE cours = ?');
  $unCours ->execute(array($cours));
  $bd = null;
  $resultat = [];

  foreach ($unCours as $row) {
    array_push($resultat, array('Thème' => $row['theme'],'Cours' => $row['cours'],
    'Durée du Cours' => $row['duree'], 'ID_Formation' => $row['id_formation']));
  }

  return $resultat;
}

function creationCours($theme, $cours, $duree, $idFormation)
{
  $bd = connexionBD();
  $theme = htmlspecialchars($theme);
  $cours = htmlspecialchars($cours);
  $duree = htmlspecialchars($duree);
  $idFormation = htmlspecialchars($idFormation);
  $creerCours = $bd->prepare('INSERT INTO session(theme, cours, duree, id_formation) VALUES (?, ?, ?, ?)');
  $creerCours->execute(array($theme, $cours, $duree, $idFormation));
  $bd = null;

  return $creerCours->rowCount() > 0;

}


function suppressionCours($idSession)
{
  $bd = connexionBD();
  $supprimerCours = $bd ->prepare('DELETE FROM session WHERE id_session = ?');
  $supprimerCours ->execute(array($idSession));
  $bd = null;
 return $supprimerCours->rowCount() > 0;

}

function modificationCours($idSession, $theme, $cours, $duree, $idFormation)
{
  $bd = connexionBD();
  $modifierCours = $bd->prepare('UPDATE session SET theme = ?, cours = ?, duree = ?, id_formation = ?
                                WHERE id_session = ?');

  $modifierCours ->execute(array($theme, $cours, $duree, $idFormation, $idSession));
  $bd = null;
  return $modifierCours->rowCount() > 0;

}


/////////////////////////////////////////////////////////////////////////////
////////////////////            GESTION FORMATIONS       ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFormations()
{
  $bd = connexionBD();
  $listeFormations = $bd ->prepare('SELECT * from formation');
  $listeFormations ->execute(array());
  $bd = null;
  $result = [];
  foreach ($listeFormations as $row) {
    array_push($result, array('Intitulé de la Formation' => $row['intitule'],
    'Niveau de Qualification' => $row['niveau_qualif'],'Groupe' =>$row['groupe'], 'ID' =>$row['id_formation']));
  }

  return $result;
}

function uneFormation($idFormation)
{
  $bd = connexionBD();
  $uneFormation = $bd ->prepare('SELECT * FROM formation WHERE id_formation = ?');
  $uneFormation ->execute(array($idFormation));
  $bd = null;
  $result = [];
  foreach ($uneFormation as $row) {
    array_push($result, array('Intitulé de la Formation' => $row['intitule'],
    'Niveau de Qualification' => $row['niveau_qualif'],'Groupe' =>$row['groupe']));
  }

  return $result;
}

function ajouterFormation($intitule, $niveauQualif, $groupe)
{
  $bd = connexionBD();
  $ajoutFormation = $bd ->prepare('INSERT INTO formation(intitule,niveau_qualif,groupe) VALUES (?, ?, ?)');
  $ajoutFormation -> execute(array($intitule, $niveauQualif, $groupe));
  $bd = null;

  return $ajoutFormation->rowCount() > 0;

}

function suppresionFormation($idFormation)
{
  $bd = connexionBD();
  $supprimerFormation = $bd ->prepare('DELETE FROM formation WHERE id_formation = ?');
  $supprimerFormation ->execute(array($idFormation));
  $bd = null;
  return $supprimerFormation->rowCount() > 0;

}

function modifierFormation($idFormation, $intitule, $niveauQualif, $groupe)
{
  $bd = connexionBD();
  $modifierFormation = $bd ->prepare('UPDATE formation SET intitule = ?,
  niveau_qualif = ?, groupe = ? WHERE id_formation = ?');
  $modifierFormation ->execute(array($intitule, $niveauQualif, $groupe, $idFormation));
  $bd = null;
  return $modifierFormation->rowCount() > 0;

}

function formationExisteDeja($intitule)
{
  $bd = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $formationExiste = $bd ->prepare('SELECT * from formation WHERE intitule = ?');
  $formationExiste ->execute(array($intitule));
  $bd = null;
  return $formationExiste->rowCount() > 0;

}

/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION DES PHOTOS        ////////////////////
/////////////////////////////////////////////////////////////////////////////

function ajouterElement($libelle, $type, $picto=null, $text=null, $audio=null)
{
  $bd = connexionBD();
  static $req;

  $libelle = htmlspecialchars($libelle);
  $type = htmlspecialchars($type);

  if ($type == "picto" && isset($picto)) {
    $picto = htmlspecialchars($picto);
    $req = $bd->prepare('INSERT INTO element_defaut (libelle, type, picto, id_personnel) VALUES (?, ?, ?, 1);');
    $req->execute(array($libelle, $type, $picto));
  }elseif ($type == "text" && isset($text)) {
    $text = htmlspecialchars($text);
    $req = $bd->prepare('INSERT INTO element_defaut (libelle, type, text, id_personnel) VALUES (?, ?, ?, 1);');
    $req->execute(array($libelle, $type, $text));
  }elseif ($type == "audio" && isset($audio)) {
    $audio = htmlspecialchars($audio);
    $req = $bd->prepare('INSERT INTO element_defaut (libelle, type, audio, id_personnel) VALUES (?, ?, ?, 1);');
    $req->execute(array($libelle, $type, $audio));
  }

  $bd = null;
  return $req->rowCount() > 0;
}

function listeElement($type=null)
{
  $bd = connexionBD();
  static $req;

  if (isset($type)) {
    $req = $bd->prepare('SELECT id_element, libelle, picto, text, audio FROM element_defaut WHERE type = ?');
    $req->execute(array($type));
  } else {
    $req = $bd->prepare('SELECT id_element, libelle, type, picto, text, audio FROM element_defaut');
    $req->execute();
  }
  return $req->fetchall();
}

function supprimerElement($id)
{
  $bd = connexionBD();
  
  $req = $bd->prepare('DELETE FROM element_defaut WHERE id_element = ?');
  $req->execute(array($id));
  
  return $req->fetchall();
}

/////////////////////////////////////////////////////////////////////////////
////////////////////         GESTION DES TRACES          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeTrace()
{
   $bd = connexionBD();
   $listeTrace = $bd -> prepare('SELECT * FROM laisser_trace');
   $listeTrace ->execute(array());
   $bd = null;
   $result = [];

   foreach ($listeTrace as $row) {
      array_push($result, array('ID Personnel' =>$row['id_personnel'],
      'Horodatage' =>$row['horodatage'], 'Intitulé' =>$row['intitule'],
      'Evaluation Textuelle' =>$row['eval_texte'],'Commentaire Textuelle' =>
      $row['commentaire_texte'], 'Evaluation Audio' =>$row['eval_audio'],'Commentaire Audio' =>
       $row['commentaire_audio'], 'ID de la Fiche' =>$row['id_fiche']));
   }

   return $result;
}

function uneTrace($intitule)
{
  $bd = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $uneTrace = $bd -> prepare('SELECT * FROM laisser_tracer WHERE intitule = ?');
  $uneTrace -> execute(array($intitule));
  $bd = null;
  $result = [];
 
    foreach ($uneTrace as $row) {
       array_push($result, array('ID Personnel' =>$row['id_personnel'],
       'Horodatage' =>$row['horodatage'], 'Intitulé' =>$row['intitule'],
       'Evaluation Textuelle' =>$row['eval_texte'],'Commentaire Textuelle' =>
       $row['commentaire_texte'], 'Evaluation Audio' =>$row['eval_audio'],
       'Commentaire Audio' => $row['commentaire_audio'], 'ID de la Fiche' =>$row['id_fiche']));
    }
 
    return $result;
 }

 function ajouterTrace(
     $idPersonnel,
     $horodatage,
     $intitule,
     $evalTexte,
     $commentaireTexte,
     $evalAudio,
     $commentaireAudio,
     $idFiche
) {
  $bd = connexionBD();
  $idPersonnel = htmlspecialchars($idPersonnel);
  $horodatage = htmlspecialchars($horodatage);
  $intitule = htmlspecialchars($intitule);
  $evalTexte = htmlspecialchars($evalTexte);
  $commentaireTexte = htmlspecialchars($commentaireTexte);
  $evalAudio = htmlspecialchars($evalAudio);
  $commentaireAudio = htmlspecialchars($commentaireAudio);
  $idFiche = htmlspecialchars($idFiche);

  $ajoutTrace = $bd->prepare('INSERT INTO laisser_trace(
    id_personnel,
    horodatage,
    intitule,
    eval_texte,
    commentaire_texte,
    eval_audio,
    commentaire_audio,
    id_fiche
) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
  $ajoutTrace->execute(array(
    $idPersonnel,
    $horodatage,
    $intitule,
    $evalTexte,
    $commentaireTexte,
    $evalAudio,
    $commentaireAudio,
    $idFiche
));

  $bd = null;
  return $ajoutTrace->rowCount() > 0;
}

function supprimerTrace($intitule)
{
  $bd = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $suppresionTrace = $bd -> prepare('DELETE INTO laisser_trace WHERE intitule = ?');
  $suppresionTrace -> execute(array($intitule));
  $bd = null;

  return $suppresionTrace->rowCount() > 0;

}

function modificationTrace(
    $idPersonnel,
    $horodatage,
    $intitule,
    $evalTexte,
    $commentaireTexte,
    $evalAudio,
    $commentaireAudio,
    $idFiche
) {
  $bd = connexionBD();
  $idPersonnel = htmlspecialchars($idPersonnel);
  $horodatage = htmlspecialchars($horodatage);
  $intitule = htmlspecialchars($intitule);
  $evalTexte = htmlspecialchars($evalTexte);
  $commentaireTexte = htmlspecialchars($commentaireTexte);
  $evalAudio = htmlspecialchars($evalAudio);
  $commentaireAudio = htmlspecialchars($commentaireAudio);
  $idFiche = htmlspecialchars($idFiche);

  $modifierTrace = $bd->prepare('UPDATE laisser_trace
    SET id_personnel = ?,
        horodatage = ?,
        intitule = ?,
        eval_texte = ?,
        commentaire_texte = ?,
        eval_audio = ?,
        commentaire_audio = ?,
        id_fiche = ?');

$modifierTrace->execute(array(
  $idPersonnel,
  $horodatage,
  $intitule,
  $evalTexte,
  $commentaireTexte,
  $evalAudio,
  $commentaireAudio,
  $idFiche
));

  $bd = null;
  return $modifierTrace->rowCount() > 0;
}




/////////////////////////////////////////////////////////////////////////////
////////////////////             GESTION API             ////////////////////
/////////////////////////////////////////////////////////////////////////////


function deliverResponse($status, $statusMessage, $data)
{
  header("HTTP/1.1 $status $statusMessage");
  $response['status'] = $status;
  $response['status_message'] = $statusMessage;
  $response['data'] = $data;
  $jsonResponse = json_encode($response);
  echo $jsonResponse;
}

function getBodyToken(string $bearerToken): array
{
  $tokenParts = explode('.', $bearerToken);
  $payload = base64_decode($tokenParts[1]);
  return (array) json_decode($payload);
}

function isConnected(): void
{
  if (1 == 2) {
    throw new ExceptionLoginRequire();
  }
}

//function action_permited(string $action, string $ressource, int $id = null) : void
function actionPermited(): void
{
  if (1 == 2) {
    throw new ExceptionIssuficiantPermission();
  }
}



