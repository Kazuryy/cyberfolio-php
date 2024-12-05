<?php
$projetTitre = null;
$projet_sTitre = null;
$projet_d = null;
$projet_f1 = null;
$projet_f2 = null;
$projet_f3 = null;
$projet_description = null;
$projet_photo = null;

// Vérifier si un projet est sélectionné (paramètre 'partie' passé en GET)
if (isset($_GET['partie'])) {
    $partie = (int)$_GET['partie'];  // Récupérer l'ID du projet

    // Préparer la requête pour récupérer le titre du projet
    $stmt = $mysqlClient->prepare('SELECT * FROM projets WHERE projet_id = :partie');
    $stmt->bindParam(':partie', $partie, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer le titre du projet
    $projet = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le projet existe, assigner son titre
    if ($projet) {
        $projetTitre = $projet['projet_titre'];
        $projet_sTitre = $projet['projet_stitre'];
        $projet_d = $projet['projet_d'];
        $projet_f1 = $projet['projet_f1'];
        $projet_f2 = $projet['projet_f2'];
        $projet_f3 = $projet['projet_f3'];
        $projet_description = $projet['projet_description'];
        $projet_photo = $projet['projet_photo'];
    } else {
        $projetTitre = "Titre du projet";  // Si projet n'existe pas, afficher ce message
        $projet_sTitre = "Sous Titre du projet";
    }
}
?>