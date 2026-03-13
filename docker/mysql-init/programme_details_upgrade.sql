-- 1) AJOUT DES COLONNES (phpMyAdmin friendly)
-- Execute ces requetes une par une. Si une colonne existe deja,
-- phpMyAdmin peut renvoyer "Duplicate column name" : passe a la suivante.

ALTER TABLE programme ADD COLUMN duree_semaines INT NULL;
ALTER TABLE programme ADD COLUMN seances_par_semaine VARCHAR(50) NULL;
ALTER TABLE programme ADD COLUMN duree_seance_minutes INT NULL;
ALTER TABLE programme ADD COLUMN materiel TEXT NULL;
ALTER TABLE programme ADD COLUMN structure_plan TEXT NULL;
ALTER TABLE programme ADD COLUMN conseils TEXT NULL;
ALTER TABLE programme ADD COLUMN benefices TEXT NULL;

-- 2) REMPLISSAGE DES DETAILS

UPDATE programme
SET duree_semaines = 4,
    seances_par_semaine = '3',
    duree_seance_minutes = 45,
    materiel = 'Tapis, velo, corde a sauter',
    structure_plan = 'Jour 1 cardio modere, Jour 2 fractionne court, Jour 3 endurance progressive',
    conseils = 'Commencer a intensite moderee et augmenter progressivement toutes les 2 semaines',
    benefices = 'Meilleure endurance, souffle, recuperation cardio'
WHERE title = 'Starter Cardio 4 Semaines';

UPDATE programme
SET duree_semaines = 6,
    seances_par_semaine = '3-4',
    duree_seance_minutes = 25,
    materiel = 'Tapis, velo, timer intervalle',
    structure_plan = '2 seances HIIT + 1 seance cardio long',
    conseils = 'Respecter les temps de repos entre intervalles',
    benefices = 'Condition physique plus explosive et depense calorique elevee'
WHERE title = 'HIIT Express 20min';

UPDATE programme
SET duree_semaines = 8,
    seances_par_semaine = '4',
    duree_seance_minutes = 60,
    materiel = 'Tapis, rameur, cardiofrequencemetre',
    structure_plan = '2 seances tempo + 1 longue + 1 recuperation active',
    conseils = 'Rester majoritairement en zone cardiaque aerobie',
    benefices = 'Endurance solide et meilleure efficacite cardio'
WHERE title = 'Endurance Longue Distance';

UPDATE programme
SET duree_semaines = 6,
    seances_par_semaine = '3',
    duree_seance_minutes = 50,
    materiel = 'Halteres, banc, elastiques',
    structure_plan = '3 full body par semaine',
    conseils = 'Prioriser la technique avant la charge',
    benefices = 'Renforcement global et progression technique'
WHERE title = 'Full Body Fondations';

UPDATE programme
SET duree_semaines = 8,
    seances_par_semaine = '4',
    duree_seance_minutes = 60,
    materiel = 'Barre, disques, rack',
    structure_plan = 'Format 5x5 sur mouvements principaux + assistance',
    conseils = 'Garder 1-2 repetitions en reserve sur les series lourdes',
    benefices = 'Gain de force net sur les polyarticulaires'
WHERE title = 'Force Intermediaire 5x5';

UPDATE programme
SET duree_semaines = 10,
    seances_par_semaine = '4-5',
    duree_seance_minutes = 70,
    materiel = 'Barre, halteres, machines',
    structure_plan = 'Split haut/bas + jour force + jour volume',
    conseils = 'Planifier deload toutes les 4 semaines',
    benefices = 'Force et masse musculaire en progression continue'
WHERE title = 'Power Build Avance';

UPDATE programme
SET duree_semaines = 6,
    seances_par_semaine = '3',
    duree_seance_minutes = 45,
    materiel = 'Poids du corps, tapis, cardio machines',
    structure_plan = '2 circuits full body + 1 cardio long',
    conseils = 'Combiner entrainement et hygiene alimentaire',
    benefices = 'Perte de masse grasse durable'
WHERE title = 'Perte de Poids Active';

UPDATE programme
SET duree_semaines = 8,
    seances_par_semaine = '4',
    duree_seance_minutes = 50,
    materiel = 'Halteres, medecine ball, rameur',
    structure_plan = '2 circuits intensifs + 2 cardio intervalles',
    conseils = 'Maintenir une regularite hebdomadaire stricte',
    benefices = 'Condition generale, tonicite, perte de poids'
WHERE title = 'Shred Intermediaire';

UPDATE programme
SET duree_semaines = 8,
    seances_par_semaine = '5',
    duree_seance_minutes = 55,
    materiel = 'Salle complete, cardio machine',
    structure_plan = '3 seances renfo + 2 cardio haute intensite',
    conseils = 'Surveiller la fatigue et adapter le volume',
    benefices = 'Definition musculaire et depense elevee'
WHERE title = 'Cut Avance';

UPDATE programme
SET duree_semaines = 5,
    seances_par_semaine = '3',
    duree_seance_minutes = 35,
    materiel = 'Tapis, elastiques, foam roller',
    structure_plan = 'Mobilite + core + respiration',
    conseils = 'Execution lente et controlee',
    benefices = 'Posture, souplesse, confort articulaire'
WHERE title = 'Mobilite et Core';

UPDATE programme
SET duree_semaines = 6,
    seances_par_semaine = '3-4',
    duree_seance_minutes = 40,
    materiel = 'Tapis yoga, elastiques',
    structure_plan = 'Yoga dynamique + renfo doux + respiration',
    conseils = 'Travailler la qualite du mouvement',
    benefices = 'Moins de stress, meilleure mobilite, gainage'
WHERE title = 'Equilibre Corps Esprit';

UPDATE programme
SET duree_semaines = 8,
    seances_par_semaine = '4',
    duree_seance_minutes = 45,
    materiel = 'Tapis, accessoires mobilite',
    structure_plan = 'Bloc prevention blessures + recuperation active',
    conseils = 'Respecter sommeil et recuperation',
    benefices = 'Performance durable et meilleure tolerance a la charge'
WHERE title = 'Performance Durable';
