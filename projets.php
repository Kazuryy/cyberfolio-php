<?php
require_once('databaseconnect.php');
require_once('variables.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="p.css">
    <title>Sergueï Cyberfolio</title>
</head>
<body>
<header>
        <nav>
            <div class="nav-content">
                <div class="liens-gauche">
                    <a href="index.php"> Home</a>
                    <a href="projets.php"> Projets</a>
                </div>
                <div class="logo">
                    <a href=index.php class="logo">Sergueï</a>
                </div>
                <div class="liens-droite">
                    <a href=index.php#about-me-section> About Me </a>
                    <a href="contacts.php"> Contact</a>
                </div>
                <div class="burger-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <div class="mobile-menu">
                <a href="index.php"> Home</a>
                <a href="projets.php"> Projects</a>
                <a href="#about-me-section"> About Me </a>
                <a href="contacts.php"> Contact</a>
            </div>
        </nav>
        

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const burgerMenu = document.querySelector('.burger-menu');
                const mobileMenu = document.querySelector('.mobile-menu');
        
                burgerMenu.addEventListener('click', function(event) {
                    mobileMenu.classList.toggle('active');
                    event.stopPropagation(); // Empêche le clic de se propager au document
                });
        
                document.addEventListener('click', function(event) {
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
