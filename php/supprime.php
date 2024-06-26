<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/supprime.css">
    <link rel="stylesheet" href="../css/basic.css">
    <title>Document</title>
</head>
<body>
  <?php
    include 'header.html';
  ?>

<div class="card-container">
<h1>Supprimer une voiture</h1>
      <a class="hero-image-container">
        <img class="hero-image" src="https://images7.alphacoders.com/460/thumb-1920-460370.jpg" />
      </a>
      <main class="main-content">
      <form action="validation.php" method="post"> <!-- bloc pour supprimer une voiture -->
        <div>
            <p>immatriculation :</p>
            <input name="immatriculation" type="text" minlength="11" maxlength="11" required>
        </div>

        <input name="supprimer" type="submit" value="supprimer">
    </form>
      </main>
    </div>
</div>
  </div>
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
    include 'footer.html';
  ?>
</body>
</html>