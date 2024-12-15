<?php

// RECUPERATION DE L'ID DE LA PIZZA A SUPPRIMER  
$idpizza = $_GET['idpizza']  ?? null;
if ($idpizza) {
   
    // SUPPRESSION DE LA PIZZA EN BASE DE DONNEES
    $requete = "DELETE FROM pizza WHERE idpizza = $idpizza";
    $resultat = $connexion->exec($requete);
    if ($resultat) {
        echo "<h1>Produit supprimé avec succès !</h1>";
    } else {
        echo "<h1>Erreur lors de la suppression du produit !</h1>";
    }
} else {
    echo "<h1>ID Produit non spécifié ou manquant !</h1>";
}