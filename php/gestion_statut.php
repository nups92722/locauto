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
    include 'header.html';
  ?>
<form action="" method="post"></form>
<?php
    $requete = 'SELECT * 
    FROM client join louer using(id_client) join etat_location using(id_etat) 
    where id_louer = '.$_GET['id_louer'].'';
    $resultat = $connexion->query($requete);
    $ligne = $resultat->fetch();
    if ($ligne['compteur_debut']){
        $compteur_debut = 'value="'.$ligne['compteur_debut'].'"';
    } else {
        $compteur_debut = '';
    }
    if ($ligne['compteur_fin']){
        $compteur_fin = 'value="'.$ligne['compteur_fin'].'"';
    } else {
        $compteur_fin = '';
    }
            echo ('<form action="location.php?id_louer='.$_GET['id_louer'].'" method="post"><p>client'.$ligne['nom'].' '.$ligne['prenom'].'</p>
            <p>loue la voiture '.$ligne['immatriculation'].'</p>
            <p>remplir le compteur de depart</p>
            <input '.$compteur_debut.' name="compteur_debut" type="number">
            <p>remplir le compteur de fin</p>
            <input '.$compteur_fin.' name="compteur_fin" type="number">');
            $requete = 'SELECT * FROM etat_location';
                        $resultat = $connexion->query($requete);
                        $liste_modele = '<select name="etat">';

                        while ($ligne = $resultat->fetch()) {
                            $liste_modele .= '<option value="'.$ligne['id_etat'].'">'.$ligne['etat'].'</option>';
                        }
                        $liste_modele .= '</select>';
                        echo ($liste_modele);
            echo ('<input class="valider" name="valider" type="submit" value="valider">
            </form>');
    ?>
<?php
    include 'footer.html';
  ?>
</body>
</html>