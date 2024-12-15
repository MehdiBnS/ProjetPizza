<?php
// RECHERCHE OU LECTURE DES PIZZAS


$search = $_POST['search'] ?? null;
if ($search) {
    // LECTURE DES PRODUITS CORRESPONDANTS A LA RECHERCHE
    $requete = "SELECT pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix,
    GROUP_CONCAT(ingredient.name ORDER BY ingredient.name ASC) AS ingredients
    FROM pizza
    JOIN recette ON pizza.idpizza = recette.idpizza
    JOIN ingredient ON recette.idingredient = ingredient.idingredient
    WHERE pizza.idpizza IN (
        SELECT DISTINCT pizza.idpizza
        FROM pizza
        JOIN recette ON pizza.idpizza = recette.idpizza
        JOIN ingredient ON recette.idingredient = ingredient.idingredient
        WHERE pizza.nom LIKE '%" . $search . "%'
        OR ingredient.name LIKE '%" . $search . "%'
    )
    GROUP BY pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix";
    $resultat = $connexion->query($requete);
    $pizzas = $resultat->fetchall(PDO::FETCH_ASSOC);
} else {
    // LECTURE DE LA LISTE DES PIZZAS
    $requete = "SELECT pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix,
        GROUP_CONCAT(ingredient.name ORDER BY ingredient.name ASC) AS ingredients
        FROM pizza
        JOIN recette ON pizza.idpizza = recette.idpizza
        JOIN ingredient ON recette.idingredient = ingredient.idingredient
        GROUP BY pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix";
    $resultat = $connexion->query($requete);
    $pizzas = $resultat->fetchall(PDO::FETCH_ASSOC);
    
    foreach ($pizzas as $pizza) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();  // Initialiser le panier comme un tableau vide
        }
        if (!isset($_SESSION['panier'][$pizza['idpizza']])) {
            $_SESSION['panier'][$pizza['idpizza']] = [
                'idpizza' => $pizza['idpizza'],
                'nom' => $pizza['nom'],
                'lienphoto' => $pizza['lienphoto'],
                'prix' => $pizza['prix']
            ];
        }
    }
}
?>
<section>
    <h1 style="text-align: center; color:white">Nos pizzas</h1>
    <!-- FORMULAIRE DE RECHERCHE -->
    <form class=recherche method="post" action="#">
        <!-- CHAMP DE RECHERCHE -->
        <label id="searchbarre" for="search"></i></label>
        <input type="text" id="search" name="search" placeholder="Rechercher...">
        <!-- BOUTON D'ENVOI -->
        <button id="searchbutton" type="submit"><i style="color:white;" class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <!-- BOX DES PIZZAS -->
    <div class=conteneur>
        <?php
        if (empty($pizzas)) {
            echo "<p style='font-size:20px;'> Aucun article correspondant à votre recherche</p>";
        }
        else {
        foreach ($pizzas as $pizza) {
            echo "<div class=box>";
            echo "<div>";
            echo "<img class='proto' src='" . $pizza['lienphoto'] . "' alt=''>";
            echo "</div>";
            echo "<h2 class='melange'>" . $pizza['nom'] . "    " . $pizza['prix']. "€" . "<span class='spec'>Ingrédients : " . implode(", ", explode(",", $pizza['ingredients'])) . "</span></h2>";
            // explode, on divise la chaine de caractère dans une tableau avec un séparateur
            // implode permet joindre un tableau en une chaine de caracatère avec un séparateur
            echo"<div id='pizzabox'>"; //<p>" .$pizza['prix'] . "€</p>";
            echo "<form class='formulaire' method='post' action='index.php?page=panier&idpizza=" . $pizza['idpizza'] . "'>";
            //echo "<label style='color:white;'for='quantite'>Quantité</label>";
            //echo "<input type='number' id='quantite' name='quantite' value=" . $pizza['quantite'] . ">";
            echo "<input id='add' type='submit' value='Ajouter au panier'>";
            echo "</form> </div>";
            echo "</div>";
        }
    }
        ?>
    </div>
</section>
        ?>
    </div>
</section>
<style>
    .proto {
        position: relative;
        display: flex;
        width: 100%;

    }

    .melange {
        display: flex;
        flex-direction: column;
        text-align: center;
        gap: 50px;
        position: absolute;
        padding: 0;
        bottom: 45px;
        z-index: 999999;
        margin: 2px;
        right: 0;
        left: 0;
        background-color: black;
        width: 100%;
        justify-content: center;
        opacity: 80%;
    }

    .spec {
        display: none;
        padding-bottom: 25px;
        color: white;
        text-align: center;
    }

    .melange:hover .spec {
        display: block;


    }

    p,
    h2 {
        color: white;
    }

    .recherche {
        display: flex;
        gap: 10px;
        justify-content: center;
        width: 100%;
    }

    #search {
        width: 30%;
        height: 30px;
        border-radius: 25px;
        border: none;
        text-align:left;
        padding-left: 15px;
    }
    #searchbutton {
        width: 5%;
        border-radius: 25px;
        border: none;
        background-color: #a34b03;
        cursor: pointer;
    }


    .conteneur {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 2em;

        margin: 2em 0;
    }

    .box {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;

        width: 350px;
    }

    #pizzabox {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 50px;
        
       
    }

    #quantite {
        width: 20px;
        height: 10px;
    }
    .formulaire {
        
        align-items: center;
        gap: 20px;
        width: 100%;
    }
   #add {
    
    background-color: #a34b03;
    color: white;
    border: none;
    gap :100px;
    height: 50px;
    width: 100%;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 20px;
   }
   #espace {
    gap: 20px;
   }

   #add:hover {
    background-color:#a40b03;
    

   }
</style>