<?php

/////////////////////////////////////////////////////////////////////////////
////////////////////   CONNEXION A LA BASE DE DONNEES   ////////////////////
/////////////////////////////////////////////////////////////////////////////

function connexionBD(){
    $SERVER = '127.0.0.1';
    $BD = 'apeaj';
    $LOGIN = 'root';
    $MDP = '';

    try{
        $BD = new PDO("mysql:host=$SERVER;dbname=$BD",$LOGIN,$MDP);
    }catch(PDOException $e){
        die('Erreur : '.$e->getMessage());
    }
    return $BD;
}

 function identification($login, $password){
    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $BD = connexionBD();
    $verificationMembre = $BD->prepare('SELECT * FROM utilisateur WHERE nom_utilisateur = ? AND mot_de_passe = ?');
    $verificationMembre->execute(array($login, $password));
    $BD = null;
    if($verificationMembre->rowCount() > 0){
        return TRUE;
    }else{
        return FALSE;
   } 
}

function  recuperation_role($login)  {
    $BD = connexionBD();
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
////////////////////         GESTION DES FICHES          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function listeFiche() {
    $BD = connexionBD();
    $listeFiche = $BD ->prepare('SELECT * from fiche_intervention');
    $listeFiche->execute(array());
    $BD = null;
    if($listeFiche->rowCount() > 0){
        return TRUE;
    } else{
        return FALSE;
    }
}

function lireFiche() {
    $BD = connexionBD();
    $lireFiche = $BD -> prepare('');
    $lireFiche ->execute(array());
    $BD = null;
    if($lireFiche->rowCount() > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}

function modifierFiche() {
    $BD = connexionBD();
    $modifierFiche = $BD -> prepare('UPDATE * into fiche_intervention');
    $modifierFiche -> execute(array());
    $BD = null;
    if($modifierFiche->rowCount() > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}

function rechercheFiche() {
    $BD = connexionBD();
}

function creerFiche() {

}



/////////////////////////////////////////////////////////////////////////////
////////////////////          GESTION DES APPRENTIS      ////////////////////
/////////////////////////////////////////////////////////////////////////////

function liste_apprenti() {
    $BD = connexionBD();
    $listeApprenti = $BD -> prepare('SELECT * from apprenti');
    $listeApprenti -> execute(array());
    $BD = null;
    if($listeApprenti->rowCount() > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}

function creerApprenti() {
    $BD = connexionBD();
    $newApprenti = $BD -> prepare('INSERT INTO apprenti ');
    $newApprenti -> execute(array());
    $BD = null;
    if($newApprenti->rowCount() > 0){
        return TRUE;
    } else {
        return FALSE;
    }
}


function majApprenti() {
    $BD = connexionBD();
    $modifApprenti = $BD -> prepare('UPDATE apprenti');
}

function supprimerApprenti() {
    $BD = connexionBD();
    $removeApprenti = $BD -> prepare('DELETE INTO apprenti ');
    $removeApprenti -> execute(array());
    $BD = null;
    if($removeApprenti->rowCount() > 0){
        return TRUE;
    } else  {
        return FALSE;
    }
}

function recuperationSchema() {
    $BD = connexionBD();
}

function associationSchemaAvecApprenti() {
    $BD = connexionBD();
}

function checkPermissions() {
    $BD = connexionBD();
}


/////////////////////////////////////////////////////////////////////////////
////////////////////         GESTION DES ADMINS          ////////////////////
/////////////////////////////////////////////////////////////////////////////

function ajouterAdmin() {
    $BD = connexionBD();
    $newAdmin = $BD -> prepare('INSERT INTO ');
}

function loginAdmin() {
    $BD = connexionBD();
}

/////////////////////////////////////////////////////////////////////////////
////////////////////             GESTION API             ////////////////////
/////////////////////////////////////////////////////////////////////////////


function deliver_response($status, $status_message, $data){
	header("HTTP/1.1 $status $status_message");
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	$json_response = json_encode($response);
	echo $json_response;
}

function get_body_token(string $bearer_token) : array{
    $tokenParts = explode('.', $bearer_token);
    $payload = base64_decode($tokenParts[1]);
    return (array) json_decode($payload);
}

function is_connected() : void{
	if (1 == 2) {
		throw new ExceptionLoginRequire();
	}
}

//function action_permited(string $action, string $ressource, int $id = null) : void
function action_permited() : void{
	if (1 == 2) {
		throw new ExceptionIssuficiantPermission();
	}
}
?>