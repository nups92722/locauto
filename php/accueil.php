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
            $liste_modele = '<select id="e" id="ef"><option value="tous">Tous</option>';

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
    </div>
</body>
</html>