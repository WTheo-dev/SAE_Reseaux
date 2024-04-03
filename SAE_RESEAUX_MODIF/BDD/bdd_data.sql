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

INSERT INTO `materiaux` (
  `id_utilisateur`,
  `id_fiche`,
  `nom_image`,
  `nom_materiaux`,
  `description_demande`
) VALUES
(1, 1, 'champlat.png', 'Champlat', 'Finition'),
(1, 1, 'chiffons.png', 'Chiffons', 'Finition'),
(1, 1, 'colle_acrylique_fixation.png', 'Colle_acrylique_fixation', 'Finition'),
(1, 1, 'colle_pour_toile_de_verre.png', 'Colle_pour_toile_de_verre', 'Finition'),
(1, 1, 'croisillons_2_mm.png', 'croisillons_2_mm', 'Finition'),
(1, 1, 'enduit_a_joint.png', 'enduit_a_joint', 'Finition'),
(1, 1, 'enduit_de_rebouchage.png', 'enduit_de_rebouchage', 'Finition'),
(1, 1, 'etagere_bois.png', 'etagere_bois', 'Finition'),
(1, 1, 'faience_mur.png', 'faience_mur', 'Finition'),
(1, 1, 'joint_poudre_carrelage.png', 'joint_poudre_carrelage', 'Finition'),
(1, 1, 'colorants_universels.png', 'colorants_universels', 'Finition'),
(1, 1, 'mortier_colle_poudre.png', 'mortier_colle_poudre', 'Finition'),
(1, 1, 'panneau_bois.png', 'panneau_bois', 'Finition'),
(1, 1, 'papier_verre_120.png', 'papier_verre_120', 'Finition'),
(1, 1, 'papier_verre_80.png', 'papier_verre_80', 'Finition'),
(1, 1, 'peinture_satinee.png', 'peinture_satinee', 'Finition'),
(1, 1, 'peinture_brillante.png', 'peinture_brillante', 'Finition'),
(1, 1, 'peinture_impression.png', 'peinture_impression', 'Finition'),
(1, 1, 'plan_coffrage.png', 'plan_coffrage', 'Finition'),
(1, 1, 'plaque_platre_ba13.png', 'plaque_platre_ba13', 'Finition'),
(1, 1, 'plinthe_mdf_bois.png', 'plinthe_mdf_bois', 'Finition'),
(1, 1, 'pointes_tete_homme.png', 'pointes_tete_homme', "Finition"),
(1, 1, 'portemanteau_mural.png', 'portemanteau_mural', 'Finition'),
(1, 1, 'rail_r48.png', 'rail_r48', 'Finition'),
(1, 1, 'revetement_toile_verre.png', 'revetement_toile_verre', 'Finition'),
(1, 1, 'serrure_standard_encastrable_NF_cylindre_europeen.png', 'serrure_standard_encastrable_NF_cylindre_europeen', 'Finition'),
(1, 1, 'serrure_standard_en_l.png', 'serrure_standard_en_l', 'Finition'),
(1, 1, 'tablette_bois.png', 'tablette_bois', 'Finition'),
(1, 1, 'tasseau_rabote.png', 'tasseau_rabote', 'Finition'),
(1, 1, 'verrou_bouton_cylindre_40mm.png', 'verrou_bouton_cylindre_40mm', 'Finition'),
(1, 1, 'vis_bois_30mm.png', 'vis_bois_30mm', 'Finition'),
(1, 1, 'vis_trpf.png', 'vis_trpf', 'Finition'), 
(1, 1, 'vis_ttpc_25.png', 'vis_ttpc_25', 'Finition'),
(1, 1, 'vis_ttpc_35.png', 'vis_ttpc_35', 'Finition'), 
(1, 2, 'bonde_a_grille_pour_lave_mains.png', 'bonde_a_grille_pour_lave_mains', 'Plomberie'),
(1, 2, 'bouchon_laiton_a_visser_f_1/2.png', 'bouchon_laiton_a_visser_f_1/2', 'Plomberie'),
(1, 2, 'chevilles_expansion.png', 'chevilles_expansion', 'Plomberie'),
(1, 2, 'chevilles_frapper.png', 'chevilles_frapper', 'Plomberie'),
(1, 2, 'chevilles_autoforeuses.png', 'chevilles_autoforeuses', 'Plomberie'),
(1, 2, 'chiffons.png', 'chiffons', 'Plomberie'),
(1, 2, 'colle_acrylique_fixation.png', 'colle_acrylique_fixation', 'Plomberie'),
(1, 2, 'colle_pvc.png', 'colle_pvc', 'Plomberie'),
(1, 2, 'colle_pvc40.png', 'colle_pvc40', 'Plomberie'),
(1, 2, 'colle_pvc30.png', 'colle_pvc30', 'Plomberie'),
(1, 2, 'colle_pvc100.png', 'colle_pvc100', 'Plomberie'),
(1, 2, 'colliers_type_atlas_double12.png', 'colliers_type_atlas_double12', 'Plomberie'),
(1, 2, 'colliers_type_atlas_simple12.png', 'colliers_type_atlas_simple12', 'Plomberie'),
(1, 2, 'coude_cuivre_90_a_souder_ff_12.png', 'coude_cuivre_90_a_souder_ff_12', 'Plomberie'),
(1, 2, 'coude_pvc_87_30_ff_100.png', 'coude_pvc_87_30_ff_100', 'Plomberie'),
(1, 2, 'coude_pvc_87_30_ff_32.png', 'coude_pvc_87_30_ff_32', 'Plomberie'),
(1, 2, 'coude_pvc_87_30_ff_40.png', 'coude_pvc_87_30_ff_40', 'Plomberie'),
(1, 2, 'faience_mur.png', 'faience_mur', 'Plomberie'),
(1, 2, 'mortier_colle_poudre.png', 'mortier_colle_poudre', 'Plomberie'),
(1, 2, 'joint_poudre_carrelage.png', 'joint_poudre_carrelage', 'Plomberie'),
(1, 2, 'ecrou_laiton_a_collet_battu_12_17_12.png', 'ecrou_laiton_a_collet_battu_12_17_12', 'Plomberie'),
(1, 2, 'joints_d_etancheite_suivant_montages.png', 'joints_d_etancheite_suivant_montages', 'Plomberie'),
(1, 2, 'kit_robinet_d_arret_wc_equerre_flexible_joint.png', 'kit_robinet_d_arret_wc_equerre_flexible_joint', 'Plomberie'),
(1, 2, 'lave_mains.png', 'lave_mains', 'Plomberie'), 
(1, 2, 'lot_de_2_chevilles_clips_pour_fixation_wc_6x70.png', 'lot_de_2_chevilles_clips_pour_fixation_wc_6x70', 'Plomberie'),
(1, 2, 'lot_de_2_fixations_pour_lave_mains_parois_creuse_cheville.png', 'lot_de_2_fixations_pour_lave_mains_parois_creuse_cheville', 'Plomberie'),
(1, 2, 'lot_de_2_fixations_pour_lave_mains_parois_pleine_cheville.png', 'lot_de_2_fixations_pour_lave_mains_parois_pleine_cheville', 'Plomberie'),
(1, 2, 'manchon_cuivre_a_souder_ff_12.png', 'manchon_cuivre_a_souder_ff_12', 'Plomberie'),
(1, 2, 'manchon_de_dilatation_pvc_h_100.png', 'manchon_de_dilatation_pvc_h_100','Plomberie'),
(1, 2, 'manchon_male_243_cgu_12_M_12x17.png', 'manchon_male_243_cgu_12_M_12x17', 'Plomberie'),
(1, 2, 'manchon_male_243_cgu_12_M_15x21.png', 'manchon_male_243_cgu_12_M_15x21', 'Plomberie'),
(1, 2, 'manchon_pvc_100.png', 'manchon_pvc_100', 'Plomberie'),
(1, 2, 'manchon_pvc_32.png', 'manchon_pvc_32', 'Plomberie'),
(1, 2, 'manchon_pvc_40.png', 'manchon_pvc_40', 'Plomberie'),
(1, 2, 'melangeur_pour_lave_mains_flexibles_de_raccordement.png', 'melangeur_pour_lave_mains_flexibles_de_raccordement', 'Plomberie'),
(1, 2, 'pack_wc_a_poser_sortie_horizontale.png', 'pack_wc_a_poser_sortie_horizontale', 'Plomberie'),
(1, 2, 'panneau_bois.png', 'panneau_bois', 'Plomberie'),
(1, 2, 'papier_verre_120.png', 'papier_verre_120', 'Plomberie'),
(1, 2, 'papier_verre_80.png', 'papier_verre_80', 'Plomberie'),
(1, 2, 'pates_a_vis.png', 'pates_a_vis', 'Plomberie'),
(1, 2, 'pipe_coudee_wc_90_110mm.png', 'pipe_coudee_wc_90_110mm', 'Plomberie'),
(1, 2, 'pipe_droite_wc_110mm.png', 'pipe_droite_wc_110mm', 'Plomberie'),
(1, 2, 'plan_coffrage.png', 'plan_coffrage', 'Plomberie'),
(1, 2, 'reduction_pvc_40_32.png', 'reduction_pvc_40_32', 'Plomberie'),
(1, 2, 'robinet_de_puisage_de_lave_linge_platine_de_fixation.png', 'robinet_de_puisage_de_lave_linge_platine_de_fixation', 'Plomberie'),
(1, 2, 'robinet_simple_pour_lave_mains_flexible_de_raccordement.png', 'robinet_simple_pour_lave_mains_flexible_de_raccordement', 'Plomberie'),
(1, 2, 'rosaces_coniques_h19.png', 'rosaces_coniques_h19', 'Plomberie'),
(1, 2, 'siphon_lavabo_lave_mains_a_visser_sortie_32.png', 'siphon_lavabo_lave_mains_a_visser_sortie_32', 'Plomberie'),
(1, 2, 'systeme_de_vidage_pvc_pour_machine_a_laver.png', 'systeme_de_vidage_pvc_pour_machine_a_laver', 'Plomberie'),
(1, 2, 'tampon_de_reduction_simple_pvc_100_40.png', 'tampon_de_reduction_simple_pvc_100_40', 'Plomberie'),
(1, 2, 'tampon_de_visite_pvc_avec_bouchon_MF_100.png', 'tampon_de_visite_pvc_avec_bouchon_MF_100', 'Plomberie'),
(1, 2, 'tampon_de_visite_pvc_avec_bouchon_MF_32.png', 'tampon_de_visite_pvc_avec_bouchon_MF_32', 'Plomberie'),
(1, 2, 'te_egal_cuivre_a_souder_fff_12.png', 'te_egal_cuivre_a_souder_fff_12', 'Plomberie'),
(1, 2, 'te_pied_de_biche_87x30_ff_pvc_100.png', 'te_pied_de_biche_87x30_ff_pvc_100', 'Plomberie'),
(1, 2, 'te_pied_de_biche_87x30_ff_pvc_32.png', 'te_pied_de_biche_87x30_ff_pvc_32', 'Plomberie'),
(1, 2, 'te_pied_de_biche_87x30_ff_pvc_40.png', 'te_pied_de_biche_87x30_ff_pvc_40', 'Plomberie'),
(1, 2, 'tube_cuivre_12.png', 'tube_cuivre_12', 'Plomberie'),
(1, 2, 'tube_pvc_100.png', 'tube_pvc_100', 'Plomberie'),
(1, 2, 'tube_pvc_32.png', 'tube_pvc_32', 'Plomberie'),
(1, 2, 'tube_pvc_40.png', 'tube_pvc_40', 'Plomberie'),
(1, 2, 'vanne_d_arret_MF_1-4_de_tour_12x17.png', 'vanne_d_arret_MF_1-4_de_tour_12x17', 'Plomberie'),
(1, 2, 'verrou_bouton_cylindre_40mm.png', 'verrou_bouton_cylindre_40mm', 'Plomberie'),
(1, 2, 'vis_bois_30mm.png', 'vis_bois_30mm', 'Plomberie'),
(1, 2, 'vis_trpf.png', 'vis_trpf', 'Plomberie'),
(1, 2, 'vis_ttpc_25.png', 'vis_ttpc_25', 'Plomberie'),
(1, 2, 'vis_ttpc_35.png', 'vis_ttpc_35', 'Plomberie'),
(1, 3, 'bande_a_joint.png', 'bande_a_joint', 'Aménagement intérieur'),
(1, 3, 'bande_armee_a_joint.png', 'bande_armee_a_joint', 'Aménagement intérieur'),
(1, 3, 'champlat.png', 'Champlat', 'Aménagement intérieur'),
(1, 3, 'chevilles_expansion.png', 'chevilles_expansion', 'Aménagement intérieur'),
(1, 3, 'chevilles_frapper.png', 'chevilles_frapper', 'Aménagement intérieur'),
(1, 3, 'chevilles_autoforeuses.png', 'chevilles_autoforeuses', 'Aménagement intérieur'),
(1, 3, 'chiffons.png', 'Chiffons', 'Aménagement intérieur'),
(1, 3, 'colle_acrylique_fixation.png', 'colle_acrylique_fixation', 'Aménagement intérieur'),
(1, 3, 'colle_pour_toile_de_verre.png', 'Colle_pour_toile_de_verre', 'Aménagement intérieur'),
(1, 3, 'croisillions_2mm.png', 'croisillions_2mm', 'Aménagement intérieur'),
(1, 3, 'cylindre_double_entree_profil_europeen.png', 'cylindre_double_entree_profil_europeen', 'Aménagement intérieur'),
(1, 3, 'enduit_a_joint.png', 'enduit_a_joint', 'Aménagement intérieur'),
(1, 3, 'enduit_de_rebouchage.png', 'enduit_de_rebouchage', 'Aménagement intérieur'),
(1, 3, 'ensemble_de_porte_cle_I.png', 'ensemble_de_porte_cle_I', 'Aménagement intérieur'),
(1, 3, 'ensemble_de_porte_cle_L.png', 'ensemble_de_porte_cle_L', 'Aménagement intérieur'),
(1, 3, 'ensemble_interupteur_SA-VV_encastrable.png', 'ensemble_interupteur_SA-VV_encastrable', 'Aménagement intérieur'),
(1, 3, 'ensemble_prise_2P_T_encastrable.png', 'ensemble_prise_2P_T_encastrable', 'Aménagement intérieur'),
(1, 3, 'etagere_bois.png', 'etagere_bois', 'Aménagement intérieur'),
(1, 3, 'faience_mur.png', 'faience_mur', 'Aménagement intérieur'),
(1, 3, 'joint_poudre_carrelage.png', 'joint_poudre_carrelage', 'Aménagement intérieur'),
(1, 3, 'colorants_universels.png', 'colorants_universels', 'Aménagement intérieur'),
(1, 3, 'montant_M48.png', 'montant_M48', 'Aménagement intérieur'),
(1, 3, 'mortier_colle_poudre.png', 'mortier_colle_poudre', 'Aménagement intérieur'),
(1, 3, 'panneau_bois.png', 'panneau_bois', 'Aménagement intérieur'),
(1, 3, 'papier_verre_120.png', 'papier_verre_120', 'Aménagement intérieur'),
(1, 3, 'papier_verre_80.png', 'papier_verre_80', 'Aménagement intérieur'),
(1, 3, 'peinture_satinee.png', 'peinture_satinee', 'Aménagement intérieur'),
(1, 3, 'peinture_brillante.png', 'peinture_brillante', 'Aménagement intérieur'),
(1, 3, 'peinture_impression.png', 'peinture_impression', 'Aménagement intérieur'),
(1, 3, 'plan_coffrage.png', 'plan_coffrage', 'Aménagement intérieur'),
(1, 3, 'plaque_platre_ba13.png', 'plaque_platre_ba13', 'Aménagement intérieur'),
(1, 3, 'plinthe_mdf_bois.png', 'plinthe_mdf_bois', 'Aménagement intérieur'),
(1, 3, 'pointes_tete_homme.png', 'pointes_tete_homme', 'Aménagement intérieur'),
(1, 3, 'portemanteau_mural.png', 'portemanteau_mural', 'Aménagement intérieur'),
(1, 3, 'rail_r48.png', 'rail_r48', 'Aménagement intérieur'),
(1, 3, 'revetement_toile_verre.png', 'revetement_toile_verre', 'Aménagement intérieur'),
(1, 3, 'serrure_standard_encastrable_NF_cylindre_europeen.png', 'serrure_standard_encastrable_NF_cylindre_europeen', 'Aménagement intérieur'),
(1, 3, 'serrure_standard_en_l.png', 'serrure_standard_en_l', 'Aménagement intérieur'),
(1, 3, 'tablette_bois.png', 'tablette_bois', 'Aménagement intérieur'),
(1, 3, 'tasseau_rabote.png', 'tasseau_rabote', 'Aménagement intérieur'),
(1, 3, 'verrou_bouton_cylindre_40mm.png', 'verrou_bouton_cylindre_40mm', 'Aménagement intérieur'),
(1, 3, 'vis_bois_30mm.png', 'vis_bois_30mm', 'Aménagement intérieur'),
(1, 3, 'vis_trpf.png', 'vis_trpf', 'Aménagement intérieur'),
(1, 3, 'vis_ttpc_25.png', 'vis_ttpc_25', 'Aménagement intérieur'),
(1, 3, 'vis_ttpc_35.png', 'vis_ttpc_35', 'Aménagement intérieur'),
(1, 4, 'bande_a_joint.png', 'bande_a_joint', 'Serrurerie'),
(1, 4, 'bande_armee_a_joint.png', 'bande_armee_a_joint', 'Serrurerie'),
(1, 4, 'champlat.png', 'Champlat', 'Serrurerie'),
(1, 4, 'chevilles_expansion.png', 'chevilles_expansion', 'Serrurerie'),
(1, 4, 'chevilles_frapper.png', 'chevilles_frapper', 'Serrurerie'),
(1, 4, 'chevilles_autoforeuses.png', 'chevilles_autoforeuses', 'Serrurerie'),
(1, 4, 'chiffons.png', 'Chiffons', 'Serrurerie'),
(1, 4, 'colle_acrylique_fixation.png', 'colle_acrylique_fixation', 'Serrurerie'),
(1, 4, 'colle_pour_toile_de_verre.png', 'Colle_pour_toile_de_verre', 'Serrurerie'),
(1, 4, 'croisillions_2mm.png', 'croisillions_2mm', 'Serrurerie'),
(1, 4, 'cylindre_double_entree_profil_europeen.png', 'cylindre_double_entree_profil_europeen', 'Serrurerie'),
(1, 4, 'enduit_a_joint.png', 'enduit_a_joint', 'Serrurerie'),
(1, 4, 'enduit_de_rebouchage.png', 'enduit_de_rebouchage', 'Serrurerie'),
(1, 4, 'ensemble_de_porte_cle_I.png', 'ensemble_de_porte_cle_I', 'Serrurerie'),
(1, 4, 'ensemble_de_porte_cle_L.png', 'ensemble_de_porte_cle_L', 'Serrurerie'),
(1, 4, 'ensemble_interupteur_SA-VV_encastrable.png', 'ensemble_interupteur_SA-VV_encastrable', 'Serrurerie'),
(1, 4, 'ensemble_prise_2P_T_encastrable.png', 'ensemble_prise_2P_T_encastrable', 'Serrurerie'),
(1, 4, 'etagere_bois.png', 'etagere_bois', 'Serrurerie'),
(1, 4, 'faience_mur.png', 'faience_mur', 'Serrurerie'),
(1, 4, 'joint_poudre_carrelage.png', 'joint_poudre_carrelage', 'Serrurerie'),
(1, 4, 'colorants_universels.png', 'colorants_universels', 'Serrurerie'),
(1, 4, 'montant_M48.png', 'montant_M48', 'Serrurerie'),
(1, 4, 'mortier_colle_poudre.png', 'mortier_colle_poudre', 'Serrurerie'),
(1, 4, 'panneau_bois.png', 'panneau_bois', 'Serrurerie'),
(1, 4, 'papier_verre_120.png', 'papier_verre_120', 'Serrurerie'),
(1, 4, 'papier_verre_80.png', 'papier_verre_80', 'Serrurerie'),
(1, 4, 'peinture_satinee.png', 'peinture_satinee', 'Serrurerie'),
(1, 4, 'peinture_brillante.png', 'peinture_brillante', 'Serrurerie'),
(1, 4, 'peinture_impression.png', 'peinture_impression', 'Serrurerie'),
(1, 4, 'plan_coffrage.png', 'plan_coffrage', 'Serrurerie'),
(1, 4, 'plaque_platre_ba13.png', 'plaque_platre_ba13', 'Serrurerie'),
(1, 4, 'plinthe_mdf_bois.png', 'plinthe_mdf_bois', 'Serrurerie'),
(1, 4, 'pointes_tete_homme.png', 'pointes_tete_homme', 'Serrurerie'),
(1, 4, 'portemanteau_mural.png', 'portemanteau_mural', 'Serrurerie'),
(1, 4, 'rail_r48.png', 'rail_r48', 'Serrurerie'),
(1, 4, 'revetement_toile_verre.png', 'revetement_toile_verre', 'Serrurerie'),
(1, 4, 'serrure_standard_encastrable_NF_cylindre_europeen.png', 'serrure_standard_encastrable_NF_cylindre_europeen', 'Serrurerie'),
(1, 4, 'serrure_standard_en_l.png', 'serrure_standard_en_l', 'Serrurerie'),
(1, 4, 'tablette_bois.png', 'tablette_bois', 'Serrurerie'),
(1, 4, 'tasseau_rabote.png', 'tasseau_rabote', 'Serrurerie'),
(1, 4, 'verrou_bouton_cylindre_40mm.png', 'verrou_bouton_cylindre_40mm', 'Serrurerie'),
(1, 4, 'vis_bois_30mm.png', 'vis_bois_30mm', 'Serrurerie'),
(1, 4, 'vis_trpf.png', 'vis_trpf', 'Serrurerie'),
(1, 4, 'vis_ttpc_25.png', 'vis_ttpc_25', 'Serrurerie'),
(1, 4, 'vis_ttpc_35.png', 'vis_ttpc_35', 'Serrurerie'),
(1, 5, 'ampoule_E_27.png', 'ampoule_E_27', 'Electricite'),
(1, 5, 'bornes_connection_rapide_3_entrees.png', 'bornes_connection_rapide_3_entrees', 'Electricite'),
(1, 5, 'bornes_connection_rapide_2_entrees.png', 'bornes_connection_rapide_2_entrees', 'Electricite'),
(1, 5, 'colliers_type_atlas_double12.png', 'colliers_type_atlas_double12', 'Electricite'),
(1, 5, 'colliers_type_atlas_simple12.png', 'colliers_type_atlas_simple12', 'Electricite'),
(1, 5, 'conducteur_HO7VU_1-5_bleu.png', 'conducteur_HO7VU_1-5_bleu', 'Electricite'),
(1, 5, 'conducteur_HO7VU_1-5_noir.png', 'conducteur_HO7VU_1-5_noir', 'Electricite'),
(1, 5, 'conducteur_HO7VU_1-5_orange.png', 'conducteur_HO7VU_1-5_orange', 'Electricite'),
(1, 5, 'conducteur_HO7VU_1-5_VertJaune.png', 'conducteur_HO7VU_1-5_VertJaune', 'Electricite'),
(1, 5, 'conducteur_HO7VU_2-5_bleu.png', 'conducteur_HO7VU_2-5_bleu', 'Electricite'),
(1, 5, 'conducteur_HO7VU_2-5_rouge.png', 'conducteur_HO7VU_2-5_rouge', 'Electricite'),
(1, 5, 'conducteur_HO7VU_2-5_VertJaune.png', 'conducteur_HO7VU_2-5_VertJaune', 'Electricite'),
(1, 5, 'convecteur_electrique.png', 'convecteur_electrique', 'Electricite'),
(1, 5, 'enduit_de_rebouchage.png', 'enduit_de_rebouchage', 'Electricite'),
(1, 5, 'ensemble_interupteur_SA-VV_encastrable.png', 'ensemble_interupteur_SA-VV_encastrable', 'Electricite'),
(1, 5, 'ensemble_prise_2P_T_encastrable.png', 'ensemble_prise_2P_T_encastrable', 'Electricite'),
(1, 5, 'fiche_dcl_et_douille_electrique_E27.png', 'fiche_dcl_et_douille_electrique_E27', 'Electricite'),
(1, 5, 'gaine_ICTA_20.png', 'gaine_ICTA_20', 'Electricite'),
(1, 5, 'interupteur_automatique_avec_detecteur_de_mouvement.png', 'interupteur_automatique_avec_detecteur_de_mouvement', 'Electricite'),
(1, 5, 'plaque_de_platre_BA13.png', 'plaque_de_platre_BA13', 'Electricite'),
(1, 5, 'montant_M48.png', 'montant_M48', 'Electricite'),
(1, 5, 'vis_ttpc_25.png', 'vis_ttpc_25', 'Electricite');