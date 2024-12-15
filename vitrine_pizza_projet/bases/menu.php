<?php 
$logon = $_SESSION['user'] ?? null;
if ($logon) {
    $prenom =$_SESSION['user']['prenom'];
    $nom =$_SESSION['user']['nom'];
    $status =$_SESSION['user']['status'];
}


?>
<nav>
        <ul>
            <li>
                <a href="index.php?page=accueil">Accueil</a>
            </li>
            <li>
                <a href="index.php?page=pizzas">Pizzas</a>
            </li>
            <li>
                <a href="index.php?page=contact">Contact</a>
            </li>
            <li>
                <a href="index.php?page=panier">Panier</a>
            </li>
            <?php
            if ($logon) {
            if ($status == "admin") {
                echo "<li id='adminlist'>";
                echo "<a id='adminbutton' href='index.php?page=admin'>Admin</a>";
                echo "</li>";
            }
            }
            ?>
        </ul>
        <ul >
            <li id='lia' >
                <a id='connectuser' href="index.php?page=connexion"><?php 
                $nom = $_SESSION['user']['nom'] ?? null;
                $prenom = $_SESSION['user']['prenom'] ?? null;

                if ($nom && $prenom) {
    echo "<i class='fa-solid fa-user'>   ".$nom ."  ".$prenom . "</i>";
   // echo "<a href='session.php?close=1'>Déconnexion</a>"; // Pour la fermeture de la session
} else { 
    echo "Connexion/Inscription";
} ?>

                </a>
            </li>
        </ul>
    </nav>
    </header>
    <main>
    <style>
        #connectuser {
            width: 100%;
            height: 40px;
            align-items:flex-end;
        }
        #lia #connectuser {
            padding: 20px 50px;
            font-size: 15px;
            margin: 0;
            left: 20px;
            background-color: grey;
            color: white;
            font-family: sans-serif;
        }
        #lia:hover #connectuser {
            background-color: green;
        }
        #lia:hover {
            opacity: 100%;
        }
        nav {

display: flex;
position: absolute;
width: 100%;
height: 60px;
margin: 0;

bottom: 80px;
left: 0;

}

ul {
 display: flex;
 gap: 50px;
 align-items: center;
 justify-content: center;
width: 100%;
 
 

}
li:hover{
    opacity: 100%;
}
li:hover a{
    opacity: 100%;
    background-color: #a40b03;
}
li {
 list-style-type: none;
 font-size: 30px;
}


li a {
 
 padding: 0.55em 1em;

 background-color: #a34b03;
 border-radius: 0.5em;

 color: #FFFFFF;
 font-weight: bold;
 text-decoration: none;

}

#adminbutton {
    background-color: #a34b03;
}
#adminlist:hover {
    opacity: 100%;

}
#adminlist:hover #adminbutton {
    background-color: red;

}

    </style>