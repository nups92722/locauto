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
        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // ajouter le nom de la base de donne
            } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    ?>

    <h1>supprimer une voiture</h1>

    <form action="validation.php" method="post"> <!-- bloc pour supprimer une voiture -->
        <div>
            <p>immatriculation :</p>
            <input name="immatriculation" type="text" minlength="11" maxlength="11" required>
        </div>

        <input name="supprimer" type="submit" value="supprimer">
    </form>
</body>
</html>