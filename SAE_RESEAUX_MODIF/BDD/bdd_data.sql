USE apeaj

-- Insertion des données d'apprentis
INSERT INTO `apprenti` (`id_apprenti`, `nom`, `prenom`, `photo`, `id_utilisateur`) VALUES
(25, 'Dupont', 'Jean', 'jean.jpg', 59),
(26, 'Martin', 'Sophie', 'sophie.jpg', 60),
(21, 'Lebrun', 'Jane', 'jane.jpg', 55),
(27, 'Dubois', 'Pierre', 'pierre.jpg', 61),
(28, 'Lefevre', 'Marie', 'marie.jpg', 62),
(29, 'Leroy', 'Luc', 'luc.jpg', 63),
(30, 'Moreau', 'Claire', 'claire.jpg', 64),
(31, 'Roux', 'Thomas', 'thomas.jpg', 65);
COMMIT;

-- Insertion des données pour la table `utilisateur`
INSERT INTO `utilisateur` (`id_Utilisateur`, `login`, `mdp`, `id_role`) VALUES
(2, 'Theo.WAZYDRAG', 'azerty', 2),
(47, 'WAZYDRAG Theo', '1234', 4),
(48, 'Chazal Claire', '1245', 5),
(55, 'Lebrun Jane', '1234', 1),
(53, 'Dujardin Jean', '3456', 3),
(54, 'Dupond Jacques', '5678', 4),
(60, 'Martin Sophie', '1478', 1),
(59, 'Dupont Jean', '1268', 1),
(61, 'Dubois Pierre', '1269', 1),
(62, 'Lefevre Marie', '1258', 1),
(63, 'Leroy Luc', '1245', 1),
(64, 'Moreau Claire', '3568', 1),
(65, 'Roux Thomas', '6789', 1);
COMMIT;

-- Insertion des données pour la table `rôle`
INSERT INTO `role` (`id_role`, `description`) VALUES
(1, 'Apprenti'),
(2, 'Super-Admin'),
(3, 'Educ Admin'),
(4, 'Educ Simple'),
(5, 'CIP');

-- Ajout de la contrainte d'unicité pour le Super-Admin
ALTER TABLE `role`
ADD CONSTRAINT `unique_superadmin`
UNIQUE (`description`);

INSERT INTO `fiche_intervention` (
    `numero`,
    `nom_du_demandeur`,
    `date_demande`,
    `date_intervention`,
    `duree_intervention`,
    `localisation`,
    `description_demande`,
    `degre_urgence`,
    `type_intervention`,
    `nature_intervention`,
    `couleur_intervention`,
    `etat_fiche`,
    `date_creation`,
    `id_personnel`,
    `id_apprenti`
) VALUES
(1, 'John Doe', '2023-12-22', '2023-12-23', '2 heures', 'Emplacement A', 'Réparation électrique', 'Urgent', 'Maintenance', 'Réparation', 'Rouge', 'En cours', '2023-12-22 08:00:00', 1, 2),
(2, 'Jane Smith', '2023-12-20', '2023-12-25', '3 heures', 'Emplacement B', 'Installation de matériel', 'Moyen', 'Installation', 'Équipement', 'Bleu', 'En attente', '2023-12-20 10:30:00', 2, 3),
(3, 'Bob Johnson', '2023-12-18', '2023-12-24', '1 heure', 'Emplacement C', 'Problème de plomberie', 'Faible', 'Réparation', 'Plomberie', 'Vert', 'Terminé', '2023-12-18 15:45:00', 3, 1);


