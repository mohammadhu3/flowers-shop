-- Suppression de la base de données si elle existe
DROP DATABASE IF EXISTS flowers_shop;

-- Création de la base de données
CREATE DATABASE flowers_shop;

-- Utilisation de la base de données
USE flowers_shop;

-- Table des utilisateurs : stocke les informations des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role VARCHAR(30) NOT NULL,
    status VARCHAR(20) DEFAULT 'Actif',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME NULL
);
-- Table des tâches : gestion des tâches assignées aux employés/responsable
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_by VARCHAR(50) NOT NULL,
    assigned_to INT NOT NULL,
    status ENUM(
        'À faire',
        'En cours',
        'Terminé',
        'À réassigner'
    ) DEFAULT 'À faire',
    priority ENUM('Urgent', 'Non urgent') DEFAULT 'Non urgent',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
);

-- ====================================
-- INSERTION DES DONNÉES DE TEST
-- ====================================

-- Insertion des utilisateurs de test (mots de passe : "password123")
INSERT INTO
    users (
        first_name,
        last_name,
        email,
        phone,
        password,
        role,
        status
    )
VALUES (
        'Marie',
        'Dupont',
        'marie.dupont@flowers-shop.com',
        '0123456789',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Vendeur',
        'Actif'
    ),
    (
        'Pierre',
        'Martin',
        'pierre.martin@flowers-shop.com',
        '0123456790',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Stagiaire',
        'Actif'
    ),
    (
        'Sophie',
        'Leroy',
        'sophie.leroy@flowers-shop.com',
        '0123456791',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Vendeur',
        'Actif'
    ),
    (
        'Jean',
        'Moreau',
        'jean.moreau@flowers-shop.com',
        '0123456792',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Vendeur',
        'Actif'
    ),
    (
        'Claire',
        'Bernard',
        'claire.bernard@flowers-shop.com',
        '0123456793',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Vendeur',
        'Actif'
    ),
    (
        'Lucas',
        'Petit',
        'lucas.petit@flowers-shop.com',
        '0123456794',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G',
        'Responsable',
        'Actif'
    );

-- Insertion des tâches de test
INSERT INTO
    tasks (
        title,
        description,
        created_by,
        assigned_to,
        status,
        priority
    )
VALUES (
        'Préparer bouquet Saint-Valentin',
        'Créer 20 bouquets de roses rouges pour la Saint-Valentin',
        'Lucas Petit',
        4,
        'En cours',
        'Non urgent'
    ),
    (
        'Inventaire magasin',
        'Faire l\'inventaire complet du stock de fleurs',
        'Lucas Petit',
        2,
        'A faire',
        'Non urgent'
    ),
    (
        'Livraison centre-ville',
        'Livrer les commandes du matin en centre-ville',
        'Lucas Petit',
        6,
        'Terminé',
        'Urgent'
    ),
    (
        'Décoration mariage',
        'Préparer la décoration florale pour le mariage Martin',
        'Lucas Petit',
        4,
        'En cours',
        'Non urgent'
    ),
    (
        'Formation nouveau employé',
        'Former Sophie aux techniques de vente',
        'Lucas Petit',
        5,
        'A faire',
        'Non urgent'
    ),
    (
        'Nettoyage vitrine',
        'Nettoyer et réorganiser la vitrine du magasin',
        'Lucas Petit',
        3,
        'Terminé',
        'Urgent'
    );