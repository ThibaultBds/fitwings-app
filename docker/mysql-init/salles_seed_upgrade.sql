INSERT INTO salle (nom, adresse, ville, code_postal, telephone, email, horaires, description) VALUES
('FitWings Paris Bastille', '12 Rue de la Roquette', 'Paris', '75011', '01 43 55 12 34', 'paris.bastille@fitwings.fr', 'Lun-Ven : 6h-23h | Sam-Dim : 8h-20h', 'Notre salle parisienne au coeur du 11e. Espace cardio XXL, zone musculation libre et cours collectifs toute la journee. Vestiaires avec sauna.'),
('FitWings Paris Republique', '45 Avenue de la Republique', 'Paris', '75010', '01 40 22 88 00', 'paris.republique@fitwings.fr', 'Lun-Ven : 7h-22h30 | Sam : 8h-20h | Dim : 9h-18h', 'Salle moderne au coeur de Paris 10e. Plateau de musculation sur deux niveaux, studio spinning, espace stretching et coaching individuel disponible.'),
('FitWings Lyon Part-Dieu', '8 Boulevard Vivier-Merle', 'Lyon', '69003', '04 72 60 31 50', 'lyon.partdieu@fitwings.fr', 'Lun-Ven : 6h30-22h | Sam-Dim : 8h-19h', 'Notre flagship lyonnais a deux minutes de la gare Part-Dieu. 1200 m2 de materiel haut de gamme, piscine courte longueur, 15 cours collectifs par semaine.'),
('FitWings Lyon Confluence', '22 Cours Charlemagne', 'Lyon', '69002', '04 72 41 07 07', 'lyon.confluence@fitwings.fr', 'Lun-Ven : 7h-22h | Sam-Dim : 9h-18h', 'Salle design dans le quartier Confluence. Equipements cardio connectes, salle de boxe et programme nutrition personnalise inclus avec l abonnement Premium.'),
('FitWings Marseille Prado', '156 Avenue du Prado', 'Marseille', '13008', '04 91 78 44 20', 'marseille.prado@fitwings.fr', 'Lun-Ven : 6h-23h | Sam : 7h-21h | Dim : 8h-19h', 'Grande salle ensoleillee face au Prado. Terrasse exterieure pour les entrainements en plein air, espace functional training, cours de yoga et de pilates.'),
('FitWings Lille Centre', '24 Rue Nationale', 'Lille', '59800', '03 20 55 11 22', 'lille.centre@fitwings.fr', 'Lun-Ven : 6h-22h | Sam-Dim : 8h-20h', 'Salle polyvalente en centre-ville avec zone cardio, musculation et studio small-group training.'),
('FitWings Bordeaux Quinconces', '10 Allees de Tourny', 'Bordeaux', '33000', '05 56 44 23 10', 'bordeaux.quinconces@fitwings.fr', 'Lun-Ven : 6h30-22h30 | Sam-Dim : 8h-19h', 'Plateau complet, cours collectifs quotidiens et coaching personnalise.'),
('FitWings Toulouse Capitole', '18 Rue d Alsace Lorraine', 'Toulouse', '31000', '05 34 31 20 90', 'toulouse.capitole@fitwings.fr', 'Lun-Ven : 6h-23h | Sam : 8h-20h | Dim : 9h-18h', 'Club premium avec espace force, zone fonctionnelle et suivi performance.'),
('FitWings Nantes Commerce', '5 Rue de la Marne', 'Nantes', '44000', '02 40 73 18 55', 'nantes.commerce@fitwings.fr', 'Lun-Ven : 7h-22h | Sam-Dim : 8h-19h', 'Salle lumineuse avec cardio connecte, cours collectifs et accompagnement nutrition.'),
('FitWings Nice Massena', '22 Avenue Jean Medecin', 'Nice', '06000', '04 93 62 11 74', 'nice.massena@fitwings.fr', 'Lun-Ven : 6h30-22h | Sam-Dim : 8h-20h', 'Club moderne proche centre avec zone libre, cours bien-etre et espace recovery.'),
('FitWings Strasbourg Kleber', '14 Rue des Francs Bourgeois', 'Strasbourg', '67000', '03 88 23 40 12', 'strasbourg.kleber@fitwings.fr', 'Lun-Ven : 6h30-22h | Sam-Dim : 8h-19h', 'Salle complete, coaching adapte a tous niveaux et programmes de progression.'),
('FitWings Montpellier Comedie', '9 Boulevard Victor Hugo', 'Montpellier', '34000', '04 67 58 29 81', 'montpellier.comedie@fitwings.fr', 'Lun-Ven : 6h-22h30 | Sam-Dim : 8h-19h', 'Espace fitness urbain avec cardio, musculation et studio cours collectifs.'),
('FitWings Rennes Republique', '3 Quai Lamartine', 'Rennes', '35000', '02 99 65 40 27', 'rennes.republique@fitwings.fr', 'Lun-Ven : 6h30-22h | Sam-Dim : 8h-19h', 'Salle recente avec equipements premium, zone fonctionnelle et suivi coach.')
AS new
ON DUPLICATE KEY UPDATE
    nom = new.nom,
    adresse = new.adresse,
    ville = new.ville,
    code_postal = new.code_postal,
    telephone = new.telephone,
    horaires = new.horaires,
    description = new.description;
