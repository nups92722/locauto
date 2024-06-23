<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/accueil.css">
    <link rel="stylesheet" href="../css/basic.css">
    <script src="../js/accueil.js"></script>
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
    $_SESSION['location'] = [
        "id_client" => $_GET["id_client"],
        "id_modele" => null,
        "date_debut" => null,
        "date_fin" => null
    ];
  include 'liste_voiture_date.php';
?>

<?php
    include 'footer.html';
  ?>
    
</body>
</html>