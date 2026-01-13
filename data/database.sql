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
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table des tâches : gestion des tâches assignées aux employés/responsable
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_by INT NOT NULL,
    assigned_to INT NOT NULL,
    status ENUM(
        'A faire',
        'En cours',
        'Terminé'
    ) DEFAULT 'A faire',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users (id),
    FOREIGN KEY (assigned_to) REFERENCES users (id)
);

-- Table de liaison entre tâches et utilisateurs
CREATE TABLE tasks_users (
    task_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (task_id, user_id),
    FOREIGN KEY (task_id) REFERENCES tasks (id),
    FOREIGN KEY (user_id) REFERENCES users (id)
);

-- ====================================
-- INSERTION DES DONNÉES DE TEST
-- ====================================

-- Insertion des utilisateurs de test (mots de passe : "password123")
INSERT INTO users (first_name, last_name, email, phone, password, role, status) VALUES
('Marie', 'Dupont', 'marie.dupont@flowers-shop.com', '0123456789', '$2b$10$rQ8KvM9xJ1pX4fN6mZ9dUe8L7YtGhS2qP3wV5kA9bC8dE4fF6gH7iJ', 'Vendeur', 'Actif'),
('Pierre', 'Martin', 'pierre.martin@flowers-shop.com', '0123456790', '$2b$10$sT9LwN0yK2qY5gO7nA0eVf9M8ZuHiT3rQ4xW6lB0cD9eF5gG7hI8jK', 'Stagiaire', 'Actif'),
('Sophie', 'Leroy', 'sophie.leroy@flowers-shop.com', '0123456791', '$2b$10$uV0MxO1zL3rZ6hP8oB1fWg0N9AuIjU4sR5yX7mC1dE0fG6hH8iI9jL', 'Vendeur', 'Actif'),
('Jean', 'Moreau', 'jean.moreau@flowers-shop.com', '0123456792', '$2b$10$wX1NyP2aM4sA7iQ9pC2gXh1O0BuJkV5tS6zY8nD2eF1gH7iI9jJ0kM', 'Vendeur', 'Actif'),
('Claire', 'Bernard', 'claire.bernard@flowers-shop.com', '0123456793', '$2b$10$yZ2OzQ3bN5tB8jR0qD3hYi2P1CuKlW6uT7aZ9oE3fG2hI8jJ0kK1lN', 'Vendeur', 'Actif'),
('Lucas', 'Petit', 'lucas.petit@flowers-shop.com', '0123456794', '$2b$10$aB3PaR4cO6uC9kS1rE4iZj3Q2DuLmX7vU8bA0pF4gH3iJ9kK1lL2mO', 'Responsable', 'Actif');

-- Insertion des tâches de test
INSERT INTO tasks (title, description, created_by, assigned_to, status) VALUES
('Préparer bouquet Saint-Valentin', 'Créer 20 bouquets de roses rouges pour la Saint-Valentin', 1, 4, 'En cours'),
('Inventaire magasin', 'Faire l\'inventaire complet du stock de fleurs', 1, 2, 'A faire'),
('Livraison centre-ville', 'Livrer les commandes du matin en centre-ville', 1, 6, 'Terminé'),
('Décoration mariage', 'Préparer la décoration florale pour le mariage Martin', 1, 4, 'En cours'),
('Formation nouveau employé', 'Former Sophie aux techniques de vente', 1, 5, 'A faire'),
('Nettoyage vitrine', 'Nettoyer et réorganiser la vitrine du magasin', 1, 3, 'Terminé');

-- Insertion des relations tâches-utilisateurs
INSERT INTO tasks_users (task_id, user_id) VALUES
(1, 4), -- Jean travaille sur les bouquets Saint-Valentin
(1, 3), -- Sophie aide aussi sur les bouquets
(4, 4), -- Jean sur la décoration mariage
(4, 5), -- Claire aide aussi sur la décoration
(2, 2), -- Pierre fait l'inventaire
(2, 3); -- Sophie aide pour l'inventaire