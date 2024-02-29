-- Insertion des données d'apprentis
INSERT INTO `apprenti` (`nom`, `prenom`, `photo`, `id_utilisateur`) VALUES
('Dupont', 'Jean', 'jean.jpg', 1),
('Martin', 'Sophie', 'sophie.jpg', 2),
('Dubois', 'Pierre', 'pierre.jpg', 3),
('Lefevre', 'Marie', 'marie.jpg', 4),
('Leroy', 'Luc', 'luc.jpg', 5),
('Moreau', 'Claire', 'claire.jpg', 6),
('Roux', 'Thomas', 'thomas.jpg', 7),
('Fournier', 'Julie', 'julie.jpg', 8);

-- Insertion des données pour la table `utilisateur`
INSERT INTO `utilisateur` (`login`, `mdp`, `id_role`) VALUES
('utilisateur1', 'motdepasse1', 1),
('utilisateur2', 'motdepasse2', 2),
('utilisateur3', 'motdepasse3', 3),
('utilisateur4', 'motdepasse4', 4),
('utilisateur5', 'motdepasse5', 4),
('utilisateur6', 'motdepasse6', 5),
('utilisateur7', 'motdepasse7', 1);

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


