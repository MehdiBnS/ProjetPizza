<section id="panier-contain">
    <div id="recap">
        <h1 class='titlep'>Récapitulatif de la commande</h1>

<?php

// DESTROY
if (isset($_POST['annuler'])) {
    unset($_SESSION['panier']);
    exit();
     }


// PLUS MOINS
if (isset($_GET['id_pizza'])) {
    $idpizza = $_GET['id_pizza'];
    $operation = $_GET['operation'];
    if ($operation == 1) {
        $_SESSION['panier'][$idpizza]['quantite'] += 1;
        //header('location: index.php?page=panier');
        echo "<script>window.location.href = 'index.php?page=panier'</script>";
    } else {
        // 
        $_SESSION['panier'][$idpizza]['quantite'] -= 1;
        if ($_SESSION['panier'][$idpizza]['quantite'] == 0) {
            unset($_SESSION['panier'][$idpizza]['quantite']);
        }
       // header('location: index.php?page=panier');
        echo "<script>window.location.href = 'index.php?page=panier'</script>";
    }
}     

// TRAITEMENT DU PANIER
if (isset($_GET['idpizza'])) {
    $idpizza = $_GET['idpizza']; 
    // 
    if (isset($_SESSION['panier'][$idpizza]['quantite'])) {
        $_SESSION['panier'][$idpizza]['quantite'] += 1;
    } else {
        // 
        $_SESSION['panier'][$idpizza]['quantite'] = 1;
    }
}


// CREATION DU PANIER
$panier = $_SESSION['panier'] ?? null;
if ($panier) {
foreach ($panier as $pizza) {
    if (isset($pizza['quantite'])) {

    
    echo "<div>";

    echo "<div style='display:flex; justify-content:space-between; margin : 30px; border-bottom:solid 2px black'>";
    echo "<img style='width:15%' src='" . $pizza['lienphoto'] . "' alt=''>";
    echo "<h2>" . $pizza['nom'] . "</h2>";
    echo "<p>" . $pizza['prix'] . "€</p>";
    echo "<p><a href='index.php?page=panier&id_pizza=". $pizza['idpizza'] . "&operation=0'><i style='color:#a34b03;'class='fa-solid fa-minus'></i></a> " . $pizza['quantite'] . " <a href='index.php?page=panier&id_pizza=". $pizza['idpizza'] . "&operation=1'><i style='color:#a34b03;'class='fa-solid fa-plus'></i></a></p>";
    echo "</div>";
echo "</div>";
    }
}
}

?>
    </div>
    <div id="panier">
        <h1 class='titlep'>Votre panier</h1>
       <?php 
       $fdp = 2.99;
       $soustotal = 0;
       if ($panier) {
foreach ($panier as $pizza) {
    if (isset($pizza['quantite'])) {
echo "<div style='border-bottom:solid 2px black;' >";
    //$requete = "SELECT idpizza, nom, lienphoto, prix
       // FROM pizza
       // WHERE pizza.idpizza = $idpizza";
       // $resultat = $connexion->query($requete);
      //  $pizza = $resultat->fetch(PDO::FETCH_ASSOC);
    
    $montantht = $pizza['quantite'] * $pizza['prix'];
    $montantttc = $montantht + $fdp;
    $soustotal += $montantttc;

    echo "<h2> Nom : " . $pizza['nom'] . "</h2>";
    echo "<p> Montant HT : " .$montantht. "€</p>";
    echo "<p> Frais de livraison : " .$fdp . "€</p>";
    echo "<p> Montant TTC : " . $montantttc ."€</p>";
    echo "</div>"; 
    }
}
       }

    echo "<h2>Total : " .$soustotal. "€</h2>";
?>
<form id="buttondestroy" method='POST' action="index.php?page=panier">
<button id='destroy' type="submit" name="annuler"> Annuler la commande</button>
</form>
</div>
</section>




<style>
    #panier-contain {
        display: flex;
        width: 100%;
        justify-content: space-around;
    }
    #recap {
        width: 60%;
        height: auto;
        background-color: white;
        border: solid 3px grey;
    }
    #panier {
        width: 30%;
        height: auto;
        background-color: white;
        border: solid 3px grey;
    }
    .titlep {
        color: black;
        padding-left: 20px;
        border-bottom: solid 1px black;
        padding-bottom: 10px;
    }
    #buttondestroy {
        display: flex;
        justify-content: center;
    }
    #destroy {
        font-size: 15px;
        height: 40px ;
        width: 50%;
        border: none ;
        border-radius: 25px;
        color: white;
        background-color:#a34b03; 
    }
    #destroy:hover {
        background-color: #a40b03;
        cursor: pointer;
    }