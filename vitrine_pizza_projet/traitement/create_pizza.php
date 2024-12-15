<?php
// RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme
$lienphoto = $_POST['lienphoto'] ?? null;
$nom = $_POST['nom'] ?? null;
$prix = $_POST['prix'] ?? null;
$ingredients = $_POST['ingredients'] ?? null;
$ingredients = explode(",", $ingredients);
if (!$lienphoto || !$nom || !$prix || !$ingredients) {
    echo "<p>Paramètres non spécifiés ou manquants !</p>";
    exit;
}
// CREATION DE LA PIZZA EN BASE DE DONNEES
$requete = "INSERT INTO pizza VALUES (null, '$nom', '$lienphoto', $prix)";
var_dump($requete);
$resultat = $connexion->exec($requete);
// RECUPERATION DE L'ID DE LA DERNIERE PIZZA CREE
$idpizza = $connexion->lastInsertId();
if ($resultat) {
    foreach ($ingredients as $ingredient) {
        //
        $requete = "SELECT * FROM ingredient WHERE name = '" . $ingredient . "'";
        $resultat = $connexion->query($requete);
        $ingredientbdd = $resultat->fetch(PDO::FETCH_ASSOC);
        if ($ingredientbdd) {
            $idingredient = $ingredientbdd['idingredient'];
            // CREATION DE LA RECETTE EN BASE DE DONNEES
            $requete = "INSERT INTO recette VALUES (null, '$idpizza', '$idingredient')";
            $resultat = $connexion->exec($requete);
            if ($resultat) {
                echo "<p>Recette crée avec succès !</p>";
            } else {
                echo "<p>Erreur lors de la création de la recette' !</p>";
            }
            echo "<p>Ingrédient déja existant !</p>";
        } else {
            // CREATION DE L'INGREDIENT EN BASE DE DONNEES
            $requete = "INSERT INTO ingredient VALUES (null, '$ingredient')";
            $resultat = $connexion->exec($requete);
            // RECUPERATION DE L'ID DU DERNIER INGREDIENT CREE
            $idingredient = $connexion->lastInsertId();
            if ($resultat) {
                // CREATION DE LA RECETTE EN BASE DE DONNEES
                $requete = "INSERT INTO recette VALUES (null, '$idpizza', '$idingredient')";
                $resultat = $connexion->exec($requete);
                if ($resultat) {
                    echo "<p>Recette crée avec succès !</p>";
                } else {
                    echo "<p>Erreur lors de la création de la recette' !</p>";
                }
                echo "<p>Ingrédient crée avec succès !</p>";
            } else {
                echo "<p>Erreur lors de la création de l'ingrédient' !</p>";
            }
        }
    }
    echo "<p>Pizza crée avec succès !</p>";
} else {
    echo "<p>Erreur lors de la création de la pizza !</p>"; }