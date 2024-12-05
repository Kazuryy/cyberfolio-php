-- Database Creation
CREATE DATABASE IF NOT EXISTS `projets_serguei`;
USE `projets_serguei`;

-- Table Creation
CREATE TABLE IF NOT EXISTS projets(
    projet_id INT AUTO_INCREMENT PRIMARY KEY,
    projet_titre TEXT,
    projet_stitre TEXT,
    projet_d DATE,
    projet_f1 TEXT,
    projet_f2 TEXT,
    projet_f3 TEXT,
    projet_description TEXT,
    projet_photo TEXT
    );

-- Removing Old Data
DELETE FROM `projets`;

-- Data Insertion
INSERT INTO projets(projet_id,projet_titre, projet_stitre, projet_d, projet_f1, projet_f2, projet_f3, projet_description, projet_photo)
VALUES
    (1,"Site e-commerce",
    "Plateforme de Commerce Électronique Moderne",
    "2015-05-19",
    "Gestion des utilisateurs",
    "Catalogue de produits",
    "Panier d'achat",
    "Ce projet consiste à développer une plateforme de commerce électronique intuitive et performante, conçue pour offrir une expérience utilisateur fluide et sécurisée. Pensée pour répondre aux besoins des acheteurs et des vendeurs, cette solution intègre des fonctionnalités avancées telles que la gestion des catalogues produits, des options de paiement variées et un système de suivi des commandes. Avec un design moderne et optimisé, la plateforme vise à maximiser l’engagement des utilisateurs, à renforcer leur confiance et à augmenter les conversions, tout en garantissant une navigation simple et agréable.",
    "projects/ecommerce.png"),
    
    (2,"Applications de Gestion de Tâches",
    "Organisez, planifiez et suivez vos projets facilement",
    "2016-03-14",
    "Gestion des priorités",
    "Création de tâches",
    "Interface simple et moderne",
    "Notre projet d'application de gestion de tâches vise à fournir une solution intuitive et efficace pour aider les utilisateurs à organiser et suivre leurs tâches quotidiennes. Grâce à une interface moderne et épurée, l'application permet de créer rapidement de nouvelles tâches en renseignant des détails comme le titre, la description, la date limite ou encore des catégories personnalisables. Les utilisateurs peuvent modifier ces tâches à tout moment, par exemple pour mettre à jour leur statut ou ajuster leur priorité, et supprimer celles qui ne sont plus nécessaires. Conçue pour être simple à utiliser, cette application répond aux besoins de ceux qui souhaitent structurer leur journée, prioriser leurs actions et atteindre leurs objectifs sans effort.",
    "projects/gestiontaches.png"),
    
    (3,"Jeu multijoueur simple",
    "Jouez avec vos amis, sans complications, juste du fun",
    "2023-12-17",
    "Jeu en temps réel",
    "Chat en ligne",
    "Système de scoring",
    "Ce projet vise à développer un jeu multijoueur simple, où les utilisateurs peuvent se connecter et jouer en temps réel dans un environnement interactif en ligne. Avec une interface conviviale et un gameplay accessible mais captivant, l'objectif est de permettre aux joueurs de s'affronter tout en explorant les fondamentaux des jeux multijoueurs en ligne. Le projet met particulièrement l'accent sur l'apprentissage de la communication en temps réel grâce à l'utilisation de WebSockets, offrant une base solide pour comprendre les mécanismes de synchronisation et d'interaction dans ce type de jeux.",
    "projects/jeu.jpg"),
    
    (4,"Dashboard de Gestion",
    "Suivez, analysez et optimisez vos performances en un coup d'œil.",
    "2017-07-22",
    "Analyse en Temps Réel",
    "Personnalisation des Tableaux de Bord",
    "Alertes et Notifications",
    "Le projet 'Dashboard de Gestion' consiste en une application web moderne conçue pour permettre aux utilisateurs de visualiser, organiser et gérer leurs données de manière intuitive et efficace. Ce tableau de bord offre une vue d'ensemble claire des informations essentielles, tout en proposant des fonctionnalités avancées telles que le filtrage, le tri et l'analyse des données en temps réel. Idéal pour afficher des statistiques, générer des rapports ou suivre des indicateurs de performance clés (KPI), cet outil se distingue par son interface dynamique, flexible et adaptée aux besoins professionnels, favorisant une prise de décision rapide et éclairée.",
    "projects/dashboard.png"),
    
    (5,"Réseau social minimaliste",
    "Connectez-vous, partagez, restez simple",
    "2020-11-09",
    "Mur de Mises à Jour Simples",
    "Système de Connexion Simplifié",
    "Messagerie Minimaliste",
    "Le projet 'Réseau Social Minimaliste' consiste à développer une plateforme simple et épurée, conçue pour offrir une expérience utilisateur fluide et axée sur l'essentiel. Les utilisateurs pourront se connecter, partager des mises à jour et interagir de manière basique, dans un environnement sans distractions ni fonctionnalités superflues. L'objectif est de privilégier la simplicité et la convivialité, en éliminant les complexités des réseaux sociaux traditionnels pour permettre une communication authentique et directe.",
    "projects/reseausocial.avif");


-- Table Creation
CREATE TABLE IF NOT EXISTS users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_nom VARCHAR(100),
    user_prenom VARCHAR(100),
    user_mail VARCHAR(100),
    user_mdp VARCHAR(100)
    );

-- Removing Old Data
DELETE FROM `users`;