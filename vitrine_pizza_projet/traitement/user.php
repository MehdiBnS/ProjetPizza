<?php


// RECUPERATION, VALIDATION DES CHAMPS si formulaire conforme dans connexion.php
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
// LECTURE, VALIDATION DE L'EMAIL "USER" (Si existant)
$requete = "SELECT * FROM user WHERE email = '" . $email . "'";
$resultat = $connexion->query($requete);
$user = $resultat->fetch(PDO::FETCH_ASSOC);
if ($user) {
    // VALIDATION DU PASSWORD (Si conforme)
    if ($password == $user['password']) {
        $_SESSION['user'] = [
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'status' => $user['status']
        ];
       // header("location:index.php?page=connexion");
        echo "<script>window.location.href = 'index.php?page=connexion'</script>";
    }
}







// RECUPERATION DES DONNEES, DESACTIVATION DE LA SESSION (Si lien conforme dans index.php)
$close = $_GET['close'] ?? null;

if ($close) {
    unset($_SESSION['user']);
    
    
   // header("location:index.php?page=accueil");
}

header("location:index.php?page=connexion");