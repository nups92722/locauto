<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/validation.css">
    <link rel="stylesheet" href="../css/basic.css">
    <title>Document</title>
</head>

<body>
<header class="header-outer">
	<div class="header-inner responsive-wrapper">
		<div class="header-logo">
			<img src="../image/logovrai.png" />
		</div>
		<nav class="header-navigation">
                <a href="accueil.php">Accueil</a>
                <a href="ajout.php">Ajouter voiture</a>
                <a href="supprime.php">Supprimer voiture</a>
			<button>Menu</button>
		</nav>
	</div>
</header>
    <?php
        session_start();

        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // ajouter le nom de la base de donne
            } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    ?>

    <?php
    try { 
        function print_car_data($immatriculation, $compteur, $motorisation, $modele, $nombre_place, $categorie){
            echo ('<div class="card-container"><p>Nom de la plaque d\'immatriculation: '.$immatriculation.'</p>');
            echo ('<p>le compteur possède '.$compteur.'km</p>');
            echo ('<p>la motorisation est de type '.$motorisation.'</p>');
            echo ('<p>Numéro du modèle: '.$modele.'</p>');
            echo ('<p>Il y a '.$nombre_place.' places dans le véhicule</p>');
            echo ('<p>la categorie est de type '.$categorie.'</p><form action="accueil.php" method="post"><input class="valider" name="valider" type="submit" value="Valider"><input name="annuler" type="submit" value="Annuler"></form></div>');
        }

        // code pour verification supression de voiture
        if (isset($_POST['supprimer'])) {
            $requete = 'SELECT * FROM voiture JOIN type_motorisation USING(id_type_motorisation) JOIN modele USING(id_modele) JOIN categorie USING(id_categorie) JOIN marque USING(id_marque) WHERE immatriculation = "'.$_POST['immatriculation'].'"';
            $resultat = $connexion->query($requete);
            $voiture = $resultat->fetch();
            
            if ($voiture == null) {
                echo ('La voiture avec la plaque dimmatriculation '.$_POST['immatriculation'].' n\'existe pas');
            } else {
                print_car_data($voiture["immatriculation"], $voiture["compteur"], $voiture["motorisation"], $voiture["modele"], $voiture["nb_de_place"], $voiture["categorie"]);
                $_SESSION['retirer'] = $voiture["immatriculation"];
            }
        }


        // code pour verification ajout de voiture
        if (isset($_POST['submit'])) {
            // gestion info modele
            if (isset($_POST['model'])) {
                $_SESSION['modele'] = $_POST['model'];
                $requete = 'SELECT * FROM modele JOIN marque USING(id_marque) JOIN categorie USING(id_categorie) WHERE id_modele = '.$_POST['model'].'';
                $resultat = $connexion->query($requete);
                $ligne = $resultat->fetch();
                $modele = $ligne['modele'];
                $nombre_place = $ligne['nb_de_place']; 
                $categorie = $ligne['categorie'];
            } else {
                $_SESSION['nouveau_modele'] = $modele = $_POST['new_model'];
                $_SESSION['nombre_place'] = $nombre_place = $_POST['new_seat'];
                // gestion info categorie
                if (isset($_POST['category'])) {
                    $_SESSION['categorie'] = $_POST['category'];
                    $requete = 'SELECT * FROM categorie WHERE id_categorie = '.$_POST['category'].'';
                    $resultat = $connexion->query($requete);
                    $ligne = $resultat->fetch();
                    $categorie = $ligne['categorie'];
                } else {
                    $_SESSION['nouvelle_categorie'] = $categorie = $_POST['new_category'];
                }
                if (isset($_POST['brand'])) {
                    $_SESSION['marque'] = $_POST['brand'];
                    $requete = 'SELECT * FROM marque WHERE id_marque = '.$_POST['brand'].'';
                    $resultat = $connexion->query($requete);
                    $ligne = $resultat->fetch();
                    $marque = $ligne['marque'];
                } else {
                    $_SESSION['nouvelle_marque'] = $marque = $_POST['new_brand'];
                }
            }
            // gestion info motorisation
            if (isset($_POST['motorisation'])) {
                $_SESSION['motorisation'] = $_POST['motorisation'];
                $requete = 'SELECT * FROM type_motorisation WHERE id_type_motorisation = '.$_POST['motorisation'].'';
                $resultat = $connexion->query($requete);
                $ligne = $resultat->fetch();
                $motorisation = $ligne['motorisation'];
            } else {
                $_SESSION['nouvelle_motorisation'] = $motorisation = $_POST['new_motorisation'];
            }
            $_SESSION['immatriculation'] = $immatriculation = $_POST["immatriculation"];
            $_SESSION['compteur'] = $compteur = $_POST["meter"];
            print_car_data($immatriculation, $compteur, $motorisation, $modele, $nombre_place, $categorie);
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
</body>
</html>