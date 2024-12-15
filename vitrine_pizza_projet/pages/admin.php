<?php
// LECTURE DE LA LISTE DES PIZZAS
$requete = "SELECT pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix,
        GROUP_CONCAT(ingredient.name ORDER BY ingredient.name ASC) AS ingredients
        FROM pizza
        JOIN recette ON pizza.idpizza = recette.idpizza
        JOIN ingredient ON recette.idingredient = ingredient.idingredient
        GROUP BY pizza.idpizza, pizza.nom, pizza.lienphoto, pizza.prix";
$resultat = $connexion->query($requete);
$pizzas = $resultat->fetchall(PDO::FETCH_ASSOC);
?>
<div style="display: flex; flex-direction:column;height:auto;">
    <section style="background-color: white;font-family: sans-serif;">
        <h1>Créer une pizza</h1>
        <div id="creer">
            <form style='display:flex; gap:200px;' method='POST' action="index.php?page=create_pizza">
                <!-- <div style="display: flex;flex-direction:column;width:40%">
                    <label for="imgpizz"> Photo de la pizza</label>
                    <input type="file" name="imgpizz" accept="image/*">
                </div> -->
                <div>
                    <label for="lienphoto">Photo</label>
                    <input type="text" id='lienphoto' name="lienphoto" placeholder="Lien photo">
                </div>
                <div style="display: flex;flex-direction:column ">
                    <div style="display: flex;">
                        <label for="nom">Nom</label>
                        <input type="text" id='nom' name="nom" placeholder="Nom">
                        <label for="prix">Prix</label>
                        <input type="number" name="prix" placeholder="Prix">
                    </div>
                    <div>
                        <label for="ingredients">Ingrédients</label>
                        <input type="text" name="ingredients" placeholder="Ingrédients">
                    </div>
                </div>
                <div style="display: flex; margin:20px;">
                    <input id='buttonsend' style='background-color:#a34b03;color:white; border:none; border-radius:25px' type="submit" value="Créer la pizza">
                </div>
            </form>
        </div>
    </section>
</div>
<section id="modifsupp">
    <h1>Modifier ou supprimer une pizza</h1>
    <div style="display: flex; flex-direction:column; gap:40px">
    <?php
    foreach ($pizzas as $pizza) {
        echo "<form action='/upload' method='POST' enctype='multipart/form-data'>";
        // PHOTO
        echo"<div style='display:flex;gap:100px;width:100%'>";
        echo"<div style='display:flex; align-items:center;'>";
        echo "<img src='" . $pizza['lienphoto'] . "' alt='Photo actuelle' style='width: 150px'>";
        echo"<div style='display:flex;'>";
        echo "<label for='photo'>Modifier la photo : </label>";
        echo "<input type='file' id='photo' name='photo' accept='image/*'></div></div>";
        // NOM
        echo"<div style='display:flex; justify-content:center;flex-direction:column; align-items:center'>";
        echo"<div>";
        echo "<label for='nom'>Nom : </label>";
        echo "<input type='text' id='nom' name='nom' value='" . $pizza['nom'] . "'>";
        // PRIX
        echo "<label for='prix'>Prix : </label>";
        echo "<input type='number' id='prix' name='prix' value='" . $pizza['prix'] . "'></div>";
        // INGREDIENTS
        echo "<div style='display:flex;justify-content:center;width:100%;'>";
        echo "<label for='ingredients'>Ingrédients : </label>";
        echo "<input type='text' id='ingredients' name='ingredients' value='" . $pizza['ingredients'] . "'></div></div>";
        //BOUTON UPDATE
        echo "<div style='display:flex; justify-content:center;align-items:center;gap:10px;>";
        echo "<button type='submit'><i style='color:blue; cursor:pointer;'' class='fa-solid fa-pen-to-square'></i></button>";
        echo " / ";
        //BOUTON DELETE
        echo "<a href='index.php?page=delete_pizza&idpizza=" . $pizza['idpizza'] . "'><i style='color:red;cursor:pointer;' class='fa-solid fa-trash'></i></a></div></div>";
        echo "</form>";
    }
    ?>
    </div>
</section>
</div>
<style>
    #modifsupp {
        background-color: white;
        font-family: sans-serif;

    }
    #creer {
        background-color: white;
        border-bottom: solid 3px black;
        padding-bottom: 10px;
        align-items: center;
        height: 200px;
        width: 100%;
        display: flex;
        font-family: sans-serif;
    }
    #buttonsend:hover {
        background-color: red;
        cursor: pointer;
    }
</style>