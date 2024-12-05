<?php
session_start();
require_once('databaseconnect.php');

$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer et nettoyer les données du formulaire
        $mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validation des champs
        if (empty($mail)) {
            $errors['mail'] = 'Merci de renseigner une adresse mail !';
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['mail'] = 'L\'adresse email n\'est pas valide !';
        }

        if (empty($password)) {
            $errors['password'] = 'Merci de renseigner un mot de passe !';
        }

        // Si aucune erreur, procéder à la vérification dans la base de données
        if (empty($errors)) {
            // Requête pour récupérer l'utilisateur en fonction de l'email
            $sql = 'SELECT * FROM users WHERE user_mail = :mail';
            $stmt = $mysqlClient->prepare($sql);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->execute();

            // Vérifier si l'utilisateur existe dans la base de données
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Comparer le mot de passe haché
                if (password_verify($password, $user['user_mdp'])) {
                    // Authentification réussie, démarrer la session
                    $_SESSION['user_id'] = $user['user_id'];  // Stocker l'ID de l'utilisateur dans la session
                    $_SESSION['user_nom'] = $user['user_nom'];  // Stocker le nom de l'utilisateur
                    // Rediriger vers la page d'accueil avec l'ID de l'utilisateur dans l'URL
                    header('Location: accueil.php?user_id=' . $_SESSION['user_id']);
                    exit();  // Assurez-vous d'arrêter l'exécution du script ici
                } else {
                    // Mot de passe incorrect
                    $errors['password'] = 'Le mot de passe est incorrect !';
                }
            } else {
                // Aucun utilisateur trouvé avec cet email
                $errors['mail'] = 'Aucun utilisateur trouvé avec cette adresse mail.';
            }
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur dans la requête SQL
    echo 'Erreur : ' . $e->getMessage();
}
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="index.css">
        <title>Connexion</title>

        <!-- Inclure CryptoJS pour le hachage SHA1 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1-crypto-js.js"></script>
    </head>
    <body>
        <nav>
            <div class="nav-content">
                <div class="logo">
                    <a href="" class="logo">Sergueï</a>
                </div>
            </div>
        </nav>

        <div class="englobe">
            <div class="titre">
                <h1>Connexion à votre compte</h1>
            </div>

            <div class="form">
                <form id="loginForm" action="" method="POST">
                    <div class="form-group">
                        <label for="mail">Adresse mail : <span class="required"></span></label>
                        <input type="text" id="mail" name="mail" value="<?php echo htmlspecialchars(isset($mail) ? $mail : ''); ?>">
                        <?php if (isset($errors['mail'])): ?>
                            <p style="color: red;"><?php echo $errors['mail']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe : <span class="required"></span></label>
                        <input type="password" id="password" name="password">
                        <?php if (isset($errors['password'])): ?>
                            <p style="color: red;"><?php echo $errors['password']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-inscription">
                        <button type="submit" id="submit">Se connecter</button>
                        <a href="inscription.php">
                            <button type="button" id="submit">S'inscrire</button>
                        </a>
                    </div>
                </form>
                
                <button id="checkPwnedBtn" class="checkPwnedBtn">Dernière violation de données</button>

                <div id="pwnedResult"></div>
                <script>
                    // Code JavaScript pour gérer la requête fetch et l'affichage des données
                    function fetchLatestBreach() {
                        fetch('https://haveibeenpwned.com/api/v3/latestbreach', {
                            method: 'GET',
                            headers: {
                                'User-Agent': 'VotreNomApplication', // Remplacez ceci par le nom de votre application
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('pwnedResult').innerHTML = `
                                <div class="pwnd">
                                    <p class="nom-pwnd">${data.Name}</p>
                                    <p class="date-pwnd"><strong>Date de la violation : ${data.BreachDate}</strong></p>
                                    <p class="description-pwnd"><strong>Description : </strong> ${data.Description}</p>
                                    <p class="data-pwnd"><strong>Données compromises :</strong> <span class="data-couleur">${data.DataClasses.join(' | ')}</span></p>
                                </div>
                            `;
                        })
                        .catch(error => {
                            console.error('Erreur lors de la récupération des données :', error);
                            document.getElementById('pwnedResult').innerHTML = 'Erreur de récupération des données.';
                        });
                    }

                    document.getElementById('checkPwnedBtn').addEventListener('click', fetchLatestBreach);

                    
                </script>
            </div>
        </div>
    </body>
</html>