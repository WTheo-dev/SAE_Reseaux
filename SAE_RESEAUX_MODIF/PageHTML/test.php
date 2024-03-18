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
        // Créer un utilisateur de test dans la base de données
        $login = 'utilisateur1';
        $mdp = 'motdepasse1';
        $this->createTestUser($login, $mdp);

        // Tester l'identification avec les informations correctes
        $this->assertTrue(identification($login, $mdp));

        // Tester l'identification avec des informations incorrectes
        $this->assertFalse(identification('utilisateur_invalide', 'mot_de_passe_invalide'));

        // Nettoyer les données de test après les tests
        $this->deleteTestUser($login);
    }

    public function testRecuperationRole()
    {
        // Créer un utilisateur de test dans la base de données
        $login = 'utilisateur_test';
        $mdp = 'mot_de_passe_test';
        $id_role_attendu = 1; // Remplacer par le rôle attendu dans votre base de données
        $this->createTestUser($login, $mdp, $id_role_attendu);

        // Tester la récupération du rôle pour l'utilisateur créé
        $this->assertEquals($id_role_attendu, recuperationRole($login));

        // Nettoyer les données de test après les tests
        $this->deleteTestUser($login);
    }

    // Fonction pour créer un utilisateur de test dans la base de données
    private function createTestUser($login, $mdp, $id_role = 1)
    {
        $bd = connexionBD();
        $insertionUtilisateur = $bd->prepare('INSERT INTO utilisateur (login, mdp, id_role) VALUES (?, ?, ?)');
        $insertionUtilisateur->execute([$login, $mdp, $id_role]);
    }

    // Fonction pour supprimer un utilisateur de test de la base de données
    private function deleteTestUser($login)
    {
        $bd = connexionBD();
        $suppressionUtilisateur = $bd->prepare('DELETE FROM utilisateur WHERE login = ?');
        $suppressionUtilisateur->execute([$login]);
    }


    public function testLoginId()
    {
        // Test lorsque l'ID utilisateur existe
        $idUtilisateurExistant = 1; // Remplacez 1 par un ID utilisateur existant dans votre base de données
        $this->assertEquals('login_attendu', loginId($idUtilisateurExistant)); // Remplacez 'login_attendu' par le login attendu

        // Test lorsque l'ID utilisateur n'existe pas
        $idUtilisateurInexistant = 9999; // Remplacez 9999 par un ID utilisateur qui n'existe pas dans votre base de données
        $this->assertFalse(loginId($idUtilisateurInexistant));
    }

    public function testIdLogin()
    {
        // Test lorsque le login existe
        $loginExistant = 'login_existant'; // Remplacez 'login_existant' par un login existant dans votre base de données
        $this->assertEquals('id_attendu', idLogin($loginExistant)); // Remplacez 'id_attendu' par l'ID utilisateur attendu

        // Test lorsque le login n'existe pas
        $loginInexistant = 'login_inexistant'; // Remplacez 'login_inexistant' par un login qui n'existe pas dans votre base de données
        $this->assertFalse(idLogin($loginInexistant));
    }

    public function testGetUtilisateur()
    {
        // Test lorsque l'ID utilisateur existe
        $idUtilisateurExistant = 1; // Remplacez 1 par un ID utilisateur existant dans votre base de données
        $this->assertIsArray(getUtilisateur($idUtilisateurExistant));

        // Test lorsque l'ID utilisateur n'existe pas
        $idUtilisateurInexistant = 9999; // Remplacez 9999 par un ID utilisateur qui n'existe pas dans votre base de données
        $this->assertFalse(getUtilisateur($idUtilisateurInexistant));
    }


    public function testConversionHTML()
    {
        $tableauAConvertir = ['<script>alert("XSS")</script>', 'test', '123'];
        $tableauAttendu = ['&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', 'test', '123'];
        $this->assertEquals($tableauAttendu, conversionHTML($tableauAConvertir));
    }

    public function testConnexionApprenti()
    {
        // Vous devez fournir un identifiant d'apprenti existant et un mot de passe valide pour le test
        $idApprentiExistant = [1, 'mot_de_passe']; // Remplacez 1 par un ID d'apprenti existant dans votre base de données
        $this->assertTrue(connexionApprenti($idApprentiExistant));

        // Test lorsque l'identifiant d'apprenti ou le mot de passe est incorrect
        $idApprentiInexistant = [9999, 'mot_de_passe']; // Remplacez 9999 par un ID d'apprenti qui n'existe pas dans votre base de données
        $this->assertFalse(connexionApprenti($idApprentiInexistant));
    }

    public function testConnexionPersonnel()
    {
        // Vous devez fournir un identifiant de personnel existant et un mot de passe valide pour le test
        $idPersonnelExistant = ['identifiant', 'mot_de_passe']; // Remplacez 'identifiant' par un identifiant de personnel existant dans votre base de données
        $this->assertTrue(connexionPersonnel($idPersonnelExistant));

        // Test lorsque l'identifiant de personnel ou le mot de passe est incorrect
        $idPersonnelInexistant = ['identifiant_inexistant', 'mot_de_passe']; // Remplacez 'identifiant_inexistant' par un identifiant qui n'existe pas dans votre base de données
        $this->assertFalse(connexionPersonnel($idPersonnelInexistant));
    }

    public function testSaltHash()
    {
        // Test de la fonction de hashage du mot de passe
        $motDePasse = 'password';
        $hashAttendu = saltHash($motDePasse);
        $this->assertNotEquals($motDePasse, $hashAttendu);
        $this->assertTrue(password_verify($motDePasse . 'BrIc3 4rNaUlT 3sT &$ Le MeIlLeUr d3s / pRoFesSeUrs DU.Mond3 !', $hashAttendu));
    }

    public function testValidationMdp()
    {
        // Test de la validation du mot de passe
        $mdpValide = 'password';
        $mdpInvalide = '1234';
        $this->assertNotFalse(validationMdp($mdpValide, $mdpValide));
        $this->assertFalse(validationMdp($mdpInvalide, $mdpInvalide));
    }

    public function testResetPassword()
    {
        // Vous devez fournir un identifiant valide pour tester la réinitialisation du mot de passe
        $idMembre = 1; // Remplacez 1 par un ID valide de membre dans votre base de données
        $this->expectOutputString('');
        resetPassword($idMembre);
    }

    public function testVerificationPremiereInscription()
    {
        // Test de la vérification de la première inscription
        $personnelIdentite = ['nom' => 'John']; // Remplacez 'John' par un nom de personnel existant ou non dans votre base de données
        $this->assertEquals(true, verificationPremiereInscription($personnelIdentite));
    }

    public function testEnvoiMail()
    {
        // Vous devez fournir un nouveau mot de passe valide pour tester l'envoi de mail
        $nouveauMotDePasse = 'nouveau_mot_de_passe';
        $this->expectOutputString('');
        envoiMail($nouveauMotDePasse);
    }

    public function testClean()
    {
        // Test de la fonction de nettoyage des champs
        $champSale = '<script>alert("XSS")</script>';
        $champNettoye = '&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;';
        $this->assertEquals($champNettoye, clean($champSale));
    }
}
