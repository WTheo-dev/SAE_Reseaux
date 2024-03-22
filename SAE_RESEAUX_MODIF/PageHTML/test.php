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
        $idRoleAttendu = 1;
        $this->createTestUser($login, $mdp, $idRoleAttendu);

        // On test la récupération du rôle pour l'utilisateur créé
        $this->assertEquals($idRoleAttendu, recuperationRole($login));

        // on le supprime
        $this->deleteTestUser($login);
    }

    private function createTestUser($login, $mdp, $idRole = 1)
    {
        // on fait la commande pour créer un utilisateur
        $bd = connexionBD();
        $insertionUtilisateur = $bd->prepare('INSERT INTO utilisateur (login, mdp, id_role) VALUES (?, ?, ?)');
        $insertionUtilisateur->execute([$login, $mdp, $idRole]);
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
        // Définissez des valeurs pour les paramètres de la fonction
        $nom = 'NomTestLolCoucou';
        $prenom = 'PrenomTest';
        $utilisateur = array(
            'login' => 'loginTest',
            'mdp' => 'motdepasse3',
            'id_role' => '1'
        );

    // Appelez la fonction pour inscrire du personnel
    $idPersonnel = inscriptionPersonnel($nom, $prenom, $utilisateur);
        // Appel de la fonction à tester
        $resultat = connexionPersonnel($idPersonnel, 'motdepasse3');
        
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
        $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u);

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
        $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u);

        // on met les nouvelles valeurs
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
        $idApprenti = inscriptionApprenti("test_nom", "test_prenom", "test_photo", $u);
    
        // Appelez la fonction pour obtenir les informations sur un apprenti
        $infosApprenti = unApprenti($idApprenti);

        // Vérifiez si les informations ont été récupérées avec succès
        $this->assertNotEmpty($infosApprenti);

        $this->assertEquals("test_nom", $infosApprenti['nom']);
        $this->assertEquals("test_prenom", $infosApprenti['prenom']);
        $this->assertEquals("test_photo", $infosApprenti['photo']);

    
    }

    public function testApprentiDejaExistant()
    {
        $nomExistant = 'test_nom';
        $prenomExistant = 'test_prenom';
    
        $u['login'] = "login_test";
        $u['mdp'] = "test_mdp";
        $u['id_role'] = 1;
        inscriptionApprenti($nomExistant, $prenomExistant, "test_photo", $u);
   

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

    public function testInscriptionPersonnel()
    {
   
        // Définissez des valeurs pour les paramètres de la fonction
        $nom = 'NomTestLolCoucou';
        $prenom = 'PrenomTest';
        $utilisateur = array(
            'login' => 'loginTest',
            'mdp' => 'MotDePasseTest',
            'id_role' => '1'
        );

        // Appelez la fonction pour inscrire du personnel
        $resultat = inscriptionPersonnel($nom, $prenom, $utilisateur);

        // Vérifiez si l'inscription a réussi en vérifiant si le résultat est vrai
        $this->assertTrue($resultat > 0);
    }

    public function testSupprimerPersonnel()
    {
        // Définissez des valeurs pour les paramètres de la fonction
        $nom = 'NomTestLolCoucou';
        $prenom = 'PrenomTest';
        $utilisateur = array(
            'login' => 'loginTest',
            'mdp' => 'MotDePasseTest',
            'id_role' => '1'
        );

        $idPersonnel = inscriptionPersonnel($nom, $prenom, $utilisateur);

    
        // Appelez la fonction pour supprimer le personnel
        $resultatSuppression = supprimerPersonnel($idPersonnel);

        // Vérifiez si la suppression a réussi en vérifiant si le résultat est vrai
        $this->assertTrue($resultatSuppression > 0);
    }

    public function testModifierPersonnel()
    {
        // Définissez des valeurs pour les paramètres de la fonction
        $nom = 'NomTestLolCoucou';
        $prenom = 'PrenomTest';
        $utilisateur = array(
            'login' => 'loginTest',
            'mdp' => 'MotDePasseTest',
            'id_role' => '1'
        );

        $idPersonnel = inscriptionPersonnel($nom, $prenom, $utilisateur);

        // Définissez de nouvelles valeurs pour le nom, le prénom et la photo de l'apprenti
        $nouveauNom = "NouveauNom";
        $nouveauPrenom = "NouveauPrenom";

        // Appelez la fonction pour modifier l'apprenti
        $resultatModification = modifierPersonnel($idPersonnel, $nouveauNom, $nouveauPrenom);

        // Vérifiez si la modification a été effectuée avec succès
        $this->assertTrue($resultatModification > 0);

    }

    public function testCreationFiche()
    {
        $numero = "4"; // Remplacez "123" par le numéro de la fiche
        $nomDuDemandeur = "Maxou Doe"; // Remplacez "John Doe" par le nom du demandeur
        $dateDemande = "2024-03-17"; // Remplacez "2024-03-17" par la date de la demande
        $dateIntervention = "2024-03-18"; // Remplacez "2024-03-18" par la date d'intervention
        $dureeIntervention = "2 heures"; // Remplacez "2 heures" par la durée de l'intervention
        $localisation = "Lieu"; // Remplacez "Lieu" par la localisation de l'intervention
        $descriptionDemande = "Description"; // Remplacez "Description" par la description de la demande
        $degreUrgence = "Haute"; // Remplacez "Haute" par le degré d'urgence
        $typeIntervention = "Type"; // Remplacez "Type" par le type d'intervention
        $natureIntervention = "Nature"; // Remplacez "Nature" par la nature de l'intervention
        $travauxRealises = "Travaux réalisés"; // Remplacez "Travaux réalisés" par les travaux réalisés
        $travauxNonRealises = "Travaux non réalisés"; // Remplacez "Travaux non réalisés" par les travaux non réalisés
        $couleurIntervention = "Couleur"; // Remplacez "Couleur" par la couleur de l'intervention
        $etatFiche = "En cours"; // Remplacez "En cours" par l'état de la fiche
        $dateCreation = "2024-03-17"; // Remplacez "2024-03-17" par la date de création de la fiche
        $idApprenti = 11; // Remplacez 1 par l'ID de l'apprenti
        $idPersonnel = 2; // Remplacez 1 par l'ID du personnel

        // Appeler la fonction pour créer une nouvelle fiche et récupérer son ID
        $idNouvelleFiche = creationFiche(
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
        );

        // Vérifier si la création de la fiche a réussi en vérifiant si l'ID est valide
        $this->assertNotEmpty($idNouvelleFiche);

        // Retourner l'ID de la fiche pour une utilisation dans d'autres tests
        return $idNouvelleFiche;
    }

    public function testSupprimerFiche()
    {

        // Appel de la fonction testCreationFiche pour obtenir l'ID de la fiche créée
        $idFiche = $this->testCreationFiche();

        // Vérification que l'ajout de la fiche s'est bien déroulé en vérifiant si l'ID n'est pas vide
        $this->assertNotEmpty($idFiche);

        // Appel de la fonction pour supprimer la fiche à partir de son ID
        $resultatSuppression = supprimerFiche($idFiche);

        // Vérification si la suppression a réussi en vérifiant si le résultat est vrai
        $this->assertTrue($resultatSuppression);
    }

    public function testModifierFiche()
    {
        // Création d'une nouvelle fiche d'intervention pour la modifier ensuite
        $idFiche = $this->testCreationFiche();

        // Vérification que la création de la fiche s'est bien déroulée
        $this->assertNotEmpty($idFiche);

        // Paramètres de modification de la fiche
        $numero = "58"; // Nouveau numéro de fiche
        $nomDuDemandeur = "Jane Doe"; // Nouveau nom du demandeur
        $dateDemande = "2024-03-18"; // Nouvelle date de demande
        $dateIntervention = "2024-03-19"; // Nouvelle date d'intervention
        $dureeIntervention = "3 heures"; // Nouvelle durée de l'intervention
        $localisation = "Nouveau lieu"; // Nouvelle localisation
        $descriptionDemande = "Nouvelle description"; // Nouvelle description de la demande
        $degreUrgence = "Moyenne"; // Nouveau degré d'urgence
        $typeIntervention = "Nouveau type"; // Nouveau type d'intervention
        $natureIntervention = "Nouvelle nature"; // Nouvelle nature de l'intervention
        $travauxRealises = "Nouveaux travaux réalisés"; // Nouveaux travaux réalisés
        $travauxNonRealises = "Nouveaux travaux non réalisés"; // Nouveaux travaux non réalisés
        $couleurIntervention = "Nouvelle couleur"; // Nouvelle couleur de l'intervention
        $etatFiche = "Terminée"; // Nouvel état de la fiche
        $dateCreation = "2024-03-18"; // Nouvelle date de création de la fiche
        $idApprenti = 12; // Nouvel ID de l'apprenti
        $idPersonnel = 3; // Nouvel ID du personnel

        // Appel de la fonction pour modifier la fiche avec les nouveaux paramètres
        $resultatModification = modifierFiche(
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
        );

        // Vérification si la modification de la fiche a réussi en vérifiant si le résultat retourné est vrai
        $this->assertTrue($resultatModification);
    }

    public function testUneFicheIntervention()
    {
        // Création d'une nouvelle fiche d'intervention
        $idFiche = $this->testCreationFiche();

        // Appel de la fonction uneFicheIntervention pour obtenir les détails de la fiche créée
        $ficheDetails = uneFicheIntervention($idFiche);

        // Vérification que la fonction a retourné des détails de la fiche
        $this->assertNotEmpty($ficheDetails);

    }

    public function testFicheInterventionDejaExistante()
    {
        // Création d'une nouvelle fiche d'intervention
        $idFiche = $this->testCreationFiche();
    
        // Obtention du numéro de la fiche créée
        $ficheDetails = uneFicheIntervention($idFiche);
        $numeroFiche = $ficheDetails[0]['numero'];

        // Vérification que la fonction retourne true pour une fiche existante
        $this->assertTrue(ficheInterventionDejaExistante($numeroFiche));

        // Vérification que la fonction retourne false pour une fiche inexistante
        $this->assertFalse(ficheInterventionDejaExistante('numero_inexistant'));
    }

    public function testCreationCours()
    {
        // Paramètres du cours
        $theme = "cours";
        $cours = "Contenu du cours";
        $duree = "2 heures";
        $idFormation = 1;

        // Appel de la fonction pour créer un nouveau cours
        $idCours = creationCours($theme, $cours, $duree, $idFormation);

        // Vérification que la création du cours a réussi en vérifiant si l'ID est un entier positif
        $this->assertGreaterThan(0, $idCours);
    }



    public function testListeCours()
    {
        // Appel de la fonction pour récupérer la liste des cours
        $listeCours = listeCours();

        // Vérification que la liste des cours n'est pas vide
        $this->assertNotEmpty($listeCours);

        // Vérification que la structure de chaque cours dans la liste est correcte
        foreach ($listeCours as $cours) {
            $this->assertArrayHasKey('Thème', $cours);
            $this->assertArrayHasKey('Cours', $cours);
            $this->assertArrayHasKey('Durée du Cours', $cours);
            $this->assertArrayHasKey('ID_Formation', $cours);
        }
    }

    public function testUnCours()
    {
        // Supposons que le cours 'PHP Basics' existe dans la base de données
        $cours = 'Contenu du cours';

        // Appel de la fonction pour récupérer les détails du cours
        $detailsCours = unCours($cours);

        // Vérification que les détails du cours sont retournés
        $this->assertNotEmpty($detailsCours);

        // Vérification que les détails du cours ont la structure attendue
        foreach ($detailsCours as $details) {
            $this->assertArrayHasKey('Thème', $details);
            $this->assertArrayHasKey('Cours', $details);
            $this->assertArrayHasKey('Durée du Cours', $details);
            $this->assertArrayHasKey('ID_Formation', $details);
        }
    }

    public function testSuppressionCours()
    {
        // Créer un cours avant de le supprimer
        $theme = "Web Development";
        $cours = "HTML Basics";
        $duree = "2 heures";
        $idFormation = 1; // Remplacez par l'ID de la formation appropriée

        // Appel de la fonction pour créer un nouveau cours
        $idCours = creationCours($theme, $cours, $duree, $idFormation);

        // Vérifier que l'ID du cours créé est un entier positif
        $this->assertGreaterThan(0, $idCours);

        // Supprimer le cours
        $resultatSuppression = suppressionCours($idCours);

        // Vérifier si la suppression a réussi
        $this->assertTrue($resultatSuppression);
    }

    public function testModificationCours()
    {
        // Paramètres du cours initial
        $themeInitial = "Web Development";
        $coursInitial = "HTML Basics";
        $dureeInitial = "2 heures";
        $idFormationInitial = 1; // ID de la formation existante

        // Création du cours initial
        $idCours = creationCours($themeInitial, $coursInitial, $dureeInitial, $idFormationInitial);

        // Vérification que l'ID du cours initial est un entier positif
        $this->assertGreaterThan(0, $idCours);

        // Nouveaux paramètres pour la modification du cours
        $themeModifie = "Nouveau thème";
        $coursModifie = "Nouveau contenu du cours";
        $dureeModifie = "3 heures";
        $idFormationModifie = 2; // Nouvel ID de formation

        // Appel de la fonction pour modifier le cours
        $resultatModification = modificationCours($idCours, $themeModifie,
        $coursModifie, $dureeModifie, $idFormationModifie
        );

        // Vérification que la modification du cours a réussi
        $this->assertTrue($resultatModification);
    }



}
