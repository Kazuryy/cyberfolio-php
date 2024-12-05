
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
    <link rel="stylesheet" href="contacts.css">
    <title>Contact</title>
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
            <a href="#" id="profil">Profil</a>
            <a href="projets.php">Projects</a>
            <a href="accueil.php?user_id=<?php echo $_SESSION['user_id']; ?>#about-me-section">About Me</a>
            <a href="contacts.php">Contact</a>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion du menu déroulant "Profil"
            const profil = document.getElementById('profil'); 
            const menuDeroulant = document.getElementById('menu-deroulant'); 

            profil.addEventListener('click', function (event) {
                menuDeroulant.classList.toggle('visible');
                event.preventDefault();
            });

            document.addEventListener('click', function (event) {
                if (!menuDeroulant.contains(event.target) && event.target !== profil) {
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
    <main>
        <section class="contact-section">
            <h1>Contactez-moi</h1>
            <p class="subtitle">Vous avez une question ou un projet en tête ? Laissez-moi un message.</p>
            
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Votre nom <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Votre email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">Votre message</label>
                    <textarea id="message" name="message" rows="5" cols="50" required></textarea>
                </div>

                <button type="submit" id="submit">Envoyer</button>
            </form>

            <p id="successMessage" class="success-message" style="display:none;">Message envoyé avec succès !</p>
        </section>

        <section class="contact-info">
            <h2>Informations de contact</h2>
            <div class="contact-icons">
                <div class="contact-item">
                    <span class="icon">📧</span>
                    <span class="info" id="emailInfo">sergueï@sergueï.sergueï</span>
                    <button onclick="copyToClipboard('emailInfo')">Copier</button>
                </div>
                <div class="contact-item">
                    <span class="icon">🔗</span>
                    <span class="info" id="linkedinInfo">linkedin.com/in/exemple</span>
                    <button onclick="copyToClipboard('linkedinInfo')">Copier</button>
                </div>
                <div class="contact-item">
                    <span class="icon">📞</span>
                    <span class="info" id="phoneInfo">1-213-555-0100</span>
                    <button onclick="copyToClipboard('phoneInfo')">Copier</button>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById("contactForm").addEventListener("submit", function(event) {
            event.preventDefault();

            // clear les champs du formulaire
            document.getElementById("message").value = "";
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";

            // annonce du bon envoie du message
            const successMessage = document.getElementById("successMessage");
            successMessage.style.display = "block";
        });

            //Fonction de copiage des infos
        function copyToClipboard(infoId) {
            const infoElement = document.getElementById(infoId);
            const text = infoElement.innerText;
            
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            alert(`Copié dans le presse-papier: ${text}`);
        }

    </script>

</body>
</html>
