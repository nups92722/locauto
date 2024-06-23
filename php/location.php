<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" href="../css/basic.css">
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
    if(isset($_POST['valider'])){
        $requete = 'UPDATE louer set compteur_debut = "'.$_POST['compteur_debut'].'", compteur_fin = "'.$_POST['compteur_fin'].'", id_etat = '.$_POST['etat'].' where id_louer = '.$_GET['id_louer'].'';
    $resultat = $connexion->query($requete);
    }
  ?>

<?php
    include 'header.html';
  ?>

<?php
    $requete = 'SELECT * FROM client join louer using(id_client) join etat_location using(id_etat)';
    $resultat = $connexion->query($requete);
    echo ('<table>
                <thead>
                    <tr>
                    <th>nom</th>
                    <th>prenom</th>
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
            <td>'.$ligne['nom'].'</td>
            <td>'.$ligne['prenom'].'</td>
                <td>'.$ligne['immatriculation'].'</td>
                <td>'.$ligne['date_debut'].'</td>
                <td>'.$ligne['compteur_debut'].'</td>
                <td>'.$ligne['date_fin'].'</td>
                <td>'.$ligne['compteur_fin'].'</td>
                <td>'.$ligne['etat'].'</td>
                <td><a href="gestion_statut.php?id_louer='.$ligne["id_louer"].'" class="btn">gestion status</a></td>
            </tr>');
        }
        echo ('</tbody></table>');
    ?>

<?php
    include 'footer.html';
  ?>
</body>
</html>