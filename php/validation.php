<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        session_start();
        $_SESSION['request'] = null;

        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // ajouter le nom de la base de donne
            } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    ?>

    <?php
    try {
        if (isset($_POST['supprimer'])) {
            $requete = 'SELECT * FROM voiture JOIN type_motorisation USING(id_type_motorisation) JOIN modele USING(id_modele) JOIN marque USING(id_marque) WHERE immatriculation = "'.$_POST['immatriculation'].'"';
            $resultat = $connexion->query($requete);
            $voiture = $resultat->fetch();
            
            if ($voiture == null) {
                echo ('La voiture avec la plaque dimmatriculation '.$_POST['immatriculation'].' n\'existe pas');
            } else {
                $immatriculation = $voiture["immatriculation"];
                $compteur = $voiture["compteur"];
                $type = $voiture["motorisation"];
                $modele = $voiture["modele"];
                $nombre_place = $voiture["nb_de_place"];
                $marque = $voiture["marque"];
                $_SESSION['request'] = 'DELETE FROM voiture WHERE immatriculation = "'.$immatriculation.'"';
                echo ('<p>bingo   '.$modele.'</p><p>faut faire le resumer de la voiture mais flemme</p>');
            }
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>

    <form action="accueil.php" method="post">
        <input name="valider" type="submit" value="valider">
        <input name="annuler" type="submit" value="annuler">
    </form>
</body>
</html>