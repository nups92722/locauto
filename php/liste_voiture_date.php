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