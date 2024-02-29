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
    die('Erreur: ' . $e->getMessage());
  }
  return $BD;
}

function identification($login, $mdp)
{
  $login = htmlspecialchars($login);
  $mdp = htmlspecialchars($mdp);
  $BD = connexionBD();
  $verificationMembre = $BD->prepare('SELECT * FROM utilisateur WHERE login = ? AND mdp = ?');
  $verificationMembre->execute(array($login, $mdp));
  $BD = null;
  if ($verificationMembre->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function recuperation_role($login)
{
  $BD = connexionBD();
  $recuperationRoleUtilisateur = $BD->prepare('SELECT id_role FROM utilisateur WHERE login = ?');
  $recuperationRoleUtilisateur->execute(array($login));
  $BD = null;
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

function login_id($id_utilisateur) {
  $BD = connexionBD();
  $rechercheUtilisateur = $BD->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
  $rechercheUtilisateur->execute(array($id_utilisateur));
  $BD = null;
  if ($rechercheUtilisateur->rowCount() > 0) {
    foreach ($rechercheUtilisateur as $row) {
      return $row['login'];
    }
  } else {
    return FALSE;
  }
}

function id_login($login)
{
  $BD = connexionBD();
  $rechercheUtilisateur = $BD->prepare('SELECT * FROM utilisateur WHERE id_utilisateur = ?');
  $rechercheUtilisateur->execute(array($login));
  $BD = null;
  if ($rechercheUtilisateur->rowCount() > 0) {
    foreach ($rechercheUtilisateur as $row) {
      return $row['id_utilisateur'];
    }
  } else {
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

function connexionApprenti($id_apprenti)
{
  $BD = connexionBD();

  if (count(($id_apprenti)) > 0) {
    $identiteApprentiHTML = conversionHTML($id_apprenti);
    if (count(($id_apprenti)) > 0) {
      $verificationApprenti = $BD->prepare('SELECT $ from apprenti WHERE schema = ?');
      $verificationApprenti->execute(array($id_apprenti['0']));
      $BD = null;
      if ($verificationApprenti->rowCount() > 0) {
        foreach ($verificationApprenti as $row) {
          if (password_verify($id_apprenti['1'], $row['mdp'])) {
            $_SESSION['id'] = $row['id_apprenti'];
            $_SESSION['compteValide'] = $row['compteValide'];
            $_SESSION['coordinateur'] = $row['coordinateur'];
            return true;
          }
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }

}

function connexionPersonnel($id_personnel)
{
    $BD = connexionBD();

  if (count($id_personnel) > 0) {
    $identiteApprentiHTML = conversionHTML($id_personnel);
    if (count($id_personnel) > 0) {
      $verificationApprenti = $BD->prepare('SELECT $ from apprenti WHERE schema = ?');
      $verificationApprenti->execute(array($id_personnel['0']));
      $BD = null;
      if ($verificationApprenti->rowCount() > 0) {
        foreach ($verificationApprenti as $row) {
          if (password_verify($id_personnel['1'], $row['mdp'])) {
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
    return false;
  }
}

function verificationPremiereInscription($PersonnelIdentite)
{
  $BD = connexionBD();

  $recherchePresence = $BD->prepare('SELECT * FROM apprenti WHERE nom = ?');
  $recherchePresence->execute(array($PersonnelIdentite['7']));
  $BD = null;
  if ($recherchePresence->rowCount() > 0) {
    return false;
  } else {
    return true;
  }
}


function envoiMail($nouveauMotDePasse)
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
  $listeApprenti = $BD->prepare('SELECT * FROM apprenti');
  $listeApprenti->execute(array());
  $BD = null;
  $resultat = [];

  foreach ($listeApprenti as $row) {
    array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom'], 'photo' => $row['photo'],'id_apprenti' => $row['id_apprenti']));
  }

  return $resultat;
}




/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES SUPERADMINS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

function inscriptionApprenti($nom, $prenom, $photo, $utilisateur)
{
  try {
    $BD = connexionBD();
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $photo = htmlspecialchars($photo);

    $BD->beginTransaction();

    $ajoutUtilisateur = $BD->prepare('INSERT INTO utilisateur(login, mdp, id_role) VALUES (?, ?, ?)');
    $ajoutUtilisateur->execute(array($utilisateur['login'], $utilisateur['mdp'], $utilisateur['id_role']));
    $id_utilisateur = $BD->lastInsertId();

    if (!empty($nom) && !empty($prenom) && !empty($photo)) {
      $ajoutApprenti = $BD->prepare('INSERT INTO apprenti(nom, prenom, photo, id_utilisateur) VALUES (?, ?, ?, ?)');
      $ajoutApprenti->execute(array($nom, $prenom, $photo, $id_utilisateur));

      $BD->commit();

      if ($ajoutApprenti->rowCount() > 0) {
        $BD = null;
        return true;
      } else {
        $BD->rollBack();
        $BD = null;
        return false;
      }
    } else {
      $BD->rollBack();
      $BD = null;
      return false;
    }
  } catch (PDOException $e) {
    $BD->rollBack();
    $BD = null;
    return false;
  }
}



function supprimerApprenti($id_apprenti)
{
  $BD = connexionBD();

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



function modifierApprenti($id_apprenti, $nom, $prenom, $photo)
{
  $BD = connexionBD();
  $id_apprenti = htmlspecialchars($id_apprenti);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $photo = htmlspecialchars($photo);
  $modifierApprenti = $BD->prepare('UPDATE apprenti SET nom = ?, prenom = ?, photo = ? where id_apprenti = ?');
  $modifierApprenti->execute(array($nom, $prenom, $photo, $id_apprenti));
  $BD = null;
  if ($modifierApprenti->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function unApprenti($id_apprenti)
{
  $BD = connexionBD();
  $id_apprenti = htmlspecialchars($id_apprenti);
  $ListeUnApprenti = $BD->prepare('SELECT * from apprenti WHERE id_apprenti= ?');
  $ListeUnApprenti->execute(array($id_apprenti));
  $BD = null;
  $resultat = [];

  foreach ($ListeUnApprenti as $row) {
    array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom'], 'photo' => $row['photo'],'id_apprenti' => $row['id_apprenti']));
  }

  return $resultat;

}

function apprentiDejaExistant($nom, $prenom)
{
  $BD = connexionBD();
  $apprentiExiste = $BD->prepare('SELECT * FROM apprenti WHERE nom = ? AND prenom  = ?');
  $apprentiExiste->execute(array($nom, $prenom));
  $BD = null;

  if ($apprentiExiste ->rowCount() > 0){
    return TRUE;
  } else {
    return false;
  }
}
/////////////////////////////////////////////////////////////////////////////
////////////////////        GESTION DES Personnel        ////////////////////
/////////////////////////////////////////////////////////////////////////////
function inscriptionPersonnel($nom, $prenom, $utilisateur)
{
  try {
    $BD = connexionBD();
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $BD->beginTransaction();

    $ajoutUtilisateur = $BD->prepare('INSERT INTO utilisateur(login, mdp, id_role) VALUES (?, ?, ?)');
    $ajoutUtilisateur->execute(array($utilisateur['login'], $utilisateur['mdp'], $utilisateur['id_role']));
    $id_utilisateur = $BD->lastInsertId();

    if (!empty($nom) && !empty($prenom)) {
      $ajoutPersonnel = $BD->prepare('INSERT INTO personnel(nom, prenom, id_utilisateur) VALUES (?, ?, ?)');
      $ajoutPersonnel->execute(array($nom, $prenom, $id_utilisateur));

      $BD->commit();

      if ($ajoutPersonnel->rowCount() > 0) {
        $BD = null;
        return true;
      } else {
        $BD->rollBack();
        $BD = null;
        return false;
      }
    } else {
      $BD->rollBack();
      $BD = null;
      return false;
    }
  } catch (PDOException $e) {
    $BD->rollBack();
    $BD = null;
    return false;
  }
}

function supprimerPersonnel($id_personnel)
{
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $suppressionPersonnel = $BD->prepare('DELETE FROM personnel WHERE id_personnel = ?');
  $suppressionPersonnel->execute(array($id_personnel));
  $BD = null;
  if ($suppressionPersonnel->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function modifierPersonnel($id_personnel, $nom, $prenom)
{
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $nom = htmlspecialchars($nom);
  $prenom = htmlspecialchars($prenom);
  $modifierPersonnel = $BD->prepare('UPDATE personnel SET nom = ? , prenom = ? where id_personnel = ?');
  $modifierPersonnel->execute(array($nom, $prenom, $id_personnel));
  $BD = null;
  if ($modifierPersonnel->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function listePersonnel()
{
  $BD = connexionBD();

  $listePersonnel = $BD->prepare('SELECT * FROM personnel');
  $listePersonnel->execute(array());
  $BD = null;
  $resultat = [];

  foreach ($listePersonnel as $row) {
    array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom'], 'id_personnel' => $row['id_personnel'], 'id_utilisateur' => $row['id_utilisateur']));
  }

  return $resultat;
}

function listeEducateur()
{
  $BD = connexionBD();

  try {
    $listePersonnel = $BD->prepare('SELECT * FROM personnel p, utilisateur u,
     role r WHERE p.id_utilisateur = u.id_utilisateur AND u.id_role = r.id_role AND r.description = "Educ Simple"');
    $listePersonnel->execute(array());
    $BD = null;
    $resultat = [];

    foreach ($listePersonnel as $row) {
      array_push($resultat, array(
        'nom' => $row['nom'],
        'prenom' =>
          $row['prenom'],
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
  $BD = connexionBD();

  try {
    $listePersonnel = $BD->prepare('SELECT * FROM personnel p,
    utilisateur u, role r WHERE p.id_utilisateur = u.id_utilisateur
    AND u.id_role = r.id_role AND r.description = "Super-Admin"');
    $listePersonnel->execute(array());
    $BD = null;
    $resultat = [];

    foreach ($listePersonnel as $row) {
      array_push($resultat, array(
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

function unPersonnel($id_personnel)
{
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $ListeUnPersonnel = $BD->prepare('SELECT * from personnel WHERE id_personnel= ?');
  $ListeUnPersonnel->execute(array($id_personnel));
  $BD = null;
  $resultat = [];

  foreach ($ListeUnPersonnel as $row) {
    array_push($resultat, array('nom' => $row['nom'], 'prenom' => $row['prenom'], 'id_personnel' => $row['id_personnel'],'id_utilisateur' => $row['id_utilisateur']));
  }

  return $resultat;

}

function personnelDejaExistant($nom, $prenom)
{
  $BD = connexionBD();
  $personnelExiste = $BD->prepare('SELECT * FROM personnel WHERE nom = ? AND prenom = ?');
  $personnelExiste->execute(array($nom, $prenom));
  $BD = null;

  if ($personnelExiste ->rowCount() > 0){
    return TRUE;
  } else {
    return false;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION FICHES            ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFiche()
{
  $BD = connexionBD();
  $listeFiche = $BD->prepare('SELECT * from fiche_intervention');
  $listeFiche->execute(array());
  $BD = null;
  $resultat = [];

  foreach($listeFiche as $row) {
    array_push($resultat, array('numero' => $row['numero'],'nom_du_demandeur' => $row['nom_du_demandeur'],'date_demande' => $row['date_demande'],'date_intervention' => $row['date_intervention'],'duree_intervention' => $row['duree_intervention'],'localisation' => $row['localisation'],'description_demande' => $row['description_demande'],'degre_urgence' => $row['degre_urgence'],'type_intervention' => $row['type_intervention'],'nature_intervention' => $row['nature_intervention'],'couleur_intervention' => $row['couleur_intervention'],'etat_fiche' => $row['etat_fiche'],'date_creation' => $row['date_creation'], 'id_fiche' => $row ['id_fiche']));
  }

  return $resultat;
}

function creationFiche($numero, $nom_du_demandeur, $date_demande, $date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation, $id_apprenti, $id_personnel) {
  $BD = connexionBD();
  $numero = htmlspecialchars($numero);
  $nom_du_demandeur = htmlspecialchars($nom_du_demandeur);
  $date_demande = htmlspecialchars($date_demande);
  $date_intervention = htmlspecialchars($date_intervention);
  $duree_intervention = htmlspecialchars($duree_intervention);
  $localisation = htmlspecialchars($localisation);
  $description_demande = htmlspecialchars($description_demande);
  $degre_urgence = htmlspecialchars($degre_urgence);
  $type_intervention = htmlspecialchars($type_intervention);
  $nature_intervention = htmlspecialchars($nature_intervention);
  $couleur_intervention = htmlspecialchars($couleur_intervention);
  $etat_fiche = htmlspecialchars($etat_fiche);
  $date_creation = htmlspecialchars($date_creation);
  $id_apprenti = htmlspecialchars($id_apprenti);
  $id_personnel = htmlspecialchars($id_personnel);

  $creerFiche = $BD->prepare('INSERT INTO fiche_intervention(numero, nom_du_demandeur, date_demande, date_intervention, duree_intervention, localisation, description_demande, degre_urgence, type_intervention, nature_intervention, couleur_intervention, etat_fiche, date_creation, id_apprenti, id_personnel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $creerFiche->execute(array($numero, $nom_du_demandeur, $date_demande, $date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation, $id_apprenti, $id_personnel));
  $BD = null;

  if ($creerFiche->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}



function supprimerFiche($id_fiche)
{
  $BD = connexionBD();
  $id_fiche = htmlspecialchars($id_fiche);
  $suppressionFiche = $BD->prepare('DELETE FROM fiche_intervention WHERE id_fiche = ?');
  $suppressionFiche->execute(array($id_fiche));
  if ($suppressionFiche->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}


function modifierFiche($id_fiche, $numero, $nom_du_demandeur, $date_demande, $date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation,$id_apprenti,$id_personnel) {
  $BD = connexionBD();
  $id_fiche = htmlspecialchars($id_fiche);
  $numero = htmlspecialchars($numero);
  $nom_du_demandeur = htmlspecialchars($nom_du_demandeur);
  $date_demande = htmlspecialchars($date_demande);
  $date_intervention = htmlspecialchars($date_intervention);
  $duree_intervention = htmlspecialchars($duree_intervention);
  $localisation = htmlspecialchars($localisation);
  $description_demande = htmlspecialchars($description_demande);
  $degre_urgence = htmlspecialchars($degre_urgence);
  $type_intervention = htmlspecialchars($type_intervention);
  $nature_intervention = htmlspecialchars($nature_intervention);
  $couleur_intervention = htmlspecialchars($couleur_intervention);
  $etat_fiche = htmlspecialchars($etat_fiche);
  $date_creation = htmlspecialchars($date_creation);
  $id_apprenti = htmlspecialchars($id_apprenti);
  $id_personnel = htmlspecialchars($id_personnel);


  $modifierFiche = $BD->prepare('UPDATE fiche_intervention SET numero = ?, nom_du_demandeur = ?, date_demande = ?, date_intervention = ?, duree_intervention = ?, localisation = ?, description_demande = ?, degre_urgence = ?, type_intervention = ?, nature_intervention = ?, couleur_intervention = ?, etat_fiche = ?, date_creation = ?, id_apprenti = ?, id_personnel = ? WHERE id_fiche = ?');

  $modifierFiche->execute(array($numero, $nom_du_demandeur, $date_demande, $date_intervention, $duree_intervention, $localisation, $description_demande, $degre_urgence, $type_intervention, $nature_intervention, $couleur_intervention, $etat_fiche, $date_creation, $id_apprenti, $id_personnel, $id_fiche));

  $BD = null;

  if ($modifierFiche->rowCount() > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function uneFicheIntervention($id_fiche)
{
  $BD = connexionBD();
  $id_fiche = htmlspecialchars($id_fiche);
  $uneFicheIntervention = $BD->prepare('SELECT * from fiche_intervention WHERE id_fiche = ?');
  $uneFicheIntervention->execute(array($id_fiche));
  $BD = null;
  $resultat = [];

  foreach($uneFicheIntervention as $row) {
    array_push($resultat, array('numero' => $row['numero'],'nom_du_demandeur' => $row['nom_du_demandeur'],'date_demande' => $row['date_demande'],'date_intervention' => $row['date_intervention'],'duree_intervention' => $row['duree_intervention'],'localisation' => $row['localisation'],'description_demande' => $row['description_demande'],'degre_urgence' => $row['degre_urgence'],'type_intervention' => $row['type_intervention'],'nature_intervention' => $row['nature_intervention'],'couleur_intervention' => $row['couleur_intervention'],'etat_fiche' => $row['etat_fiche'],'date_creation' => $row['date_creation'], 'id_fiche' => $row['id_fiche']));
  }

  return $resultat;

}

function ficheInterventionDejaExistante($numero)
{
  $BD = connexionBD();
  $numero = htmlspecialchars($numero);
  $ficheExiste = $BD->prepare('SELECT * from fiche_intervention WHERE numero = ?');
  $ficheExiste->execute(array($numero));
  $BD = null;
  if($ficheExiste->rowCount() > 0) {
    return TRUE;
  } else {
    return false;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////          GESTION DES COURS          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function ListeCours()
{
  $BD = connexionBD();
  $listeCours = $BD->prepare('SELECT * from session');
  $listeCours->execute(array());
  $BD = null;
  $resultat = [];

  foreach($listeCours as $row) {
    array_push($resultat, array('Thème' => $row['theme'],'Cours' => $row['cours'],'Durée du Cours' => $row['duree'], 'ID_Formation' => $row['id_formation']));
  }

  return $resultat;
}


function UnCours($cours)
{
  $BD = connexionBD();
  $unCours = $BD->prepare('SELECT * from session WHERE cours = ?');
  $unCours->execute(array($cours));
  $BD = null;
  $resultat = [];

  foreach($unCours as $row) {
    array_push($resultat, array('Thème' => $row['theme'],'Cours' => $row['cours'],'Durée du Cours' => $row['duree'], 'ID_Formation' => $row['id_formation']));
  }

  return $resultat;
}

function CreationCours($theme, $cours, $duree, $id_formation)
{
  $BD = connexionBD();
  $theme = htmlspecialchars($theme);
  $cours = htmlspecialchars($cours);
  $duree = htmlspecialchars($duree);
  $id_formation = htmlspecialchars($id_formation);
  $creerCours = $BD->prepare('INSERT INTO session(theme, cours, duree, id_formation) VALUES (?, ?, ?, ?)');
  $creerCours->execute(array($theme, $cours, $duree, $id_formation));
  $BD = null;
  if ($creerCours->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}


function SuppressionCours($id_session)
{
  $BD = connexionBD();
  $supprimerCours = $BD->prepare('DELETE FROM session WHERE id_session = ?');
  $supprimerCours->execute(array($id_session));
  $BD = null;
  if($supprimerCours ->rowCount() > 0) {
    return TRUE;
  } else {
    return false;
  }
}

function ModificationCours($id_session, $theme, $cours, $duree, $id_formation)
{
  $BD = connexionBD();
  $modifierCours = $BD -> prepare('UPDATE session SET theme = ?, cours = ?, duree = ? , id_formation = ? WHERE id_session = ?');
  $modifierCours ->execute(array($theme,$cours,$duree,$id_formation,$id_session)); 
  $BD = null;
  if($modifierCours -> rowCount() > 0){
    return TRUE;
  } else {
    return false;
  }
}


/////////////////////////////////////////////////////////////////////////////
////////////////////            GESTION FORMATIONS       ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFormations()
{
  $BD = connexionBD();
  $listeFormations = $BD->prepare('SELECT * from formation');
  $listeFormations->execute(array());
  $BD = null;
  $result = [];
  foreach($listeFormations as $row) {
    array_push($result,array('Intitulé de la Formation' => $row['intitule'], 'Niveau de Qualification' => $row['niveau_qualif'],'Groupe' =>$row['groupe'], 'ID de la formation' =>$row['id_formation']));
  }

  return $result;
}

function UneFormation($id_formation)
{
  $BD = connexionBD();
  $uneFormation = $BD->prepare('SELECT * FROM formation WHERE id_formation = ?');
  $uneFormation->execute(array($id_formation));
  $BD = null;
  $result = [];
  foreach($uneFormation as $row) {
    array_push($result,array('Intitulé de la Formation' => $row['intitule'], 'Niveau de Qualification' => $row['niveau_qualif'],'Groupe' =>$row['groupe']));
  }

  return $result;
}

function ajouterFormation($intitule, $niveau_qualif, $groupe)
{
  $BD = connexionBD();
  $ajoutFormation = $BD->prepare('INSERT INTO formation(intitule,niveau_qualif,groupe) VALUES (?, ?, ?)');
  $ajoutFormation->execute(array($intitule, $niveau_qualif, $groupe));
  $BD = null;
  if ($ajoutFormation -> rowCount() > 0) {
    return TRUE;
  } else {
    return false;
  }
}

function suppresionFormation($id_formation)
{
  $BD = connexionBD();
  $supprimerFormation = $BD->prepare('DELETE FROM formation WHERE id_formation = ?');
  $supprimerFormation->execute(array($id_formation));
  $BD = null;
  if ($supprimerFormation -> rowCount() > 0 ){
    return TRUE;
  } else {
    return false;
  }
}

function modifierFormation($id_formation, $intitule, $niveau_qualif, $groupe)
{
  $BD = connexionBD();
  $modifierFormation = $BD ->prepare('UPDATE formation SET intitule = ?, niveau_qualif = ?, groupe = ? WHERE id_formation = ?');
  $modifierFormation ->execute(array($intitule,$niveau_qualif,$groupe,$id_formation));
  $BD = null;
  if ($modifierFormation -> rowCount() > 0 ){
    return TRUE;
  } else {
    return false;
  }
}

function formationExisteDeja($intitule)
{
  $BD = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $formationExiste = $BD->prepare('SELECT * from formation WHERE intitule = ?');
  $formationExiste->execute(array($intitule));
  $BD = null;
  if($formationExiste->rowCount() > 0) {
    return TRUE;
  } else {
    return false;
  }
}

/////////////////////////////////////////////////////////////////////////////
////////////////////           GESTION DES PHOTOS        ////////////////////
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////
////////////////////         GESTION DES TRACES          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeTrace()
{
  $BD = connexionBD();
  $listeTrace = $BD->prepare('SELECT * FROM laisser_trace');
  $listeTrace->execute(array());
  $BD = null;
  $result = [];

   foreach($listeTrace as $row) {
      array_push($result, array('ID Personnel' =>$row['id_personnel'], 'Horodatage' =>$row['horodatage'], 'Intitulé' =>$row['intitule'],'Evaluation Textuelle' =>$row['eval_texte'],'Commentaire Textuelle' =>$row['commentaire_texte'], 'Evaluation Audio' =>$row['eval_audio'],'Commentaire Audio' => $row['commentaire_audio'], 'ID de la Fiche' =>$row['id_fiche']));
   }

  return $result;
}

function UneTrace($intitule)
{
  $BD = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $uneTrace = $BD->prepare('SELECT * FROM laisser_tracer WHERE intitule = ?');
  $uneTrace->execute(array($intitule));
  $BD = null;
  $result = [];
 
    foreach($uneTrace as $row) {
       array_push($result, array('ID Personnel' =>$row['id_personnel'], 'Horodatage' =>$row['horodatage'], 'Intitulé' =>$row['intitule'],'Evaluation Textuelle' =>$row['eval_texte'],'Commentaire Textuelle' =>$row['commentaire_texte'], 'Evaluation Audio' =>$row['eval_audio'],'Commentaire Audio' => $row['commentaire_audio'], 'ID de la Fiche' =>$row['id_fiche']));
    }
 
    return $result;
 }

function ajouterTrace($id_personnel,$horodatage,$intitule,$eval_texte,$commentaire_texte,$eval_audio,$commentaire_audio, $id_fiche) {
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $horodatage = htmlspecialchars($horodatage);
  $intitule = htmlspecialchars($intitule);
  $eval_texte = htmlspecialchars($eval_texte);
  $commentaire_texte = htmlspecialchars($commentaire_texte);
  $eval_audio = htmlspecialchars($eval_audio);
  $commentaire_audio = htmlspecialchars($commentaire_audio);
  $id_fiche = htmlspecialchars($id_fiche);

  $ajoutTrace = $BD -> prepare('INSERT INTO laisser_trace(id_personnel,horodatage,intitule,eval_texte,commentaire_texte,eval_audio,commentaire_audio,id_fiche) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
  $ajoutTrace ->execute(array($id_personnel,$horodatage,$intitule,$eval_texte,$commentaire_texte,$eval_audio,$commentaire_audio, $id_fiche));
  $BD= null;
  if ($ajoutTrace -> rowCount() > 0 ){
    return TRUE;
  } else {
    return false;
  }
}

function supprimerTrace($intitule)
{
  $BD = connexionBD();
  $intitule = htmlspecialchars($intitule);
  $suppresionTrace = $BD->prepare('DELETE INTO laisser_trace WHERE intitule = ?');
  $suppresionTrace->execute(array($intitule));
  $BD = null;

  if ($suppresionTrace -> rowCount() > 0 ) {
    return TRUE;
  } else {
    return false;
  }
}

function modificationTrace($id_personnel,$horodatage,$intitule,$eval_texte,$commentaire_texte,$eval_audio,$commentaire_audio, $id_fiche) {
  $BD = connexionBD();
  $id_personnel = htmlspecialchars($id_personnel);
  $horodatage = htmlspecialchars($horodatage);
  $intitule = htmlspecialchars($intitule);
  $eval_texte = htmlspecialchars($eval_texte);
  $commentaire_texte = htmlspecialchars($commentaire_texte);
  $eval_audio = htmlspecialchars($eval_audio);
  $commentaire_audio = htmlspecialchars($commentaire_audio);
  $id_fiche = htmlspecialchars($id_fiche);

  $modifierTrace = $BD -> prepare('UPDATE laisser_trace SET id_personnel = ?, horodatage = ?, intitule = ?, eval_texte = ?, commentaire_texte = ?, eval_audio = ?, commentaire_audio = ?, id_fiche = ?');
  $modifierTrace ->execute(array($id_personnel,$horodatage,$intitule,$eval_texte,$commentaire_texte,$eval_audio,$commentaire_audio, $id_fiche));
  $BD = null;
  if ($modifierTrace -> rowCount() > 0){
    return TRUE;
  } else {
    return false;
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


