<div style="background-color: white; width:30%; height:500px;">
<h1 style="text-align: center;">Connexion</h1>

<?php

// RECUPERATION DES DONNEES, OUVERTURE DE LA SESSION (Si session validée dans session.php)
$nom = $_SESSION['user']['nom'] ?? null;
$prenom = $_SESSION['user']['prenom'] ?? null;



if ($nom && $prenom) {
    echo "<p>Je m'appelle " . $prenom . " " . $nom . "</p>";
    echo "<a href='index.php?page=user&close=1'>Déconnexion</a>"; // Pour la fermeture de la session
} else if(empty($nom)&& empty($prenom)) {

    // PRESENTATION DU FORMULAIRE DE SESSION (Si session non active ou fermée)
?>  
    <h2 style="text-align: center;">Veuillez vous connecter</h2>

    <form id='connexionform' method="post" action="index.php?page=user">

        <!-- CHAMP NOM -->
        <label for="email">Votre email</label>
        <input type="text" id="email" name="email">

        <!-- CHAMP PRENOM -->
        <label for="password">Votre mot de passe</label>
        <input type="text" id="password" name="password">

        <!-- BOUTON D'ENVOI-->
        <input type="submit" value="Se connecter">
    </form>
    </div>
<?php } 
$naming= $_POST['naming'] ?? null;
$surnaming = $_POST['surnaming'] ?? null;
$mailing = $_POST['mailing'] ?? null;
$passwording =$_POST['passwording'] ?? null;
$statusing= $_POST['statusing'] ?? null;
var_dump($naming);
 if (empty($_POST['naming']) && empty($_POST['surnaming']) && empty($_POST['mailing']) && empty($_POST['passwording']) && empty($_POST['statusing'])) {
    $requete = "INSERT INTO user (nom, prenom, email, password, status)
    VALUES ('$naming' , '$surnaming', '$mailing' , '$passwording', '$statusing')";
    $resultat= $connexion -> exec($requete);
   

} else {
    
}

if ($nom && $prenom) {
    echo "<p>Je m'appelle " . $prenom . " " . $nom . "</p>";
    echo "<a href='index.php?page=user&close=1'>Déconnexion</a>"; // Pour la fermeture de la session

} else {
    ?> <h2>Créer un compte</h2>

    <form method='POST' action="index.php?page=connexion">
        <label for="naming">
            Nom :<input type='text' name='naming' placeholder="Jedusor">
        </label>
        <label for="surnaming">
            Prénom :<input type='text' name='surnaming' placeholder="Tom">
        </label>
        <label for="mailing">
            Adresse Mail <input type='email' name='mailing' placeholder="Tomjedusor@exemple.fr">
        </label>
        <label for="passwording">
            Mot de passe :  <input type='text' name='passwording' placeholder="Voldemort">
        </label>
        <label for="statusing">
            Vous êtes : <input type='text' name='statusing' value="client" readonly>
        </label>
        <input type="submit" value="Créer un compte">
    </form>

    
<?php }

?>
<style>

    #connexionform {
        display: flex;
        flex-direction: column;
        background-color: white;
        width: 100%;
        gap: 50px;
       
    }

</style>