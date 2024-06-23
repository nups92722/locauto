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
        if (isset($_POST['ajouter'])) {
            $requete = 'INSERT INTO client (nom, prenom, adresse, id_type_client) VALUES ("'.$_POST['nom'].'", "'.$_POST['prenom'].'", "'.$_POST['adresse'].'", '.$_POST['type_client'].')';
            $resultat = $connexion->query($requete);
        }
        if (isset($_POST['modifier'])) {
            $requete = 'UPDATE client set nom = "'.$_POST['nom'].'", prenom = "'.$_POST['prenom'].'", adresse = "'.$_POST['adresse'].'", id_type_client = '.$_POST['type_client'].' where id_client = '.$_POST['id'].'';
            $resultat = $connexion->query($requete);
        }
    ?>

    <a href="gestion_client.php?id_client=nouveau">ajouter client</a>
    <br>
    <br>

    <?php
    try {
        $requete = 'select * FROM client join type_client using(id_type_client) order by nom';
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
                echo ('<tbody>');
        while ($client = $resultat->fetch()) {
            echo ('<tr>
                <td>'.$client['nom'].'</td>
                <td>'.$client['prenom'].'</td>
                <td>'.$client['adresse'].'</td>
                <td>'.$client['type_client'].'</td>
                <td><a href="gestion_client.php?id_client='.$client["id_client"].'">modifier client</a></td>
                <td><a href="reservation_client.php?id_client='.$client["id_client"].'">réservation client</a></td>
            </tr>');
    }
    echo ('</tbody></table>');
        
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