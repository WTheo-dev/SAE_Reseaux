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

function identification($login, $mdp){
  $login = htmlspecialchars($login);
  $mdp = htmlspecialchars($mdp);
  $BD = connexionBD();
  $verificationMembre = $BD->prepare('SELECT * FROM utilisateur WHERE login = ? AND mdp = ?');
  $verificationMembre->execute(array($login, $mdp));
  $BD = null;
  if($verificationMembre->rowCount() > 0){
      return TRUE;
  }else{
      return FALSE;
 } 
}

function  recuperation_role($login)  {
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $recuperationRoleUtilisateur = $BD->prepare('SELECT id_role FROM utilisateur WHERE login = ?');
  $recuperationRoleUtilisateur->execute(array($login));
  $BD = null;
  if($recuperationRoleUtilisateur->rowCount() > 0){
      foreach($recuperationRoleUtilisateur as $row){
          return $row['id_role'];
      }
  }else{
      return FALSE;
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

function connexionApprenti($id_Apprenti)
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
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

function verificationPremiereInscription($PersonnelIdentite)
{
  $BD = connexionBD();
 
  $recherchePresence = $BD->prepare('SELECT * FROM apprenti WHERE nom = ?');
  $recherchePresence->execute(array($PersonnelIdentite['7']));
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

  if (!$BD) {
    return FALSE;
  }

  $listeApprenti = $BD->prepare('SELECT * FROM apprenti');
  $listeApprenti->execute(array());
    $BD = null;
    $resultat = [];

    foreach($listeApprenti as $row){
        array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom'], 'photo' => $row['photo']));
    }

    return $resultat;
}


function unApprenti()
{
  $BD = connexionBD();
 
}




/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES SUPERADMINS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

function inscriptionApprenti($nom, $prenom, $photo)
{
  $BD = connexionBD();

  // Vérifiez que la connexion à la base de données est réussie
  if (!$BD) {
    return FALSE;
  }

  // Vérifiez si les informations de l'apprenti sont valides
  if (!empty($nom) && !empty($prenom) && !empty($photo)) {
    // Préparez la requête SQL pour insérer un nouvel apprenti
    $ajoutApprenti = $BD->prepare('INSERT INTO apprenti(nom, prenom, photo) VALUES (?, ?, ?)');

    // Exécutez la requête en liant les valeurs des paramètres
    $ajoutApprenti->execute(array($nom, $prenom, $photo));

    // Fermez la connexion à la base de données
    $BD = null;

    // Vérifiez si l'ajout de l'apprenti a réussi
    if ($ajoutApprenti->rowCount() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  } else {
    // Retournez FALSE si les informations de l'apprenti ne sont pas valides
    return FALSE;
  }
}


function supprimerApprenti($id_apprenti) {
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $id_apprenti = htmlspecialchars($id_apprenti);
  $suppressionApprenti = $BD->prepare('DELETE FROM apprenti WHERE id_apprenti = ?');
  $suppressionApprenti->execute(array($id_apprenti));
  $BD = null;
  if ($suppressionApprenti->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}
function inscriptionPersonnel($PersonnelIdentite)
{
  $BD = connexionBD();

  // Vérifiez que la connexion à la base de données est réussie
  if (!$BD) {
    return FALSE;
  }

  // Vérifiez si les informations du personnel sont valides
  if (count($PersonnelIdentite) > 0) {
    // Supposons que le rôle par défaut est 3
    $role = 3;

    // Vérifiez le rôle spécifique
    if ($PersonnelIdentite['6'] == 2) {
      $role = 2;
    }

    // Convertissez les informations du personnel en HTML si nécessaire
    $identitePersonnelHTML = conversionHTML($PersonnelIdentite);

    // Vérifiez si la conversion HTML a réussi
    if (count($identitePersonnelHTML) > 0) {
      // Préparez la requête SQL pour insérer un nouveau personnel
      $ajoutPersonnel = $BD->prepare('INSERT INTO personnel(nom, prenom, id_role) VALUES (?, ?, ?)');

      // Exécutez la requête en liant les valeurs des paramètres
      $ajoutPersonnel->execute(array($identitePersonnelHTML['0'], $identitePersonnelHTML['1'], $role));

      // Fermez la connexion à la base de données
      $BD = null;

      // Vérifiez si l'ajout du personnel a réussi
      if ($ajoutPersonnel->rowCount() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      // Retournez FALSE si la conversion HTML a échoué
      return FALSE;
    }
  } else {
    // Retournez FALSE si les informations du personnel ne sont pas valides
    return FALSE;
  }
}

function modifierApprenti($id_apprenti, $nom, $prenom, $photo){
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $id_apprenti = htmlspecialchars($id_apprenti);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $photo = htmlspecialchars($photo);	
  $modifierPersonnel = $BD->prepare('UPDATE apprenti SET nom = ? , prenom = ? photo = ? where id_apprenti = ?');
  $modifierPersonnel->execute(array($id_apprenti, $nom, $prenom, $photo));
  $BD = null;
  if ($modifierPersonnel->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES Personnel        ////////////////////
/////////////////////////////////////////////////////////////////////////////


function supprimerPersonnel($id_personnel)
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $id_personnel = htmlspecialchars($id_personnel);
  $suppressionPersonnel = $BD->prepare('DELETE FROM personnel WHERE id_personnel = ?');
  $suppressionPersonnel->execute(array($id_personnel));
  $BD = null;
  if ($suppressionPersonnel->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function modifierPersonnel($personnel, $id_personnel, $nom, $prenom)
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $id_personnel = htmlspecialchars($id_personnel);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $modifierPersonnel = $BD->prepare('UPDATE personnel SET nom = ? , prenom = ? where id_personnel = ?');
  $modifierPersonnel->execute(array($nom, $prenom, $id_personnel));
  $BD = null;
  if ($modifierPersonnel->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function listePersonnel()
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $listePersonnel = $BD->prepare('SELECT * FROM personnel');
  $listePersonnel->execute(array());
    $BD = null;
    $resultat = [];

    foreach($listePersonnel as $row){
        array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom']));
    }

    return $resultat;
}

function unPersonnel()
{
  $BD = connexionBD();
}


/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION FICHES            ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFiche($id_fiche)
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $listeFiche = $BD->prepare('SELECT * from ');

}

function creerFiche()
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
}

function supprimerFiche($id_fiche)
{
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
  $id_fiche = htmlspecialchars($id_fiche);
  $suppressionFiche = $BD->prepare('DELETE FROM fiche WHERE id_fiche = ?');
  $suppressionFiche->execute(array($id_fiche));
  if ($suppressionFiche->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}


function modifierFiche($id_fiche, $numero, $nom_du_demandeur, $date_demande,$date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation
) {
  $BD = connexionBD();
  if (!$BD) {
    return FALSE;
  }
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
    $numero,
    $nom_du_demandeur,
    $date_demande,
    $date_intervention,
    $duree_intervention,
    $localisation,
    $description_demande,
    $degre_urgence,
    $type_intervention,
    $nature_intervention,
    $couleur_intervention,
    $etat_fiche,
    $date_creation,
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
  if (!$BD) {
    return FALSE;
  }
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