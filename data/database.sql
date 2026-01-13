-- Suppression de la base de données si elle existe
DROP
DATABASE IF EXISTS flowers_shop;

-- Création de la base de données
CREATE
DATABASE flowers_shop;

-- Utilisation de la base de données
USE
flowers_shop;

-- Table des utilisateurs : stocke les informations des utilisateurs
CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50)  NOT NULL,
    last_name  VARCHAR(50)  NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    phone      VARCHAR(20),
    password   VARCHAR(255) NOT NULL,
    role       VARCHAR(30)  NOT NULL,
    status     VARCHAR(20) DEFAULT 'Actif',
    created_at DATETIME    DEFAULT CURRENT_TIMESTAMP
);

-- Table des tâches : gestion des tâches assignées aux employés/responsable 
CREATE TABLE tasks
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    description TEXT,
    created_by  INT          NOT NULL,
    assigned_to INT          NOT NULL,
    status      ENUM(
        'A faire',
        'En cours',
        'Terminé',
        'A réassigner'
    ) DEFAULT 'A faire',
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users (id),
    FOREIGN KEY (assigned_to) REFERENCES users (id)
);

-- Table de liaison entre tâches et utilisateurs
CREATE TABLE tasks_users
(
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
INSERT INTO users (first_name, last_name, email, phone, password, role, status)
VALUES ('Marie', 'Dupont', 'marie.dupont@flowers-shop.com', '0123456789',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Vendeur', 'Actif'),
       ('Pierre', 'Martin', 'pierre.martin@flowers-shop.com', '0123456790',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Stagiaire', 'Actif'),
       ('Sophie', 'Leroy', 'sophie.leroy@flowers-shop.com', '0123456791',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Vendeur', 'Actif'),
       ('Jean', 'Moreau', 'jean.moreau@flowers-shop.com', '0123456792',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Vendeur', 'Actif'),
       ('Claire', 'Bernard', 'claire.bernard@flowers-shop.com', '0123456793',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Vendeur', 'Actif'),
       ('Lucas', 'Petit', 'lucas.petit@flowers-shop.com', '0123456794',
        '$2y$10$bKR6W.XOFRrYXVaXqrIy7.heGQDYgJCswsB4MKfkrSB4HXPw2Mf.G', 'Responsable', 'Actif');

-- Insertion des tâches de test
INSERT INTO tasks (title, description, created_by, assigned_to, status)
VALUES ('Préparer bouquet Saint-Valentin', 'Créer 20 bouquets de roses rouges pour la Saint-Valentin', 1, 4,
        'En cours'),
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