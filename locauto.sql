CREATE TABLE option(
	id_option INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	option_location VARCHAR (256) NOT NULL,
	prix INT NOT NULL
);

INSERT INTO option (option_location, prix) VALUES
('Assurance complementaire', '50.00'),
('Nettoyage', '75.00'),
('Complement carburant', '30.00'),
('Retour autre ville', '250.00'),
('Rabais dimanche', '-40.00');


CREATE TABLE type_client(
	id_type_client INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	type_client VARCHAR (256) NOT NULL
);

INSERT INTO type_client (type_client) VALUES
('Particulier'),
('Entreprise'),
('Administration'),
('Association'),
('Longue duree');

CREATE TABLE client(
	id_client INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nom VARCHAR (256) NOT NULL,
	prenom VARCHAR (256) NOT NULL,
	adresse VARCHAR (256) NOT NULL,
	id_type_client INT NOT NULL ,
    CONSTRAINT clients_typesclients_FK FOREIGN KEY (id_type_client) REFERENCES type_client(id_type_client)
);

INSERT INTO client (nom, prenom, adresse, id_type_client) VALUES
('gallo', 'jack', '4 rue du paysan', 1),
('chevalier', 'michel', '5 rue du chateau', 4),
('chateau', 'jean-francois', '95 rue du paradis', 4),
('piano', 'mozart', '1 impasse du paradis', 1),
('latouche', 'jean', '45 avenue mozart', 2),
('valton', 'bernard', '36 boulevard des enfants', 1),
('leprince', 'nicolas', '7 rue du plessix', 3),
('bourin', 'brutus', '4 rue du maroilles', 1),
('pyramide', 'cleopate', '36 rue du gruyere', 1),
('freecs', 'gon', '200 avenue napoleon', 1),
('cycliste', 'gon', '98 impasse des ardennes', 4),
('ronaldo', 'jean', '45 boulevard des girafes', 5),
('gallet', 'pierre', '14 rue du massage', 1),
('delarue', 'judite', 'bois de boulogne', 3),
('delatirgie', 'mireille', '84 rue du paysan', 1),
('catho', 'marie', '94 rue du paradis', 2),
('gallais', 'corentin', '4 La Saudrais', 5);



CREATE TABLE categorie(
	id_categorie INT (1) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	categorie VARCHAR (256) NOT NULL,
	prix INT  NOT NULL
);

INSERT INTO categorie (categorie, prix) VALUES
('Citadine', '60.00'),
('Economique', '72.00'),
('Compacte', '80.00'),
('Intermediaire', '95.00'),
('Berline', '120.00'),
('Grande berline', '150.00'),
('Sport, SUV', '230.00'),
('Luxe', '350.00');

CREATE TABLE marque(
	id_marque INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
	id_modele INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	modele VARCHAR (256) NOT NULL,
	imagee VARCHAR (64) NOT NULL,
	nb_de_place INT NOT NULL,
	id_categorie INT NOT NULL,
    CONSTRAINT modele_categories_FK FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
	id_marque INT  NOT NULL,
    CONSTRAINT modele_marque0_FK FOREIGN KEY (id_marque) REFERENCES marque(id_marque)
);

INSERT INTO modele (id_marque, modele, imagee, nb_de_place, id_categorie) VALUES
(16, 'Giulietta', 'alfa-romeo-giulietta.jpg', 5, 4),
(4, 'S-Max', 'ford-smax.jpg', 5, 5),
(9, 'Série 3', 'bmw-3.jpg', 5, 4),
(9, 'Série 7', 'bmw-7.jpg', 5, 6),
(2, 'Polo', 'vw-polo.jpg', 5, 2),
(4, 'Kuga', 'ford-kuga.jpg', 5, 7),
(1, '308', 'peugeot-308.jpg', 5, 2),
(6, 'Cinquecento', 'fiat-500.jpg', 5, 1),
(3, 'Classe E', 'mercedes-e.jpg', 5, 6),
(1, '308 Break', 'peugeot-308-break.jpg', 5, 3),
(11, 'Q50', 'infiniti-q50.jpg', 5, 7),
(9, 'X5', 'bmw-x5.jpg', 5, 8),
(13, 'Astra Break', 'opel-astra-break.jpg', 5, 4),
(12, 'For Two', 'smart-fortwo.jpg', 5, 1),
(3, 'Classe B', 'mercedes-b.jpg', 5, 5),
(5, 'Jumpy 9 places', 'citroen-jumpy.jpg', 9, 5),
(1, '3008', 'peugeot-3008.jpg', 5, 4),
(4, 'C-Max', 'ford-cmax.jpg', 5, 4),
(11, 'Octavia Break', 'skoda-octavia-break.jpg', 5, 4),
(666, 'La classe', '', 2, 7),
(9, 'X1', 'bmw-x1.jpg', 5, 7),
(2, 'Scirocco', 'vw-scirocco.jpg', 5, 4),
(10, 'XF', 'jaguar-xf.jpg', 5, 8),
(9, 'Série 3 Break', 'bmw-3-break.jpg', 5, 5),
(8, 'Cooper', 'mini-cooper.jpg', 5, 3),
(7, 'Panamera', 'porsche-panamera.jpg', 5, 8),
(2, 'Passat Break', 'vw-passat-break.jpg', 5, 3);

CREATE TABLE type_motorisation(
	id_type_motorisation INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	motorisation VARCHAR (256) NOT NULL
);

INSERT INTO type_motorisation (motorisation) VALUES
('Essence'),
('Hybride'),
('Diesel'),
('Gpl'),
('Ethanol');



CREATE TABLE voiture(
	immatriculation VARCHAR (11) NOT NULL PRIMARY KEY,
	compteur INT NOT NULL,
	id_modele INT NOT NULL,
    CONSTRAINT voiture_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type_motorisation INT NOT NULL,
    CONSTRAINT voiture_type0_FK FOREIGN KEY (id_type_motorisation) REFERENCES type_motorisation(id_type_motorisation)
);

INSERT INTO voiture (immatriculation, compteur, id_modele, id_type_motorisation) VALUES
('123 ABC 456', 644, 1, 1),
('215 QKX 284', 45, 2, 1),
('234 ATV 765', 648, 3, 3),
('238 SFG 387', 7865, 4, 4),
('241 GST 356', 64351, 5, 1),
('293 LXU 428', 1644, 6, 2),
('349 DES 974', 653, 7, 1),
('426 DEH 935', 963, 8, 5),
('427 XHQ 765', 7411, 9, 3),
('470 DKJ 639', 4556, 10, 3),
('537 QSD 276', 46456, 11, 4),
('542 SQU 387', 4654, 12, 1),
('543 KDE 735', 61431, 13, 2),
('634 DJH 724', 102156, 14, 2),
('654 HDY 528', 46443, 15, 4),
('732 HFD 383', 64345, 16, 3),
('734 SED 359', 47968, 17, 3),
('744 HFS 296', 31, 18, 1),
('753 FSC 945', 311, 19, 4),
('753 SUR 871', 46, 20, 2),
('754 GYH 749', 9541, 21, 1),
('765 HDW 347', 165, 22, 1),
('765 KJH 364', 1653, 23, 4),
('765 SRC 234', 68451, 24, 5),
('853 DJY 284', 684, 25, 3),
('857 HDE 248', 6845, 26, 2),
('863 NBS 738', 849, 27, 1),
('864 LQD 482', 635, 27, 1),
('865 KSC 912', 8476, 27, 3),
('873 MHF 487', 666, 27, 1),
('934 KDS 452', 114000, 27, 4),
('985 FSZ 238', 14, 27, 1);

CREATE TABLE etat_location (
    id_etat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    etat VARCHAR(255) NOT NULL
);


INSERT INTO etat_location (etat) VALUES
('fini'),
('reserver'),
('en cours');

CREATE TABLE louer(
	id_louer INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	date_debut DATE NOT NULL ,
	date_fin DATE NOT NULL ,
	compteur_debut INT NOT NULL ,
	compteur_fin INT NOT NULL ,
	immatriculation VARCHAR (16) NOT NULL,
    CONSTRAINT louer_voiture_FK FOREIGN KEY (immatriculation) REFERENCES voiture(immatriculation),
	id_client INT NOT NULL,
	CONSTRAINT louer_clients0_FK FOREIGN KEY (id_client) REFERENCES client(id_client),
	id_etat INT(1) NOT NULL,
	CONSTRAINT louer_etat_location_FK FOREIGN KEY (id_etat) REFERENCES etat_location(id_etat)
);

insert into louer (date_debut, date_fin, compteur_debut, compteur_fin, immatriculation, id_client, etat) values
('2004-10-10', '2004-10-12', 5, 10, '123 ABC 456', 3, 1),
('2004-10-10', '2004-10-30', 5, 10, '215 QKX 284', 7, 1),
('2004-10-10', '2005-01-01', 5, 10, '234 ATV 765', 8, 1),
('2004-10-02', '2004-10-15', 5, 10, '238 SFG 387', 7, 1),
('2004-10-11', '2004-10-17', 5, 10, '241 GST 356', 2, 1),
('2004-10-06', '2004-10-10', 5, 10, '293 LXU 428', 1, 1),
('2004-10-10', '2004-10-30', 5, 10, '349 DES 974', 8, 1),
('2004-10-23', '2004-10-25', 5, 10, '426 DEH 935', 8, 1),
('2004-10-14', '2004-10-27', 5, 10, '427 XHQ 765', 4, 1),
('2004-10-16', '2004-10-19', 5, 10, '470 DKJ 639', 4, 1),
('2004-10-14', '2004-10-23', 5, 10, '537 QSD 276', 4, 1),
('2004-10-02', '2004-10-14', 5, 10, '542 SQU 387', 4, 1),
('2004-10-01', '2004-10-10', 5, 10, '543 KDE 735', 4, 1);


CREATE TABLE motorisation_existante(
	puissance INT,
	consommation INT,
	nb_voiture INT NOT NULL,
	id_modele INT NOT NULL,
    CONSTRAINT motorisation_existante_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type_motorisation INT NOT NULL,
    CONSTRAINT motorisation_existante_type0_FK FOREIGN KEY (id_type_motorisation) REFERENCES type_motorisation(id_type_motorisation),

    CONSTRAINT motorisation_existante_PK PRIMARY KEY (id_modele,id_type_motorisation)
);

INSERT INTO motorisation_existante (id_modele, id_type_motorisation, nb_voiture) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 3, 1),
(4, 4, 1),
(5, 1, 1),
(6, 2, 1),
(7, 1, 1),
(8, 5, 1),
(9, 3, 1),
(10, 3, 1),
(11, 4, 1),
(12, 1, 1),
(13, 2, 1),
(14, 2, 1),
(15, 4, 1),
(16, 3, 1),
(17, 3, 1),
(18, 1, 1),
(19, 4, 1),
(20, 2, 1),
(21, 1, 1),
(22, 1, 1),
(23, 4, 1),
(24, 5, 1),
(25, 3, 1),
(26, 2, 1),
(27, 3, 1),
(27, 1, 4),
(27, 4, 1);

CREATE TABLE choix_option(
	id_option INT NOT NULL,
    CONSTRAINT choixoption_option_FK FOREIGN KEY (id_option) REFERENCES option(id_option),
	id_louer INT NOT NULL ,
    CONSTRAINT choixoption_louer0_FK FOREIGN KEY (id_louer) REFERENCES louer(id_louer),

	CONSTRAINT choixoption_PK PRIMARY KEY (id_option,id_louer)
)
