CREATE
DATABASE IF NOT EXISTS fleuriste_app
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE
fleuriste_app;

CREATE TABLE users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,

    first_name VARCHAR(50)  NOT NULL,
    last_name  VARCHAR(50)  NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    phone      VARCHAR(20),
    password   VARCHAR(255) NOT NULL,

    role       VARCHAR(30)  NOT NULL,
    status     VARCHAR(20) DEFAULT 'active',

    created_at DATETIME    DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks
(
    id           INT AUTO_INCREMENT PRIMARY KEY,

    title        VARCHAR(255) NOT NULL,

    category     ENUM('magasin','administratif','produit') NOT NULL,
    status       ENUM('a_faire','en_cours','a_reassigner','termine') NOT NULL DEFAULT 'a_faire',
    priority     ENUM('faible','moyenne','elevee') NOT NULL DEFAULT 'moyenne',

    assigned_to  INT NULL,

    created_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    validated_at DATETIME NULL,

    CONSTRAINT fk_tasks_assigned_to
        FOREIGN KEY (assigned_to) REFERENCES users (id)
            ON DELETE SET NULL
);

CREATE TABLE comments
(
    id         INT AUTO_INCREMENT PRIMARY KEY,

    task_id    INT      NOT NULL,
    user_id    INT      NOT NULL,

    content    TEXT     NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_comments_task
        FOREIGN KEY (task_id) REFERENCES tasks (id)
            ON DELETE CASCADE,

    CONSTRAINT fk_comments_user
        FOREIGN KEY (user_id) REFERENCES users (id)
            ON DELETE CASCADE
);

INSERT INTO users (first_name, last_name, email, phone, password, role, status)
VALUES ('Sophie', 'Martin', 'sophie.martin@example.com', '0600000001', 'password_hash', 'vendeur', 'active'),
       ('Julie', 'Durand', 'julie.durand@example.com', '0600000002', 'password_hash', 'vendeur', 'active'),
       ('Claire', 'Lefevre', 'claire.lefevre@example.com', '0600000003', 'password_hash', 'vendeur', 'active'),
       ('Lucas', 'Bernard', 'lucas.bernard@example.com', '0600000004', 'password_hash', 'vendeur', 'active'),
       ('Emma', 'Petit', 'emma.petit@example.com', '0600000005', 'password_hash', 'stagiaire', 'active'),
       ('Paul', 'Dubois', 'paul.dubois@example.com', '0600000006', 'password_hash', 'responsable', 'active');
