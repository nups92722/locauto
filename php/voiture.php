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
    try {
            session_start();
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

    <form action="accueil.php" method="post">
    <?php
    $_SESSION['location']['id_modele'] = $_GET["modele"];
    $_SESSION['location']['date_debut'] = $_SESSION['date_debut'];
    $_SESSION['location']['date_fin'] = $_SESSION['date_fin'];

        echo ('<p>date debut location : '.$_SESSION['date_debut'].'</p>
        <p>date fin location : '.$_SESSION['date_fin'].'</p>');
        ?>
    <?php

    $requete = 'select *
        from modele join marque using (id_marque)
        where id_modele = '.$_GET["modele"].'';
    $resultat = $connexion->query($requete);
    $voiture = $resultat->fetch();
        echo ('<div class="vehicle">');
        echo ('<img src="../image/'.$voiture["imagee"].'" alt="Voiture">');
        echo ('<h3>Modèle : '.$voiture["modele"].'</h3>');
        echo ('<p>Marque : '.$voiture["marque"].'</p>');
        echo ('</div>');

$requete ='select * from type_motorisation where id_type_motorisation in (select distinct id_type_motorisation
from voiture
where id_modele = '.$_GET["modele"].' and immatriculation not in
(select distinct immatriculation
from voiture left join louer using (immatriculation)
where not (date_debut > "'.$_SESSION['date_fin'].'" or date_fin < "'.$_SESSION['date_debut'].'") and '.$_GET["modele"].' = id_modele))';

$resultat = $connexion->query($requete);
$liste_modele = '<select name="motorisation">';

while ($ligne = $resultat->fetch()) {
    $liste_modele .= '<option value="'.$ligne['id_type_motorisation'].'">'.$ligne['motorisation'].'</option>';
}
$liste_modele .= '</select>';
echo ($liste_modele);
    ?>
    <br>
    <br>
        <input name="reservation" value="reservation" type="submit"></input>
        </form>
    <?php
        include 'footer.html';
    ?>

</body>
</html>