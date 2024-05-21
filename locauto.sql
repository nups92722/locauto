CREATE TABLE option(
	id_option INT NOT NULL PRIMARY KEY,
	option VARCHAR (256) NOT NULL,
	prix INT NOT NULL
);



CREATE TABLE typesclients(
	id_type_client INT NOT NULL PRIMARY KEY,
	type_client VARCHAR (256) NOT NULL
);



CREATE TABLE clients(
	id_client INT NOT NULL PRIMARY KEY,
	nom VARCHAR (256) NOT NULL,
	prenom VARCHAR (256) NOT NULL,
	adresse VARCHAR (256) NOT NULL,
	id_type_client INT NOT NULL ,
    CONSTRAINT clients_typesclients_FK FOREIGN KEY (id_type_client) REFERENCES typesclients(id_type_client)
);



CREATE TABLE categories(
	id_categorie VARCHAR (1) NOT NULL PRIMARY KEY,
	categorie VARCHAR (256) NOT NULL,
	prix INT  NOT NULL
);



CREATE TABLE marque(
	id_marque INT NOT NULL PRIMARY KEY,
	nom VARCHAR (256) NOT NULL
);



CREATE TABLE modele(
	id_modele INT NOT NULL PRIMARY KEY,
	nom VARCHAR (256) NOT NULL,
	puissance INT NOT NULL,
	autonomie INT NOT NULL,
	date_de_sortie INTEGER  NOT NULL,
	nb_de_place INT NOT NULL,
	id_categorie VARCHAR (1) NOT NULL,
    CONSTRAINT modele_categories_FK FOREIGN KEY (id_categorie) REFERENCES categories(id_categorie),
	id_marque INT  NOT NULL,
    CONSTRAINT modele_marque0_FK FOREIGN KEY (id_marque) REFERENCES marque(id_marque)
);



CREATE TABLE type_motorisation(
	id_type INT NOT NULL PRIMARY KEY,
	nom VARCHAR (256) NOT NULL
);



CREATE TABLE voiture(
	immatriculation VARCHAR (16) NOT NULL PRIMARY KEY,
	marque VARCHAR (256) NOT NULL,
	modele VARCHAR (256) NOT NULL,
	imagee VARCHAR (64) NOT NULL,
	compteur INT NOT NULL,
	id_modele INT NOT NULL,
    CONSTRAINT voiture_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type INT NOT NULL,
    CONSTRAINT voiture_type0_FK FOREIGN KEY (id_type) REFERENCES type_motorisation(id_type)
);



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
	id_modele INT NOT NULL,
    CONSTRAINT motorisation_existante_modele_FK FOREIGN KEY (id_modele) REFERENCES modele(id_modele),
	id_type INT NOT NULL,
    CONSTRAINT motorisation_existante_type0_FK FOREIGN KEY (id_type) REFERENCES type_motorisation(id_type),

    CONSTRAINT motorisation_existante_PK PRIMARY KEY (id_modele,id_type)
);



CREATE TABLE choixoption(
	id_option INT NOT NULL,
    CONSTRAINT choixoption_option_FK FOREIGN KEY (id_option) REFERENCES option(id_option),
	id_louer INT NOT NULL ,
    CONSTRAINT choixoption_louer0_FK FOREIGN KEY (id_louer) REFERENCES louer(id_louer),

	CONSTRAINT choixoption_PK PRIMARY KEY (id_option,id_louer)
)