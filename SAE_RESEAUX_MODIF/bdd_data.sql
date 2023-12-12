-- Données pour la table `rôle`
INSERT INTO `rôle` (`Id_Rôle`, `Description`) VALUES
(1, 'Apprenti'),
(2, 'Super-Admin'),
(3, 'Educ Admin'),
(4, 'Educ Simple'),
(5, 'CIP');

-- Ajout de la contrainte d'unicité pour le Super-Admin
ALTER TABLE `rôle`
ADD CONSTRAINT `unique_superadmin`
UNIQUE (`description`);

