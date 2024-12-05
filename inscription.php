<?php
require_once('databaseconnect.php'); // Assurez-vous que cette connexion fonctionne
require_once('variables.php'); // Si vous avez des variables externes

// Initialisation de la variable des erreurs en dehors du bloc try-catch
$errors = [];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer et nettoyer les champs du formulaire
        $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
        $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : '';
        $mail = isset($_POST['mail']) ? trim($_POST['mail']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validation des champs
        if (empty($nom)) {
            $errors['nom'] = 'Merci de renseigner un nom !';
        }
        if (empty($prenom)) {
            $errors['prenom'] = 'Merci de renseigner un prénom !';
        }
        if (empty($mail)) {
            $errors['mail'] = 'Merci de renseigner une adresse mail !';
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['mail'] = 'L\'adresse email n\'est pas valide !';
        }
        if (empty($password)) {
            $errors['password'] = 'Merci de renseigner un mot de passe !';
        }

        // Vérification si aucune erreur
        if (empty($errors)) {
            // Hachage du mot de passe avec password_hash
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Préparer la requête SQL pour insérer les données
            $sql = 'INSERT INTO users (user_nom, user_prenom, user_mail, user_mdp) VALUES (:nom, :prenom, :mail, :password)';
            $stmt = $mysqlClient->prepare($sql);

            // Lier les paramètres
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer l'ID de l'utilisateur inséré
            $user_id = $mysqlClient->lastInsertId();

            // Message de succès ou redirection
            echo '<div class="inscription-ok">Inscription réussie !</div>';

            // Rediriger vers accueil.php avec l'ID de l'utilisateur dans l'URL
            header('Location: accueil.php?user_id=' . $user_id);
            exit();
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur dans la requête SQL
    echo 'Erreur : ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="index.css">
        <title>Inscription</title>
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
                <h1>Créer un nouvel utilisateur</h1>
            </div>

            <div class="form">
                <form id="contactForm" action="" method="POST">
                    <div class="form-group">
                        <label for="nom">Nom : <span class="required"></span></label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars(isset($nom) ? $nom : ''); ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <p style="color: red;"><?php echo $errors['nom']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom : <span class="required"></span></label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars(isset($prenom) ? $prenom : ''); ?>">
                        <?php if (isset($errors['prenom'])): ?>
                            <p style="color: red;"><?php echo $errors['prenom']; ?></p>
                        <?php endif; ?>
                    </div>

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

                    <button type="submit" id="submit">Créer un compte</button>
                </form>
            </div>
        </div>
    </body>
</html>
