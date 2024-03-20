<?php
use PHPUnit\Framework\TestCase;

require_once '../../APIFinale/fonctions.php';

class DatabaseTest extends TestCase
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

 
}
