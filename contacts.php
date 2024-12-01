<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="contacts (2).css">
    <title>Contact</title>
</head>
<body>
<header>
        <nav>
            <div class="nav-content">
                <div class="liens-gauche">
                    <a href="index.php"> Home</a>
                    <a href="projets.php"> Projects</a>
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
                    <textarea id="message" name="message" rows="6" required></textarea>
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
