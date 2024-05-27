CREATE TABLE option(
	id_option INT NOT NULL PRIMARY KEY,
	option_location VARCHAR (256) NOT NULL,
	prix INT NOT NULL
);

INSERT INTO option (id_option, option_location, prix) VALUES
(1, 'Assurance complementaire', '50.00'),
(2, 'Nettoyage', '75.00'),
(3, 'Complement carburant', '30.00'),
(4, 'Retour autre ville', '250.00'),
(5, 'Rabais dimanche', '-40.00');


CREATE TABLE type_client(
	id_type_client INT NOT NULL PRIMARY KEY,
	type_client VARCHAR (256) NOT NULL
);

INSERT INTO type_client (id_type_client, type_client) VALUES
(1, 'Particulier'),
(2, 'Entreprise'),
(3, 'Administration'),
(4, 'Association'),
(5, 'Longue duree');

CREATE TABLE client(
	id_client INT NOT NULL PRIMARY KEY,
	nom VARCHAR (256) NOT NULL,
	prenom VARCHAR (256) NOT NULL,
	adresse VARCHAR (256) NOT NULL,
	id_type_client INT NOT NULL ,
    CONSTRAINT clients_typesclients_FK FOREIGN KEY (id_type_client) REFERENCES type_client(id_type_client)
);

INSERT INTO client (id_client, nom, prenom, adresse, id_type_client) VALUES
(1, 'gallo', 'jack', '4 rue du paysan', 1),
(2, 'chevalier', 'michel', '5 rue du chateau', 4),
(3, 'chateau', 'jean-francois', '95 rue du paradis', 4),
(4, 'piano', 'mozart', '1 impasse du paradis', 1),
(5, 'latouche', 'jean', '45 avenue mozart', 2),
(6, 'valton', 'bernard', '36 boulevard des enfants', 1),
(7, 'leprince', 'nicolas', '7 rue du plessix', 3),
(8, 'bourin', 'brutus', '4 rue du maroilles', 1),
(9, 'pyramide', 'cleopate', '36 rue du gruyere', 1),
(10, 'freecs', 'gon', '200 avenue napoleon', 1),
(11, 'cycliste', 'gon', '98 impasse des ardennes', 4),
(12, 'ronaldo', 'jean', '45 boulevard des girafe', 5),
(13, 'gallet', 'pierre', '14 rue du massage', 1),
(14, 'delarue', 'judite', 'bois de boulogne', 3),
(15, 'delatirgie', 'mireille', '84 rue du paysan', 1),
(16, 'catho', 'marie', '94 rue du paradis', 2),
(17, 'gallais', 'corentin', '4 La Saudrais', 5);



CREATE TABLE categorie(
	id_categorie VARCHAR (1) NOT NULL PRIMARY KEY,
	categorie VARCHAR (256) NOT NULL,
	prix INT  NOT NULL
);

INSERT INTO categorie (id_categorie, categorie, prix) VALUES
('A', 'Citadine', '60.00'),
('B', 'Economique', '72.00'),
('C', 'Compacte', '80.00'),
('D', 'Intermediaire', '95.00'),
('E', 'Berline', '120.00'),
('F', 'Grande berline', '150.00'),
('G', 'Sport, SUV', '230.00'),
('V', 'Luxe', '350.00');

CREATE TABLE marque(
	id_marque INT NOT NULL PRIMARY KEY,
	marque VARCHAR (256) NOT NULL
);

INSERT INTO marque (id_marque, marque) VALUES
(1, 'Peugeot'),
(2, 'Volkswagen'),
(3, 'Mercedes'),
(4, 'Ford'),
(5, 'Citroen'),
(6, 'Fiat'),
(7, 'Porsche'),
(8, 'Mini'),
(9, 'B.M.W'),
(10, 'Jaguar'),
(11, 'Skoda'),
(12, 'Smart'),
(13, 'Opel'),
(14, 'Infinity'),
(15, 'Mclaren'),
(16, 'Alfa Romeo'),
(666, 'Mehdi');


CREATE TABLE modele(
	id_modele INT NOT NULL PRIMARY KEY,
	modele VARCHAR (256) NOT NULL,
	imagee VARCHAR (64) NOT NULL,
	nb_de_place INT NOT NULL,
	id_categorie VARCHAR (1) NOT NULL,
    CONSTRAINT modele_categories_FK FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
	id_marque INT  NOT NULL,
    CONSTRAINT modele_marque0_FK FOREIGN KEY (id_marque) REFERENCES marque(id_marque)
);

INSERT INTO modele (id_modele, id_marque, modele, imagee, nb_de_place, id_categorie) VALUES
(1, 16, 'Giulietta', 'alfa-romeo-giulietta.jpg', 5, 'D'),
(2, 4, 'S-Max', 'ford-smax.jpg', 5, 'E'),
(3, 9, 'Série 3', 'bmw-3.jpg', 5, 'D'),
(4, 9, 'Série 7', 'bmw-7.jpg', 5, 'F'),
(5, 2, 'Polo', 'vw-polo.jpg', 5, 'B'),
(6, 4, 'Kuga', 'ford-kuga.jpg', 5, 'G'),
(7, 1, '308', 'peugeot-308.jpg', 5, 'B'),
(8, 6, 'Cinquecento', 'fiat-500.jpg', 5, 'A'),
(9, 3, 'Classe E', 'mercedes-e.jpg', 5, 'F'),
(10, 1, '308 Break', 'peugeot-308-break.jpg', 5, 'C'),
(11, 11, 'Q50', 'infiniti-q50.jpg', 5, 'G'),
(12, 9, 'X5', 'bmw-x5.jpg', 5, 'V'),
(13, 13, 'Astra Break', 'opel-astra-break.jpg', 5, 'D'),
(14, 12, 'For Two', 'smart-fortwo.jpg', 5, 'A'),
(15, 3, 'Classe B', 'mercedes-b.jpg', 5, 'E'),
(16, 5, 'Jumpy 9 places', 'citroen-jumpy.jpg', 9, 'E'),
(17, 1, '3008', 'peugeot-3008.jpg', 5, 'D'),
(18, 4, 'C-Max', 'ford-cmax.jpg', 5, 'D'),
(19, 11, 'Octavia Break', 'skoda-octavia-break.jpg', 5, 'D'),
(20, 666, 'La classe', '', 2, 'G'),
(21, 9, 'X1', 'bmw-x1.jpg', 5, 'G'),
(22, 2, 'Scirocco', 'vw-scirocco.jpg', 5, 'D'),
(23, 10, 'XF', 'jaguar-xf.jpg', 5, 'V'),
(24, 9, 'Série 3 Break', 'bmw-3-break.jpg', 5, 'E'),
(25, 8, 'Cooper', 'mini-cooper.jpg', 5, 'C'),
(26, 7, 'Panamera', 'porsche-panamera.jpg', 5, 'V'),
(27, 2, 'Passat Break', 'vw-passat-break.jpg', 5, 'C');

CREATE TABLE type_motorisation(
	id_type_motorisation INT NOT NULL PRIMARY KEY,
	motorisation VARCHAR (256) NOT NULL
);

INSERT INTO type_motorisation (id_type_motorisation, motorisation) VALUES
(1, 'Essence'),
(2, 'Hybride'),
(3, 'Diesel'),
(4, 'Gpl'),
(5, 'Ethanol');



CREATE TABLE voiture(
	immatriculation VARCHAR (11) NOT NULL PRIMARY KEY,
	compteur INT NOT NULL,
	id_modele INT NOT NULL,
    CONSTRAINT voiture_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type_motorisation INT NOT NULL,
    CONSTRAINT voiture_type0_FK FOREIGN KEY (id_type_motorisation) REFERENCES type_motorisation(id_type_motorisation)
);

INSERT INTO voiture (immatriculation, compteur, id_modele, id_type_motorisation) VALUES
('123 ABC 456', 644, 1, ),
('215 QKX 284', 45, 2, ),
('234 ATV 765', 648, 3, ),
('238 SFG 387', 7865, 4, ),
('241 GST 356', 64351, 5, ),
('293 LXU 428', 1644, 6, ),
('349 DES 974', 653, 7, ),
('426 DEH 935', 963, 8, ),
('427 XHQ 765', 7411, 9, ),
('470 DKJ 639', 4556, 10, ),
('537 QSD 276', 46456, 11, ),
('542 SQU 387', 4654, 12, ),
('543 KDE 735', 61431, 13, ),
('634 DJH 724', 102156, 14, ),
('654 HDY 528', 46443, 15, ),
('732 HFD 383', 64345, 16, ),
('734 SED 359', 47968, 17, ),
('744 HFS 296', 31, 18, ),
('753 FSC 945', 311, 19, ),
('753 SUR 871', 46, 20, ),
('754 GYH 749', 9541, 21, ),
('765 HDW 347', 165, 22, ),
('765 KJH 364', 1653, 23, ),
('765 SRC 234', 68451, 24, ),
('853 DJY 284', 684, 25, ),
('857 HDE 248', 6845, 26, ),
('863 NBS 738', 849, 27, ),
('864 LQD 482', 635, 28, ),
('865 KSC 912', 8476, 29, ),
('873 MHF 487', 41417, 30, ),
('934 KDS 452', 7965, 31, ),
('985 FSZ 238', 14, 32, ),
('666 bzh 666', 684, 666, 1);


CREATE TABLE louer(
	id_louer INT NOT NULL PRIMARY KEY,
	date_debut DATE NOT NULL ,
	date_fin DATE NOT NULL ,
	compteur_debut INT NOT NULL ,
	compteur_fin INT NOT NULL ,
	immatriculation VARCHAR (16) NOT NULL,
    CONSTRAINT louer_voiture_FK FOREIGN KEY (immatriculation) REFERENCES voiture(immatriculation),
	id_client INT NOT NULL,
	CONSTRAINT louer_clients0_FK FOREIGN KEY (id_client) REFERENCES clients(id_client)
);



CREATE TABLE motorisation_existante(
	puissance INT NOT NULL,
	consommation INT NOT NULL,
	id_modele INT NOT NULL,
    CONSTRAINT motorisation_existante_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type_motorisation INT NOT NULL,
    CONSTRAINT motorisation_existante_type0_FK FOREIGN KEY (id_type_motorisation) REFERENCES type_motorisation(id_type),

    CONSTRAINT motorisation_existante_PK PRIMARY KEY (id_modele,id_type_motorisation)
);

INSERT INTO modele (id_modele, id_type_motorisation, puissance, consommation) VALUES
(1, , , ),
(2, , , ),
(3, , , ),
(4, , , ),
(5, , , ),
(6, , , ),
(7, , , ),
(8, , , ),
(9, , , ),
(10, , , ),
(11, , , ),
(12, , , ),
(13, , , ),
(14, , , ),
(15, , , ),
(16, , , ),
(17, , , ),
(18, , , ),
(19, , , ),
(20, , , ),
(21, , , ),
(22, , , ),
(23, , , ),
(24, , , ),
(25, , , ),
(26, , , ),
(27, , , ),
(28, , , ),
(29, , , ),
(30, , , ),
(31, , , ),
(32, , , ),
(69, , , );

CREATE TABLE choix_option(
	id_option INT NOT NULL,
    CONSTRAINT choixoption_option_FK FOREIGN KEY (id_option) REFERENCES option(id_option),
	id_louer INT NOT NULL ,
    CONSTRAINT choixoption_louer0_FK FOREIGN KEY (id_louer) REFERENCES louer(id_louer),

	CONSTRAINT choixoption_PK PRIMARY KEY (id_option,id_louer)
)