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
            <h2>modele</h2>

            <div id="modele" class="tab_block">
                <ul class="menu_tab"> <!-- bloc de selection pour le cas modele existant/nouveau -->
                    <li class="tab selected">selectionner un modele</li>
                    <li class="tab">nouveau modele</li>
                </ul>

                <div class="content_tab"> <!-- bloc de selection de modele existant -->
                    <p>selectionner le modele</p>

                    <?php // creation du bloc selection des modeles
                        try {
                            $requete = 'SELECT * FROM modele ORDER BY modele';
                            $resultat = $connexion->query($requete);
                            $liste_modele = '<select id="e" id="ef">';

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
                    <p>nom modele :</p>
                    <input name="modele" type="text" disabled>
                    
                    <p>nombre de place :</p>
                    <input name="number" type="number" disabled>

                    <div id="categorie" class="tab_block"> <!-- bloc de selection pour le cas categorie existant/nouveau -->
                        <ul class="menu_tab">
                            <li class="tab selected">categorie</li>
                            <li class="tab">nouvelle categorie</li>
                        </ul>

                        <div class="content_tab"> <!-- bloc de selection de categorie existante -->
                            <p>selectionner le modele</p>

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
                            <p>nom categorie :</p>
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
            <div id="motorisation" class="tab_block"> <!-- bloc de selection pour le cas type existant/nouveau -->
                <input type="checkbox" name="new_motorisation" id="new_motorisation" class="check_selected_tab invisible "><!-- checkbox pour verifier si c'est une nouvelle motorisation -->

                <p>motorisation :</p>

                <ul class="menu_tab">
                    <li class="tab selected">type</li>
                    <li class="tab">nouveau type</li>
                </ul>

                <div class="content_tab"> <!-- bloc de selection de type existant -->
                    <p>selectionner le type</p>

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
                    <p>nom type :</p>
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
                <p>immatriculation :</p>
                <input name="immatriculation" type="text" minlength="13" maxlength="13" required>
            </div>

            <div>
                <p>compteur :</p>
                <input name="compteur" type="number" required>
            </div>
        </div>

        <input name="submit" type="submit" value="valider">
    </form>
</body>
</html>