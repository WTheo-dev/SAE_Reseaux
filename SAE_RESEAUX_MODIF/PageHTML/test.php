<?php
use PHPUnit\Framework\TestCase;

require_once '../../APIFinale/fonctions.php';

class Test extends TestCase
{
    public function testConnexionBD()
    {
        
        $this->assertInstanceOf(PDO::class, connexionBD());
    }

    public function testIdentification()
    {
        // On créer un utilisateur
        $login = 'utilisateur1';
        $mdp = 'motdepasse1';
        $this->createTestUser($login, $mdp);

        // On test l'identification avec les informations correctes
        $this->assertTrue(identification($login, $mdp));

        // On test l'identification avec des informations incorrectes
        $this->assertFalse(identification('utilisateur_invalide', 'mot_de_passe_invalide'));

        // on le supprime
        $this->deleteTestUser($login);
    }

    public function testRecuperationRole()
    {
        // On créer un utilisateur avec le role 1
        $login = 'utilisateur1';
        $mdp = 'motdepasse1';
        $id_role_attendu = 1; 
        $this->createTestUser($login, $mdp, $id_role_attendu);

        // On test la récupération du rôle pour l'utilisateur créé
        $this->assertEquals($id_role_attendu, recuperationRole($login));

        // on le supprime
        $this->deleteTestUser($login);
    }

    private function createTestUser($login, $mdp, $id_role = 1)
    {
        // on fait la commande pour créer un utilisateur
        $bd = connexionBD();
        $insertionUtilisateur = $bd->prepare('INSERT INTO utilisateur (login, mdp, id_role) VALUES (?, ?, ?)');
        $insertionUtilisateur->execute([$login, $mdp, $id_role]);
    }

    private function deleteTestUser($login)
    {
        // on fait la commande pour supprimer un utilisateur
        $bd = connexionBD();
        $suppressionUtilisateur = $bd->prepare('DELETE FROM utilisateur WHERE login = ?');
        $suppressionUtilisateur->execute([$login]);
    }

    public function testLoginId()
    {
        // On test lorsque l'ID utilisateur existe
        $idUtilisateurExistant = 2;
        $this->assertEquals('utilisateur2', loginId($idUtilisateurExistant));

        // On test lorsque l'ID utilisateur n'existe pas
        $idUtilisateurInexistant = 9999;
        $this->assertFalse(loginId($idUtilisateurInexistant));
    }

    public function testIdLogin()
    {
        // On test lorsque le login existe
        $loginExistant = 'utilisateur2'; //
        $this->assertEquals(2, idLogin($loginExistant));

        // On test lorsque le login n'existe pas
        $loginInexistant = 'login_inexistant';
        $this->assertFalse(idLogin($loginInexistant));
    }


    public function testGetUtilisateur()
    {
        // On test lorsque l'ID utilisateur existe
        $idUtilisateurExistant = 2;
        $this->assertIsArray(getUtilisateur($idUtilisateurExistant));

        // Test lorsque l'ID utilisateur n'existe pas
        $idUtilisateurInexistant = 9999;
        $this->assertFalse(getUtilisateur($idUtilisateurInexistant));
    }

    public function testConversionHTML()
    {
        // Tableau d'entrée
        $inputArray = ['<p>Hello</p>', '<script>alert("XSS Attack");</script>', 'Normal text'];

        // Appel de la fonction à tester
        $convertedArray = conversionHTML($inputArray);

        // Assertion
        $expectedArray = ['&lt;p&gt;Hello&lt;/p&gt;', '&lt;script&gt;alert(&quot;XSS Attack&quot;);&lt;/script&gt;',
        'Normal text'];
        $this->assertEquals($expectedArray, $convertedArray);
    }

    public function testListeApprenti()
    {
    
        // On test la fonction listeApprenti pour vérifier si elle retourne un tableau non vide
        $resultat = listeApprenti();
        $this->assertNotEmpty($resultat);

        // On test si chaque élément du tableau contient les clés 'nom', 'prenom', 'photo' et 'id_apprenti'
        foreach ($resultat as $apprenti) {
            $this->assertArrayHasKey('nom', $apprenti);
            $this->assertArrayHasKey('prenom', $apprenti);
            $this->assertArrayHasKey('photo', $apprenti);
            $this->assertArrayHasKey('id_apprenti', $apprenti);
        }
    }

    public function testListePersonnel()
    {
    
        // On teste la fonction listePersonnel pour vérifier si elle retourne un tableau non vide
        $resultat = listePersonnel();
        $this->assertNotEmpty($resultat);

        // On test si chaque élément du tableau contient les clés attendues
        foreach ($resultat as $personnel) {
            $this->assertArrayHasKey('nom', $personnel);
            $this->assertArrayHasKey('prenom', $personnel);
            $this->assertArrayHasKey('id_personnel', $personnel);
            $this->assertArrayHasKey('id_utilisateur', $personnel);
        }
    }

    public function testListeEducateur()
    {
    
        // On test la fonction listeEducateur pour vérifier si elle retourne un tableau non vide
        $resultat = listeEducateur();
        $this->assertNotEmpty($resultat);

        // On test si chaque élément du tableau contient les clés attendues
        foreach ($resultat as $educateur) {
            $this->assertArrayHasKey('nom', $educateur);
            $this->assertArrayHasKey('prenom', $educateur);
            $this->assertArrayHasKey('id_personnel', $educateur);
            $this->assertArrayHasKey('id_utilisateur', $educateur);
        }
    }

    public function testListeSuperAdmin()
    {
    
        // On test la fonction listeSuperAdmin pour vérifier si elle retourne un tableau non vide
        $resultat = listeSuperAdmin();
        $this->assertNotEmpty($resultat);

        // On test si chaque élément du tableau contient les clés attendues
        foreach ($resultat as $superAdmin) {
            $this->assertArrayHasKey('nom', $superAdmin);
            $this->assertArrayHasKey('prenom', $superAdmin);
            $this->assertArrayHasKey('id_personnel', $superAdmin);
            $this->assertArrayHasKey('id_utilisateur', $superAdmin);
        }
    }

    public function testListeFiche()
    {
    
        // On test si la fonction listeFiche pour vérifier si elle retourne un tableau non vide
        $resultat = listeFiche();
        $this->assertNotEmpty($resultat);

        // On test si chaque élément du tableau contient les clés attendues
        foreach ($resultat as $fiche) {
            $this->assertArrayHasKey('numero', $fiche);
            $this->assertArrayHasKey('nom_du_demandeur', $fiche);
            $this->assertArrayHasKey('date_demande', $fiche);
            $this->assertArrayHasKey('date_intervention', $fiche);
            $this->assertArrayHasKey('duree_intervention', $fiche);
            $this->assertArrayHasKey('localisation', $fiche);
            $this->assertArrayHasKey('description_demande', $fiche);
            $this->assertArrayHasKey('degre_urgence', $fiche);
            $this->assertArrayHasKey('type_intervention', $fiche);
            $this->assertArrayHasKey('nature_intervention', $fiche);
            $this->assertArrayHasKey('couleur_intervention', $fiche);
            $this->assertArrayHasKey('etat_fiche', $fiche);
            $this->assertArrayHasKey('date_creation', $fiche);
            $this->assertArrayHasKey('id_fiche', $fiche);
        }
    }


    public function testApprentiConnexionReussieAvecIdentifiantsValides()
    {
        // Appel de la fonction à tester
        $resultat = connexionApprenti('2', 'motdepasse2');
        
        // Vérifier si la connexion a réussi
        $this->assertTrue($resultat);
    }

    // Test de connexion échouée avec un mot de passe invalide
    public function testApprentiConnexionEchoueeAvecMotDePasseInvalide()
    {
        $resultat = connexionApprenti('1', 'motdepasse45');
       
        // Vérifier si la connexion a échoué
        $this->assertFalse($resultat);
    }

    // Test de connexion échouée avec des identifiants vides
    public function testApprentiConnexionEchoueeAvecIdentifiantsVides()
    {

        $resultat = connexionApprenti('', '');
        
        // Vérifier si la connexion a échoué
        $this->assertFalse($resultat);
    }

    public function testPersonnelConnexionReussieAvecIdentifiantsValides()
    {
        // Appel de la fonction à tester
        $resultat = connexionPersonnel('1', 'motdepasse3');
        
        // Vérifier si la connexion a réussi
        $this->assertTrue($resultat);
    }

    // Test de connexion échouée avec un mot de passe invalide
    public function testPersonnelConnexionEchoueeAvecMotDePasseInvalide()
    {
        $resultat = connexionPersonnel('1', 'motdepasse45');
       
        // Vérifier si la connexion a échoué
        $this->assertFalse($resultat);
    }

    // Test de connexion échouée avec des identifiants vides
    public function testPersonnelConnexionEchoueeAvecIdentifiantsVides()
    {

        $resultat = connexionPersonnel('', '');
        
        // Vérifier si la connexion a échoué
        $this->assertFalse($resultat);
    }


    public function testSaltHash()
{
    
    // Définissez un mot de passe à utiliser pour le test
    $motDePasse = "motdepasse123";

    // Appelez la fonction saltHash avec le mot de passe défini
    $motDePasseHashe = saltHash($motDePasse);

    // Vérifiez si le mot de passe hashé est une chaîne non vide
    $this->assertNotEmpty($motDePasseHashe);

    // Vérifiez si le mot de passe hashé est une chaîne
    $this->assertIsString($motDePasseHashe);

    // Vérifiez si le mot de passe hashé est différent du mot de passe d'origine
    $this->assertNotEquals($motDePasse, $motDePasseHashe);
}

public function testInscriptionApprenti()
{
   // On ajoute un apprenti
    $nom = "Doef";
    $prenom = "Johnt";
    $photo = "johny_doef.jpg";
    $utilisateur = array(
        'login' => 'johnt.doef',
        'mdp' => 'password1234',
        'id_role' => 1 // role de l'apprenti
    );

    // Appelez la fonction d'inscription avec les valeurs définies
    $resultatInscription = inscriptionApprenti($nom, $prenom, $photo, $utilisateur);

    // Vérifiez si l'inscription a réussi
    $this->assertTrue($resultatInscription > 0);

}

public function testSupprimerApprenti()
{
   
    // On créer un apprenti
    $u['login'] = "login_test";
    $u['mdp'] = "test_mdp";
    $u['id_role'] = 1;
    $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u); // Remplacez par l'ID de l'apprenti à supprimer dans votre base de données

    // Appelez la fonction de suppression avec l'ID de l'apprenti
    $resultatSuppression = supprimerApprenti($idApprenti);

    // Vérifiez si l'apprenti a été supprimé avec succès
    $this->assertTrue(($resultatSuppression > 0));
}

public function testModifierApprenti()
{
    // On créer un apprenti
    $u['login'] = "login_test";
    $u['mdp'] = "test_mdp";
    $u['id_role'] = 1;
    $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u); // Remplacez par l'ID de l'apprenti à supprimer dans votre base de données

    // Définissez de nouvelles valeurs pour le nom, le prénom et la photo de l'apprenti
    $nouveauNom = "NouveauNom";
    $nouveauPrenom = "NouveauPrenom";
    $nouvellePhoto = "nouvelle_photo.jpg";

    // Appelez la fonction pour modifier l'apprenti
    $resultatModification = modifierApprenti($idApprenti, $nouveauNom, $nouveauPrenom, $nouvellePhoto);

    // Vérifiez si la modification a été effectuée avec succès
    $this->assertTrue($resultatModification);

}


public function testUnApprenti()
{
    // On créer un apprenti
    $u['login'] = "login_test";
    $u['mdp'] = "test_mdp";
    $u['id_role'] = 1;
    $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u); // Remplacez par l'ID de l'apprenti à supprimer dans votre base de données
    
    // Appelez la fonction pour obtenir les informations sur un apprenti
    $infosApprenti = unApprenti($idApprenti);

    // Vérifiez si les informations ont été récupérées avec succès
    $this->assertNotEmpty($infosApprenti);

    $this->assertTrue($infosApprenti['nom'] == "test_nom");
    $this->assertTrue($infosApprenti['prenom'] == "test_prenom");
    $this->assertTrue($infosApprenti['photo'] == "test_photo");
    
}

public function testApprentiDejaExistant()
{
    $nomExistant = 'test_nom';
    $prenomExistant = 'test_prenom';
    
    $u['login'] = "login_test";
    $u['mdp'] = "test_mdp";
    $u['id_role'] = 1;
    $idApprenti = inscriptionApprenti($nomExistant, $prenomExistant, "test_photo", $u); // Remplacez par l'ID de l'apprenti à supprimer dans votre base de données
   

    // Appelez la fonction pour vérifier si l'apprenti existe déjà
    $existeDeja = apprentiDejaExistant($nomExistant, $prenomExistant);

    // Vérifiez si l'apprenti existe déjà dans la base de données
    $this->assertTrue($existeDeja);
}

public function testAjouterEducateur()
{
    
    // Définissez des valeurs pour les paramètres de la fonction
    $nom = 'NomTest';
    $prenom = 'PrenomTest';
    $mdp = 'MotDePasseTest';
    $type = 'TypeTest';
    $num = 'NumTest';

    // Appelez la fonction pour ajouter un éducateur
    $resultat = ajouterEducateur($nom, $prenom, $mdp, $type, $num);

    // Vérifiez si l'ajout a réussi en vérifiant si le nombre de lignes affectées est supérieur à 0
    $this->assertTrue($resultat);
}




}
