<?php
session_start();  // Démarre la session

// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Connexion à la base de données
require_once('databaseconnect.php');

// Récupérer les informations de l'utilisateur à partir de la session
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
    <link rel="stylesheet" href="styl.css">
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
            <a id="profil2">Profil</a>
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


    <section class="home">
        <div class="home-img">
            <img src="Images/main.png" alt="">
        </div>
        <div class="home-content">
            <h1>Salut, c'est <span>Sergueï</span></h1>
            <h3 class="typing-text">Je suis <span>Développeur Senior</span></h3>
            <p>Développeur Sénior avec 21 ans d'experience dont 12 dans l'entreprise Analphabet, leader dans la tech et les nouvelles technologies de cloud et cybersécurité. Je développe des outils et des sites pour aider certaines personnes à mieux comprendre le Web</p>
            </div>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn">Embauchez moi</a>
        </div>
    </section>
    <section id="about-me-section" class="about-me-section">
        <div class="container">
            <br>
            <br>
            <div class="intro">
                <h1> About Me </h1>
                <p> Senior Software Architect with 20+ years of experience in developing secure, scalable systems and leading technical teams. Expert in cybersecurity and cloud architecture, with a proven track record of delivering innovative solutions in global environments.</p>
            </div>
            <div class="formations">
                <h2 class="edu">Education</h2>
                <div class="frise">
                    <div class="frise-item">
                        <div class="frise-contenu">
                            <h3>Diploma in Computer Science  1995 - 1998</h3>
                            <p>Moscow Push A Long B (MPALB)</p>
                        </div>
                    </div>
                    <div class="frise-item">
                        <div class="frise-contenu">
                            <h3>Bachelor’s Degree in Computer Science and Software Engineering | 1998 - 2002</h3>
                            <p>Moscow Vodka University (MVU)</p>
                        </div>
                    </div>
                    <div class="frise-item">
                        <div class="frise-contenu">
                            <h3>Master’s and PhD in Computer Science | 2003 - 2009  </h3>
                            <p>Counter-Strike State University (CSSU)</p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const cvImage = document.getElementById('cvImage');
                    const cvImageDoublon = document.getElementById('cvImageDoublon');
                    const overlay = document.getElementById('overlay');
                    let isEnlarged = false;
        
                    cvImage.addEventListener('click', function (event) {
                        if (!isEnlarged) {
                            cvImageDoublon.classList.add('active');
                            overlay.classList.add('active');
                            isEnlarged = true;
                        }
                        event.stopPropagation();
                    });
        
                    document.addEventListener('click', function (event) {
                        if (!cvImageDoublon.contains(event.target) && !cvImage.contains(event.target)) {
                            if (isEnlarged) {
                                cvImageDoublon.classList.remove('active');
                                overlay.classList.remove('active');
                                isEnlarged = false;
                            }
                        }
                    });
                });
            </script>
            <section id ="experience" class="experience"> 
                <div class="cv-container">
                    <img src="Images/cv_serg.png" alt="Curriculum Vitae" class="cv-photo" id="cvImage">
                    <img src="Images/cv_serg.png" alt="Curriculum Vitae Enlarged" class="cv-photo-doublon" id="cvImageDoublon">
                    <div class="overlay" id="overlay"></div>
                </div>
                <div class="cv-text">
                    <h2 class="working"> Work Experience</h2>
                    <div class="experience-frise">
                        <div class="experience-item">
                            <div class="experience-contenu">
                                <h3>Software Developper | Inspector Gadget's House</h3>
                                <p> - Contributed to the development of antivirus engines and early malware detection systems. <br>
                                    - Wrote efficient code in C++ for core components of the software, focusing on performance optimization. <br>
                                    - Collaborated with cross-functional teams to implement new features and ensure timely product releases. </p>
                            </div>
                        </div>
                        <div class="experience-item">
                            <div class="experience-contenu">
                                <h3>Senior Software Developer → Team Lead → Senior Software Architect | Mickey Mouse House </h3>
                                <p> - 2009 - 2012: Worked as a Senior Developer on Google’s core systems, contributing to high-performance data centers and optimizing distributed computing algorithms. <br>
                                    - 2013 - 2017: Promoted to Team Lead, overseeing a team of developers working on Google Cloud Platform’s security features. <br>
                                    - 2018 - 2023: Advanced to Senior Software Architect, designing scalable and secure backend solutions for global data processing services. <br></p>
                            </div>
                        </div>
                    </div>
                    <div class="cv-download">
                        <a href="Sergueï.pdf" download class="btn-download">Télécharger le CV</a>
                    </div>
                </div>
            </section>
        </div>
    </section>
</body>
<footer>
    <div class="footer">
        © 2024 Copyright :
        Guardia 1 - Haizer | Ronan | Tiago | Nikola
    </div>
</footer>
</html>
