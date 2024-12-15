<?php
session_start();
// INTEGRATION DES PAGES connect, header et menu
include "traitement/connect.php";
include "bases/header.php";
include "bases/menu.php";

// RECUPERATION DE LA PAGE
$page = $_GET["page"] ?? "accueil";

// SWITCH DE PAGES
switch ($page) {

    // PAGES LIEES AUX PRODUITS
    case "accueil":
        include "pages/accueil.html";
        break;

    case "pizzas":
        include "pages/pizzas.php";
        break;

    case "contact":
        include "pages/contact.html";
        break;

     case "mail":
        include "traitement/mail.php";
        break;

    case "panier":
        include "pages/panier.php";
        break;
    case "admin":
        include "pages/admin.php";
        break;        
    

    case "connexion":
        include "pages/connexion.php";
        break;

    case "user":
        include "traitement/user.php";
        break;
    case "delete_pizza":
        include "traitement/delete_pizza.php";
        break;
    case "create_pizza":
        include "traitement/create_pizza.php";
        break;
    default:
        include "pages/accueil.html";
        break;
        
}

// INTEGRATION DE LA PAGE footer
include "bases/footer.php";