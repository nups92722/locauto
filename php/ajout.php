<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic.css">
    <link rel="stylesheet" href="../css/onglet.css">
    <script src="../js/onglet.js"></script>
    <script src="../js/ajout.js"></script>
    <title>Document</title>
</head>

<body>
<header class="header-outer">
	<div class="header-inner responsive-wrapper">
		<div class="header-logo">
			<img src="../image/logovrai.png" />
		</div>
		<nav class="header-navigation">
                <a href="accueil.php">Accueil</a>
                <a href="ajout.php">Ajouter voiture</a>
                <a href="supprime.php">Supprimer voiture</a>
			<button>Menu</button>
		</nav>
	</div>
</header>

    <?php
        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // ajouter le nom de la base de donne
            } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    ?>
    <h1>ajouter une voiture</h1>
   

    <form action="validation.php"> <!-- bloc pour ajouter une voiture -->
        <div> <!-- bloc modele de l'ajout de voiture -->
            <h2>Choix du modèle:</h2>

            <div id="modele" class="tab_block">
                <ul class="menu_tab"> <!-- bloc de selection pour le cas modele existant/nouveau -->
                    <li class="tab selected" style="--c:#E95A49">Sélectionner un modèle déjà existant</li>
                    <li class="tab" style="--c:#E95A49">Créer un nouveau modèle</li>
                </ul>

                <div class="content_tab"> <!-- bloc de selection de modele existant -->
                    <h3>Liste des modèles</h3>

                    <?php // creation du bloc selection des modeles
                        try {
                            $requete = 'SELECT * FROM modele ORDER BY modele';
                            $resultat = $connexion->query($requete);
                            $liste_modele = '<select>';

                            while ($ligne = $resultat->fetch()) {
                                $liste_modele .= '<option value="'.$ligne['id_modele'].'">'.$ligne['modele'].'</option>';
                            }
                            $liste_modele .= '</select>';
                            echo ($liste_modele);
                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage() . "<br/>";
                            die();
                        }
                    ?>
                </div>

                <div class="content_tab invisible"> <!-- bloc d'ajout dun nouveau modele -->
                    <h3>Nom modèle :</h3>
                    <input name="modele" type="text" disabled>
                    
                    <h3>Nombre de place :</h3>
                    <input name="number" type="number" disabled>

                    <div id="categorie" class="tab_block"> <!-- bloc de selection pour le cas categorie existant/nouveau -->
                        <ul class="menu_tab">
                            <li class="tab selected">Catégorie</li>
                            <li class="tab">Créer nouvelle catégorie</li>
                        </ul>

                        <div class="content_tab"> <!-- bloc de selection de categorie existante -->
                            <h3>Selectionner le modèle</h3>

                            <?php // creation du bloc selection des categories
                                try {
                                    $requete = 'SELECT * FROM categorie ORDER BY categorie';
                                    $resultat = $connexion->query($requete);
                                    $liste_modele = '<select id="d" id="ef" disabled>';

                                    while ($ligne = $resultat->fetch()) {
                                        $liste_modele .= '<option value="'.$ligne['id_categorie'].'">'.$ligne['categorie'].'</option>';
                                    }
                                    $liste_modele .= '</select>';
                                    echo ($liste_modele);
                                } catch (PDOException $e) {
                                    echo "Erreur : " . $e->getMessage() . "<br/>";
                                    die();
                                }
                            ?>
                        </div>
                        
                        <div class="content_tab invisible"> <!-- bloc d'ajout dune nouvelle categorie -->
                            <h3>Nom categorie :</h3>
                            <input name="categorie" type="text" disabled>
                        </div> 
                    </div>
                </div>
            </div>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br> 
                                                                                                    <br>  
                                                                                                    <br>  
                                                                                                    <br>  
                                                                                                    <br>  
                                                                                                    <br>  
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>

            <div id="motorisation" class="tab_block"> <!-- bloc de selection pour le cas type existant/nouveau -->
                <input type="checkbox" name="new_motorisation" id="new_motorisation" class="check_selected_tab invisible "><!-- checkbox pour verifier si c'est une nouvelle motorisation -->

                <h3>Motorisation :</h3>

                <ul class="menu_tab">
                    <li class="tab selected">Type</li>
                    <li class="tab">Nouveau type</li>
                </ul>

                <div class="content_tab"> <!-- bloc de selection de type existant -->
                    <h3>Selectionner le type</h3>

                    <?php // creation du bloc selection du types
                    try {
                        $requete = 'SELECT * FROM type_motorisation ORDER BY motorisation';
                        $resultat = $connexion->query($requete);
                        $liste_modele = '<select id="f" id="ef">';

                        while ($ligne = $resultat->fetch()) {
                            $liste_modele .= '<option value="'.$ligne['id_type_motorisation'].'">'.$ligne['motorisation'].'</option>';
                        }
                        $liste_modele .= '</select>';
                        echo ($liste_modele);
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage() . "<br/>";
                        die();
                    }
                    ?>
                </div>
                
                <div class="content_tab invisible"> <!-- bloc d'ajout dun nouveau type -->
                    <h3>Nom type :</h3>
                    <input name="motorisation" type="text" disabled>
                </div>
            </div>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
                                                                                                    <br>
            <div>
                <h3>Immatriculation :</h3>
                <input name="immatriculation" type="text" minlength="13" maxlength="13" required>
            </div>

            <div>
                <h3>Compteur :</h3>
                <input name="compteur" type="number" required>
            </div>
        </div>

        <input name="submit" type="submit" value="valider">
    </form>
</body>
</html>