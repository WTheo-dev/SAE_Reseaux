<?php

/////////////////////////////////////////////////////////////////////////////
////////////////////   CONNEXION A LA BASE DE DONNEES    ////////////////////
/////////////////////////////////////////////////////////////////////////////

function connexionBD()
{
  $SERVER = '127.0.0.1';
  $BD = 'apeaj';
  $LOGIN = 'root';
  $MDP = '';

  try {
    $BD = new PDO("mysql:host=$SERVER;dbname=$BD", $LOGIN, $MDP);
  } catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
  }
  return $BD;
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

function connexionApprenti($id_Apprenti)
{
  $BD = connexionBD();
  if (count($id_Apprenti) > 0) {
    $identiteApprentiHTML = conversionHTML($id_Apprenti);
    if (count($id_Apprenti) > 0) {
      $verificationApprenti = $BD->prepare('SELECT $ from apprenti WHERE schema = ?');
      $verificationApprenti->execute(array($id_Apprenti['0']));
      $BD = null;
      if ($verificationApprenti->rowCount() > 0) {
        foreach ($verificationApprenti as $row) {
          if (password_verify($id_Apprenti['1'], $row['mdp'])) {
            $_SESSION['id'] = $row['id_apprenti'];
            $_SESSION['compteValide'] = $row['compteValide'];
            $_SESSION['coordinateur'] = $row['coordinateur'];
            return TRUE;
          }
        }
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }

}




function validationmdp($mdp, $mdpConfirmation)
{
  if ($mdp == $mdpConfirmation && strlen($mdp) >= 5) {
    return password_hash($mdp, PASSWORD_DEFAULT);
  } else {
    return FALSE;
  }
}

function verificationPremiereInscription($EducateurIdentite)
{
  $BD = connexionBD();
  $recherchePresence = $BD->prepare('SELECT * FROM apprenti WHERE nom = ?');
  $recherchePresence->execute(array($EducateurIdentite['7']));
  $BD = null;
  if ($recherchePresence->rowCount() > 0) {
    return FALSE;
  } else {
    return TRUE;
  }
}


function envoiMail($adresseMail, $nouveauMotDePasse)
{
  $destinataire = "someone@example.com";
  $sujet = "Mot de passe temporaire";
  $message = "Bonjour ! Voici votre nouveau mot de passe : " . $nouveauMotDePasse . "<br> Vous pouvez le modifier en vous connectant dans votre espace compte.";
  $from = "";
  $headers = "From:" . $from;
  mail($destinataire, $sujet, $message, $headers);
}

function recuperation_role($login)
{
  $BD = connexionBD();
  $recuperationRoleMembre = $BD->prepare('SELECT id_utilisateur FROM utilisateur WHERE login = ?');
  $recuperationRoleMembre->execute(array($login));
  $BD = null;
  if ($recuperationRoleMembre->rowCount() > 0) {
    foreach ($recuperationRoleMembre as $row) {
      return $row['id_role'];
    }
  } else {
    return FALSE;
  }
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
  $BD = connexionBD();
}

function unApprenti()
{
  $BD = connexionBD();
}




/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES SUPERADMINS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

function inscriptionApprenti($apprentiIdentite)
{
  $BD = connexionBD();
  if (count($apprentiIdentite) > 0) {
    $identiteApprentiHTML = conversionHTML($apprentiIdentite);

    $role = 1;

    if (count($identiteApprentiHTML) > 0) {
      $ajoutApprenti = $BD->prepare('INSERT INTO apprenti(nom, prenom, login, mdp, photo, compteValide) VALUES (?,?,?,?,?,?,?)');
      $ajoutApprenti->execute(array($identiteApprentiHTML['0'], $identiteApprentiHTML['1'], $identiteApprentiHTML['2'], $identiteApprentiHTML['3'], $identiteApprentiHTML['4'], $role, 0));

      $BD = null;

      if ($ajoutApprenti->rowCount() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return TRUE;
    }
  } else {
    return FALSE;
  }
}

function inscriptionEducateur($educateurIdentite)
{
  $BD = connexionBD();
  if (count($educateurIdentite) > 0) {
    $identiteEducateurHTML = conversionHTML($educateurIdentite);
    if ($educateurIdentite['6'] == 2) {
      $role = 2;
    } else {
      $role = 3;
    }
    if (count($identiteEducateurHTML) > 0) {
      $ajoutEducateur = $BD->prepare('INSERT INTO Educateur(nom, prenom, login, mdp, compteValide, role) VALUES (?,?,?,?,?,?,?,?,?,?)');
      $ajoutEducateur->execute(array($identiteEducateurHTML['0'], $identiteEducateurHTML['1'], $identiteEducateurHTML['3'], $identiteEducateurHTML['4'], $identiteEducateurHTML['5'], $role, 0));
      $BD = null;
      if ($ajoutEducateur->rowCount() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return TRUE;
    }
  } else {
    return FALSE;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES EDUCATEURS       ////////////////////
/////////////////////////////////////////////////////////////////////////////


function suppresionEducateur($id_personnel)
{
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $suppressionEducateur = $BD->prepare('DELETE FROM personnel WHERE id_personnel = ?');
  $suppressionEducateur->execute(array($id_personnel));
  $BD = null;
  if ($suppressionEducateur->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function modifierEducateur($personnel, $id_personnel, $nom, $prénom)
{
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $nom = htmlspecialchars($nom);
  $prénom = htmlspecialchars($prénom);
  $modifierEducateur = $BD->prepare('UPDATE personnel SET nom = ? , prenom = ? where id_personnel = ?');
  $modifierEducateur->execute(array($nom, $prénom, $id_personnel));
  $BD = null;
  if ($modifierEducateur->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function listeEducateur()
{
  $BD = connexionBD();
}

function unEducateur()
{
  $BD = connexionBD();
}


/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION FICHES            ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFiche($id_fiche)
{
  $BD = connexionBD();
  $listeFiche = $BD->prepare('SELECT * from ');

}

function créerFiche()
{
  $BD = connexionBD();
}

function supprimerFiche($id_fiche)
{
  $BD = connexionBD();
  $id_fiche = htmlspecialchars($id_fiche);
  $suppressionFiche = $BD->prepare('DELETE FROM fiche WHERE id_fiche = ?');
  $suppressionFiche->execute(array($id_fiche));
  if ($suppressionFiche->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}


function modifierFiche($id_fiche, $numéro, $nom_du_demandeur, $date_demande,$date_intervention, $durée_intervention, $localisation, $description_demande, $degré_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_création
) {
  $BD = connexionBD();

  // Utilisez les paramètres corrects pour la modification de la fiche
  $modifierFiche = $BD->prepare('UPDATE fiche SET
    numero = ?,
    nom_demandeur = ?,
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
    date_creation = ?
    WHERE id_fiche = ?');

  // Utilisez les valeurs correctes pour la mise à jour de la fiche
  $modifierFiche->execute(array(
    $numéro,
    $nom_du_demandeur,
    $date_demande,
    $date_intervention,
    $durée_intervention,
    $localisation,
    $description_demande,
    $degré_urgence,
    $type_intervention,
    $nature_intervention,
    $couleur_intervention,
    $etat_fiche,
    $date_création,
    $id_fiche
  ));

  $BD = null;

  if ($modifierFiche->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}


function lireFiche()
{
  $BD = connexionBD();
}



/////////////////////////////////////////////////////////////////////////////
////////////////////             GESTION API             ////////////////////
/////////////////////////////////////////////////////////////////////////////


function deliver_response($status, $status_message, $data)
{
  header("HTTP/1.1 $status $status_message");
  $response['status'] = $status;
  $response['status_message'] = $status_message;
  $response['data'] = $data;
  $json_response = json_encode($response);
  echo $json_response;
}

function get_body_token(string $bearer_token): array
{
  $tokenParts = explode('.', $bearer_token);
  $payload = base64_decode($tokenParts[1]);
  return (array) json_decode($payload);
}

function is_connected(): void
{
  if (1 == 2) {
    throw new ExceptionLoginRequire();
  }
}

//function action_permited(string $action, string $ressource, int $id = null) : void
function action_permited(): void
{
  if (1 == 2) {
    throw new ExceptionIssuficiantPermission();
  }
}
?>