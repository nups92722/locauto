<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic.css">
    <title>Document</title>
</head>
<body>
    <?php
        include 'header.html';
    ?>

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
        $requete = 'select * FROM client join type_client using(id_type_client)';
        $resultat = $connexion->query($requete);
        
        echo ('<table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>prenom</th>
                        <th>adresse</th>
                        <th>type client</th>
                    </tr>
                </thead>');
        while ($client = $resultat->fetch()) {
            echo ('<tbody>
            <tr>
                <td>'.$client['nom'].'</td>
                <td>'.$client['prenom'].'</td>
                <td>'.$client['adresse'].'</td>
                <td>'.$client['type_client'].'</td>
                <td><a href="modifier_client.php?modele='.$client["id_client"].'">modifier client</a></td>
            </tr>
        </tbody>');
    }
    echo ('</table>');
        
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>


    <?php
        include 'footer.html';
    ?>
</body>
</html>