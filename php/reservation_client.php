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
session_start();

try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // ajouter le nom de la base de donne
    $aujourdhui = new DateTime();
    $date = $aujourdhui->format('Y-m-d');
    } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
<?php
  include 'header.html';
?>

<?php
    $requete = 'SELECT * FROM client join louer using (id_client) join etat_location using(id_etat) where id_client = '.$_GET['id_client'].' order by date_debut desc, date_fin desc';
    $resultat = $connexion->query($requete);
    echo ('client '.$_GET['id_client'].'');
    echo ('<br><br><a href="reservation_par_admin.php?id_client='.$_GET['id_client'].'">nouvelle reservation </a>');
    
    echo ('<table>
                <thead>
                    <tr>
                        <th>voiture</th>
                        <th>date debut</th>
                        <th>compteur debut</th>
                        <th>date fin</th>
                        <th>compteur fin</th>
                        <th>statut</th>
                    </tr>
                </thead>');
                echo ('<tbody>');
        while ($ligne = $resultat->fetch()) {
            echo ('<tr>
                <td>'.$ligne['immatriculation'].'</td>
                <td>'.$ligne['date_debut'].'</td>
                <td>'.$ligne['compteur_debut'].'</td>
                <td>'.$ligne['date_fin'].'</td>
                <td>'.$ligne['compteur_fin'].'</td>
                <td>'.$ligne['etat'].'</td>
            </tr>');
        }
        echo ('</tbody></table>');
    ?>
    
<?php
    include 'footer.html';
  ?>
</body>
</html>