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

