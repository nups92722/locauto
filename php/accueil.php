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
      unset($_SESSION['date_debut'], $_SESSION['date_fin']);
      
      try {
        if (isset($_POST['date'])) {
          $_SESSION['date_debut'] = $_POST['date_debut'];
          $_SESSION['date_fin'] = $_POST['date_fin'];
        } else {
          $_SESSION['date_debut'] = $date;
          $_SESSION['date_fin'] = $date;
        }
        if (isset($_POST['valider'])) {
          if (isset($_SESSION['retirer'])) {
            $requete = 'SELECT * FROM voiture WHERE immatriculation = "'.$_SESSION['retirer'].'"';
            $resultat = $connexion->query($requete);
            $ligne = $resultat->fetch();
            $id_modele = $ligne['id_modele'];
            $id_type_motorisation = $ligne['id_type_motorisation'];

            $requete = 'SELECT * FROM motorisation_existante WHERE id_modele = '.$id_modele.' and id_type_motorisation = '.$id_type_motorisation.'';
            $resultat = $connexion->query($requete);
            $ligne = $resultat->fetch();

            if ($ligne['nb_voiture'] > 1) {
              $requete = 'UPDATE motorisation_existante SET nb_voiture = '.$ligne['nb_voiture'].' - 1 WHERE id_modele = '.$id_modele.' and id_type_motorisation = '.$id_type_motorisation.'';
              $resultat = $connexion->query($requete);
            } else {
              $requete = 'DELETE FROM motorisation_existante WHERE id_modele = '.$id_modele.' and id_type_motorisation = '.$id_type_motorisation.'';
              $resultat = $connexion->query($requete);
            }
            $requete = 'DELETE FROM voiture WHERE immatriculation = "'.$_SESSION['retirer'].'"';
            $resultat = $connexion->query($requete);
            unset($_SESSION['retirer']);
          }

          if (isset($_SESSION['immatriculation'])) {
            if (isset($_SESSION['nouvelle_motorisation'])) {
              $requete = 'INSERT INTO type_motorisation (motorisation) VALUES ("'.$_SESSION['nouvelle_motorisation'].'")';
              $resultat = $connexion->query($requete);
              unset($_SESSION['nouvelle_motorisation']);
              $_SESSION['motorisation'] = $connexion->lastInsertId();
            }

            if (isset($_SESSION['nouveau_modele'])) {
              if (isset($_SESSION['nouvelle_categorie'])) {
                $requete = 'INSERT INTO categorie (categorie, prix) VALUES ("'.$_SESSION['nouvelle_categorie'].'", 10)';
                $resultat = $connexion->query($requete);
                unset($_SESSION['nouvelle_categorie']);
                $_SESSION['categorie'] = $connexion->lastInsertId();
              }
              if (isset($_SESSION['nouvelle_marque'])) {
                $requete = 'INSERT INTO marque (marque) VALUES ("'.$_SESSION['nouvelle_marque'].'")';
                $resultat = $connexion->query($requete);
                unset($_SESSION['nouvelle_marque']);
                $_SESSION['marque'] = $connexion->lastInsertId();
              }
              $requete = 'INSERT INTO modele (id_marque, modele, imagee, nb_de_place, id_categorie) VALUES ('.$_SESSION['marque'].', "'.$_SESSION['nouveau_modele'].'", "dd", '.$_SESSION['nombre_place'].', '.$_SESSION['categorie'].')';
              $resultat = $connexion->query($requete);
              unset($_SESSION['marque'], $_SESSION['nouveau_modele'], $_SESSION['nombre_place'], $_SESSION['categorie']);
              $_SESSION['modele'] = $connexion->lastInsertId();
              }



              $requete = 'INSERT INTO voiture (immatriculation, compteur, id_modele, id_type_motorisation) VALUES ("'.$_SESSION['immatriculation'].'", '.$_SESSION['compteur'].', '.$_SESSION['modele'].', '.$_SESSION['motorisation'].')';
              $resultat = $connexion->query($requete);

              $requete = 'SELECT * FROM motorisation_existante JOIN voiture USING (id_modele, id_type_motorisation) WHERE id_modele = '.$_SESSION['modele'].' and id_type_motorisation = '.$_SESSION['motorisation'].'';
              $resultat = $connexion->query($requete);
              if ($ligne = $resultat->fetch()) {
                $requete = 'UPDATE motorisation_existante SET nb_voiture = '.$ligne['nb_voiture'].' + 1 WHERE id_modele = '.$_SESSION['modele'].' and id_type_motorisation = '.$_SESSION['motorisation'].'';
                $resultat = $connexion->query($requete);
              } else {
                $requete = 'INSERT INTO motorisation_existante (id_modele, id_type_motorisation, nb_voiture) VALUES ('.$_SESSION['modele'].', '.$_SESSION['motorisation'].', 1)';
                $resultat = $connexion->query($requete);
              }
              unset($_SESSION['immatriculation'], $_SESSION['compteur'], $_SESSION['modele'], $_SESSION['motorisation']);
            }
          }
        } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
      }
    ?>

<?php
  include 'header.html';
?>

<div class="hero">
  <div class="hero__bg">
    <picture>
      <img src="../image/hero1.jpg">
    </picture>
  </div>

  <div class="hero__cnt">
  <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="140.000000pt" height="108.000000pt" viewBox="0 0 140.000000 108.000000" preserveAspectRatio="xMidYMid meet">

<g transform="translate(0.000000,108.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
<path d="M541 1015 c-87 -30 -139 -65 -202 -131 -93 -101 -133 -202 -132 -339 1 -150 52 -266 161 -366 32 -29 84 -65 116 -80 71 -34 68 -35 -114 -44 -69 -4 -172 -12 -230 -19 -94 -12 -35 -14 560 -14 366 0 661 1 655 3 -18 7 -338 35 -401 35 -96 0 -103 8 -37 40 69 32 159 112 202 178 52 82 74 156 74 257 1 145 -38 248 -132 349 -99 105 -192 147 -341 153 -93 3 -113 1 -179 -22z m334 -98 c87 -42 155 -109 198 -196 30 -62 32 -72 32 -176 0 -99 -3 -116 -27 -168 -40 -85 -123 -167 -211 -208 -66 -30 -80 -33 -167 -33 -86 -1 -101 2 -163 31 -89 42 -166 116 -208 201 -32 64 -34 72 -34 177 0 99 3 116 27 168 51 109 179 213 290 237 80 17 186 3 263 -33z"/>
<path d="M624 920 c-238 -47 -370 -312 -266 -534 72 -153 228 -238 397 -215 122 16 241 104 293 217 23 50 27 70 27 157 0 93 -2 105 -33 167 -77 157 -247 242 -418 208z m86 -115 c0 -57 -4 -95 -10 -95 -6 0 -10 38 -10 95 0 57 4 95 10 95 6 0 10 -38 10 -95z m-83 27 c28 -55 40 -146 23 -167 -24 -29 -57 -17 -119 43 -68 64 -77 94 -38 130 58 54 104 52 134 -6z m230 37 c41 -15 73 -49 73 -78 0 -33 -109 -141 -143 -141 -48 0 -57 35 -33 128 17 62 41 102 61 102 7 0 26 -5 42 -11z m-381 -180 c72 -39 91 -55 81 -65 -7 -8 -167 86 -167 97 0 14 8 11 86 -32z m534 31 c0 -5 -31 -27 -69 -50 -84 -48 -101 -55 -101 -41 0 10 146 101 162 101 5 0 8 -4 8 -10z m-290 -76 c0 -9 -7 -14 -17 -12 -25 5 -28 28 -4 28 12 0 21 -6 21 -16z m-200 -47 c38 -19 45 -26 45 -52 0 -24 -7 -33 -36 -47 -19 -10 -62 -23 -94 -30 -55 -11 -59 -10 -77 11 -23 29 -24 98 -2 130 15 21 22 23 68 17 28 -4 71 -17 96 -29z m522 16 c25 -22 25 -102 0 -134 -18 -21 -22 -22 -77 -11 -86 18 -129 41 -133 74 -4 32 26 55 96 74 65 17 92 17 114 -3z m-412 -18 c0 -8 -7 -15 -15 -15 -8 0 -15 7 -15 15 0 8 7 15 15 15 8 0 15 -7 15 -15z m173 0 c1 -5 -6 -11 -15 -13 -11 -2 -18 3 -18 13 0 17 30 18 33 0z m-69 -11 c24 -24 20 -61 -9 -80 -23 -15 -27 -15 -50 0 -29 19 -32 51 -8 78 20 22 46 23 67 2z m-104 -90 c0 -8 -7 -14 -15 -14 -15 0 -21 21 -9 33 10 9 24 -2 24 -19z m174 -5 c-8 -14 -34 -11 -34 4 0 8 3 17 7 20 9 9 34 -13 27 -24z m-244 -29 c0 -5 -31 -27 -69 -50 -84 -48 -101 -55 -101 -41 0 10 146 101 162 101 5 0 8 -4 8 -10z m158 -13 c2 -10 -3 -17 -12 -17 -18 0 -29 16 -21 31 9 14 29 6 33 -14z m207 -17 c74 -43 92 -57 83 -66 -8 -7 -168 86 -168 97 0 16 16 10 85 -31z m-275 -5 c28 -34 -17 -196 -58 -210 -12 -3 -35 1 -54 11 -89 45 -90 76 -8 156 61 60 96 72 120 43z m221 -42 c43 -41 59 -63 59 -83 0 -49 -86 -103 -128 -81 -36 19 -76 178 -52 206 24 29 59 17 121 -42z m-161 -98 c0 -57 -4 -95 -10 -95 -6 0 -10 38 -10 95 0 57 4 95 10 95 6 0 10 -38 10 -95z"/>
</g>
</svg>
    <h1>Locauto</h1>
  </div>
</div>
    <section class="test_hero">
    <div class="main">
  <h1>Toute nos games de véhicules <div class="roller">
    <span id="rolltext">BMW<br/>
    MERCEDES<br/>
    FERRARI...<br/>
    <span id="spare-time">Tout ça disponible dès à présent!</span><br/>
    </div>
    </h1>
    
  </div>
        <div class="container1">
  <div class="content">
    <svg id="more-arrows">
      <polygon class="arrow-top" points="37.6,27.9 1.8,1.3 3.3,0 37.6,25.3 71.9,0 73.7,1.3 "/>
      <polygon class="arrow-middle" points="37.6,45.8 0.8,18.7 4.4,16.4 37.6,41.2 71.2,16.4 74.5,18.7 "/>
      <polygon class="arrow-bottom" points="37.6,64 0,36.1 5.1,32.8 37.6,56.8 70.4,32.8 75.5,36.1 "/>
    </svg>
  </div>
</div>
    </section>

      <div>
      <form action="accueil.php" method="post">
        <p>date debut location</p>
        <?php
        echo ('<input type="date" name="date_debut" value="'.$_SESSION['date_debut'].'" min="'.$date.'">');
        ?>
        <p>date fin location</p>
        <?php
          echo ('<input type="date" name="date_fin" value="'.$_SESSION['date_fin'].'" min="'.$date.'">');
        ?>
        <input name="date" type="submit" value="date">
    </form>

    <?php // creation du bloc selection des marques
      try {
          $requete = 'SELECT * FROM marque ORDER BY marque';
          $resultat = $connexion->query($requete);
          $liste_modele = '<select name="brand">';
          $liste_modele .= '<option value="toute">Toute</option>';
 
          while ($ligne = $resultat->fetch()) {
              $liste_modele .= '<option value="'.$ligne['id_marque'].'">'.$ligne['marque'].'</option>';
          }
          $liste_modele .= '</select>';
          echo ($liste_modele);
      } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage() . "<br/>";
          die();
      }
    ?>
      </div>

    <section class="vehicles">
    <?php
    try {
        $requete = 'select *
from modele join marque using (id_marque)
where id_modele in (
select id_modele
from modele as m
where (select count(immatriculation) 
from voiture 
where id_modele = m.id_modele ) 
>
(select count(distinct immatriculation)
from voiture left join louer using (immatriculation)
where (not (date_debut > "'.$_SESSION['date_fin'].'" or date_fin < "'.$_SESSION['date_debut'].'")) and id_modele = m.id_modele))';
        $resultat = $connexion->query($requete);
        
        while ($voiture = $resultat->fetch()) {
            echo ('<div class="vehicle" data-idmarque="'.$voiture["id_marque"].'">');
            echo ('<img src="../image/'.$voiture["imagee"].'" alt="Voiture">');
            echo ('<h3>Modèle : '.$voiture["modele"].'</h3>');
            echo ('<p>Marque : '.$voiture["marque"].'</p>');
            echo ('<a href="voiture.php?modele='.$voiture["id_modele"].'" class="btn">Réserver</a>');
            echo ('</div>');
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    </section>

  <?php
    include 'footer.html';
  ?>
    
</body>
</html>

