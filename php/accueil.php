<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locauto</title>
</head>
<body>
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
            if (isset($_POST['valider'])) {
                $resultat = $connexion->exec($_SESSION['request']);
                echo ('<script>alert("l\'action à bien été prise en compte");</script>');
            }
        } catch (PDOException $e) {
            echo ("Erreur : " . $e->getMessage() . "<br/>");
            die();
        }
    ?>

    <h1>locauto</h1>

    <ul>
        <li><a href="ajout.php">ajouter</a></li>
        <li><a href="supprime.php">supprimer</a></li>
    </ul>

    <div>
    <?php // creation du bloc selection des modeles
        try {
            $requete = 'SELECT * FROM categorie ORDER BY categorie';
            $resultat = $connexion->query($requete);
            $liste_modele = '<select name="e" id="ef"> <option value="tous">Tous</option>';

            while ($ligne = $resultat->fetch()) {
                $liste_modele .= '<option value="'.$ligne['id_categorie'].'">'.$ligne['categorie'].'</option>';
            }
            $liste_modele .= '</select>';
            echo ($liste_modele);
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    ?> 

<?php
    try {
        $requete = 'SELECT * FROM voiture JOIN type_motorisation USING(id_type_motorisation) JOIN modele USING(id_modele) JOIN marque USING(id_marque)';
        $resultat = $connexion->query($requete);
        
        while ($voiture = $resultat->fetch()) {
            $immatriculation = $voiture["immatriculation"];
            $compteur = $voiture["compteur"];
            $motorisation = $voiture["motorisation"];
            $modele = $voiture["modele"];
            $nombre_place = $voiture["nb_de_place"];
            $marque = $voiture["marque"];
            echo ('<div>');
            echo ('<p>la plaque d\'immatriculation est '.$immatriculation.'</p>');
            echo ('<p>le compteur est '.$compteur.'</p>');
            echo ('<p>la motorisation est '.$motorisation.'</p>');
            echo ('<p>le modele est '.$modele.'</p>');
            echo ('<p>le nombre de place est '.$nombre_place.'</p>');
            echo ('<p>la marque est '.$marque.'</p>');
            echo ('</div>');
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    </div>
</body>
</html>