<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gestion_client.css">
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
if ($_GET['id_client'] == "nouveau") {
    echo ('<form action="client.php" method="post">
    <p>nom</p>
    <input name="nom" type="text">
    <p>prenom</p>
    <input name="prenom" type="text">
    <p>adresse</p>
    <input name="adresse" type="text">
    <p>type client</p>');
    $requete = 'SELECT * FROM type_client';
    $resultat = $connexion->query($requete);
    $type_client = '<select name="type_client">';

    while ($ligne = $resultat->fetch()) {
      $type_client .= '<option value="'.$ligne['id_type_client'].'">'.$ligne['type_client'].'</option>';
    }
    $type_client .= '</select>';
    echo ($type_client);
    echo ('
    <br>
    <br>
    <button name="ajouter" type="submit" value="ajouter">ajouter</button>
  </form>');
} else {  
    $requete = 'select * FROM client join type_client using(id_type_client) where id_client = '.$_GET['id_client'].'';
    $resultat = $connexion->query($requete);
    $client = $resultat->fetch();
    echo ('<form action="client.php" method="post">
    <input name="id" type="hidden" value="'.$_GET['id_client'].'">
    <p class="p">Nom</p>
    <input name="nom" type="text" value="'.$client['nom'].'">
    <p>Prenom</p>
    <input name="prenom" type="text" value="'.$client['prenom'].'">
    <p>Adresse</p>
    <input name="adresse" type="text" value="'.$client['adresse'].'">
    <p>Type Client</p>');
    $requete = 'SELECT * FROM type_client';
    $resultat = $connexion->query($requete);
    $type_client = '<select name="type_client">';

    while ($ligne = $resultat->fetch()) {
      if ($client['id_type_client'] == $ligne['id_type_client']){
        $select = "selected";
      } else {
        $select = "selected";
      }
      $type_client .= '<option value="'.$ligne['id_type_client'].'"'.$select.'>'.$ligne['type_client'].'</option>';
    }
    $type_client .= '</select>';
    echo ($type_client);
    echo ('
    <br>
    <br>
    <button name="modifier" type="submit" value="modifier">modifier</button>
  </form>');
}
?>

<?php
    include 'footer.html';
  ?>
</body>
</html>