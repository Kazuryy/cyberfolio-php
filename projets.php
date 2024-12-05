projets.php
<?php
session_start();  // Démarre la session

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
require_once('databaseconnect.php');
require_once('variables.php');

$user_id = $_SESSION['user_id'];

// Requête SQL pour obtenir les détails de l'utilisateur
$sql = 'SELECT * FROM users WHERE user_id = :user_id';
$stmt = $mysqlClient->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Récupérer les données de l'utilisateur
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Stocker les informations utilisateur dans des variables pour utilisation dans le HTML
    $user_nom = $user['user_nom'];
    $user_prenom = $user['user_prenom'];
    $user_mail = $user['user_mail'];
} else {
    // Si l'utilisateur n'est pas trouvé, rediriger vers la page de connexion
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="p1.css">
    <title>Sergueï Cyberfolio</title>
</head>
<script>
    window.onload = function() {
        // Récupérer l'ID utilisateur depuis l'URL ou la session si disponible
        const userId = new URLSearchParams(window.location.search).get('user_id'); // Essayer de récupérer le user_id de l'URL
        const currentHash = window.location.hash;  // Récupérer le fragment (ex: #about-me-section)

        // Si l'ID utilisateur n'est pas présent dans l'URL
        if (userId === null) {
            const newUserId = <?php echo $_SESSION['user_id']; ?>; // Récupérer l'ID utilisateur côté PHP
            const url = window.location.href;

            // Si l'URL ne contient pas déjà un paramètre (?), on ajoute ?user_id
            // Sinon, on ajoute &user_id
            let newUrl;
            if (url.indexOf('?') === -1) {
                newUrl = url + '?user_id=' + newUserId;
            } else {
                newUrl = url + '&user_id=' + newUserId;
            }

            // Ajouter également le fragment (#) si nécessaire
            if (currentHash) {
                newUrl += currentHash;
            }

            // Rediriger vers l'URL modifiée
            window.history.replaceState(null, null, newUrl);
        }
    };
</script>
<body>
<header>
    <nav>
        <div class="nav-content">
            <a href="#" id="profil-mobile" class="icone"><i class="fas fa-user"></i></a>
            <div class="liens-gauche">
                <a href="contacts.php">Contact</a>
                <a href="projets.php?user_id=<?php echo $_SESSION['user_id']; ?>">Projects</a>
            </div>
            <div class="logo">
                <a href="accueil.php" class="logo">Sergueï</a>
            </div>
            <div class="liens-droite">
            <a href="accueil.php?user_id=<?php echo $_SESSION['user_id']; ?>#about-me-section">About Me</a>
                <a href="#" id="profil"><i class="fas fa-user" id="icone-profil"></i>  Profil</a>
            </div>
        </div>

        <!-- Menu déroulant -->
        <div id="menu-deroulant" class="cache">
            <ul>
            <li><a>Bienvenue <span class="nom-user"><strong><?php echo htmlspecialchars($user_prenom); ?></strong></span></a></li>
                <li><a href="logout.php" class="deco">Déconnexion</a></li>
            </ul>
        </div>

        <!-- Menu burger pour mobile -->
        <div id="burger-menu" class="burger-menu">
            <i class="fas fa-bars"></i>
        </div>
        <div class="mobile-menu cache">
            <a id="profil2">Contact</a>
            <a href="projets.php?user_id=<?php echo $_SESSION['user_id']; ?>">Projects</a>
            <a href="accueil.php?user_id=<?php echo $_SESSION['user_id']; ?>#about-me-section">About Me</a>
            <a href="contacts.php">Contact</a>
        </div>
        
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion du menu déroulant "Profil"
            const profil = document.getElementById('profil');
            const profil2 = document.getElementById('profil2');
            const menuDeroulant = document.getElementById('menu-deroulant'); 

            profil.addEventListener('click', function (event) {
                menuDeroulant.classList.toggle('visible');
                event.preventDefault();
            });

            profil2.addEventListener('click', function (event) {
                menuDeroulant.classList.toggle('visible');
                event.preventDefault();
            });

            // Un seul écouteur d'événements pour fermer le menu déroulant
            document.addEventListener('click', function (event) {
                if (!menuDeroulant.contains(event.target) && 
                    event.target !== profil && 
                    event.target !== profil2) {
                    menuDeroulant.classList.remove('visible');
                }
            });

            // Gestion du menu burger pour mobile
            const burgerMenu = document.getElementById('burger-menu');
            const mobileMenu = document.querySelector('.mobile-menu');

            burgerMenu.addEventListener('click', function (event) {
                mobileMenu.classList.toggle('active');
                event.stopPropagation();
            });

            document.addEventListener('click', function (event) {
                if (!mobileMenu.contains(event.target) && !burgerMenu.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                }
            });
        });
    </script>
</header>

    <section class="projets-titre">
        <div class="titre-projet" id="titre-projet">
            <h1>Projets </h1>

            <div class="rectangle">
                <div class="part" onclick="loadInfo(1)">Plateforme de E-commerce moderne</div>
                <div class="part" onclick="loadInfo(2)">Application de gestion de taches</div>
                <div class="part" onclick="loadInfo(3)">Jeu multijoueur simple</div> <!-- Changement ici -->
                <div class="part" onclick="loadInfo(4)">Dashboard de gestion</div>
                <div class="part" onclick="loadInfo(5)">Réseau social minimaliste </div> <!-- Changement ici -->
            </div>

            <div class="grand-projet" id="grand-projet">
                <div class="rectangle-image">
                    <div class="image-contour">
                        <img src=<?php echo htmlspecialchars($projet_photo); ?> alt="Image du projet" class="image-projet">
                    </div>
                </div>

                <div class="rectangle-titre">
                    <?php echo htmlspecialchars($projetTitre); ?>
                </div>

                <div class="rectangle-stitre">
                <?php echo htmlspecialchars($projet_sTitre); ?>
                </div>

                <div class="rectangle-date">
                <?php echo htmlspecialchars($projet_d); ?>
                </div>

                <div class="rectangle-f">
                    <ul>
                        <li class="rectangle-f1"> ✔️ <?php echo htmlspecialchars($projet_f1); ?> </l1>
                        <li class="rectangle-f2"> ✔️ <?php echo htmlspecialchars($projet_f2); ?> </li>
                        <li class="rectangle-f3"> ✔️ <?php echo htmlspecialchars($projet_f3); ?></li>
                    </ul>
                </div>
                <div class="rectangle-description">
                <?php echo htmlspecialchars($projet_description); ?>
                </div>
            </div>
        </div>
    </section>
    <script>
        
    // Fonction pour charger les informations en fonction de la partie sélectionnée
    function loadInfo(partie) {
        // Rediriger vers la même page en ajoutant le paramètre GET avec l'ID du projet
        window.location.href = "?partie=" + partie;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Sélectionner tous les éléments ayant la classe 'part'
        const parts = document.querySelectorAll('.part');
        const grandProjetSection = document.getElementById('grand-projet');
        // Vérifier si un bouton a été sélectionné et le marquer comme actif
        const currentPartie = new URLSearchParams(window.location.search).get('partie');
        if (currentPartie) {
            parts.forEach(part => {
                if (part.textContent.trim() === "Plateforme de E-commerce moderne" && currentPartie == 1) {
                    part.classList.add('active');
                }
                else if (part.textContent.trim() === "Application de gestion de taches" && currentPartie == 2) {
                    part.classList.add('active');
                }
                else if (part.textContent.trim() === "Jeu multijoueur simple" && currentPartie == 3) {
                    part.classList.add('active');
                }
                else if (part.textContent.trim() === "Dashboard de gestion" && currentPartie == 4) {
                    part.classList.add('active');
                }
                else if (part.textContent.trim() === "Réseau social minimaliste" && currentPartie == 5) {
                    part.classList.add('active');
                }
            });
            if (grandProjetSection) {
            grandProjetSection.style.display = 'block'; // Affiche la section
        }
        }

        parts.forEach(part => {
            part.addEventListener('click', function () {
                // Supprimer la classe active de tous les autres boutons
                parts.forEach(p => p.classList.remove('active'));
                
                // Ajouter la classe active au bouton cliqué
                part.classList.add('active');
            });
        });
    });
</script>