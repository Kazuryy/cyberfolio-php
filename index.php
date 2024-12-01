<!DOCTYPE html>
<html lang="fr">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Sergueï Cyberfolio</title>
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
    <section class="home">
        <div class="home-img">
            <img src="Images/main.png" alt="">
        </div>
        <div class="home-content">
            <h1>Salut, c'est <span>Sergueï</span></h1>
            <h3 class="typing-text">Je suis <span>Développeur Senior</span></h3>
            <p>Développeur Sénoir avec 21 ans d'experience dont 12 dans l'entreprise Analphabet, leader dans la tech et les nouvelles technologies de cloud et cybersécurité. Je développe des outils et des sites pour aider certaines personnes à mieux comprendre le Web</p>
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
</html>
