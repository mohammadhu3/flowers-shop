# DIAGRAMME DE BASE DE DONNEE

![alt text](diagramme%20base.drawio.png)

# Technologies utilisées : 

- HTML
- CSS
- PHP (version 8.3.28)
- JAVASCRIPT
- MYSQL (version 8.4.7)

# ARBORESCENCE 

flowers-shop/
│
├── index.php                      # Routage
├── README.md                      # Documentation projet
├── DOCUMENTATION.md               # Documentation technique
├── INSTALL.MD                     # Instructions d'installation
│
├── assets/                        # Ressources
│   ├── css/
│   │   ├── 404.css
│   │   ├── admin.css
│   │   └── login.css
│   └── js/
│       └── script.js
│
├── config/                        # Configuration
│   └── database.php               # Connexion PDO à MySQL
│
├── controllers/                   # MVC - Décide
│   ├── auth.php                   # Authentification
│   ├── dashboard_admin.php        # Gestion tâches admin
│   ├── dashboard_employe.php      # Gestion tâches employé
│   ├── logout.php                 # Déconnexion
│   └── statistics.php             # Statistiques
│
├── models/                        # MVC - Exécute
│   ├── addTask.php                # Création de tâche
│   ├── deleteTask.php             # Suppression de tâche
│   ├── getAllTasks.php            # Liste toutes les tâches
│   ├── getAllTasksFiltered.php    # Filtrer les tâches
│   ├── getAllUsers.php            # Récupère tous les utilisateurs
│   ├── getEmployeById.php         # Récupère un utilisateur par ID
│   ├── getTasksByUser.php         # Récupère les tâches d'un utilisateur
│   ├── setStatusTask.php          # Modifie le statut d'une tâche
│   ├── statistics.php             # Données statistiques
│   └── updateTask.php             # Mise à jour d'une tâche
│
├── views/                         # MVC - Affiche
│   ├── 404.php                    # Page erreur 404
│   ├── admin.php                  # Interface administrateur
│   ├── employe.php                # Interface employé
│   ├── login.php                  # Page de connexion
│   ├── statistics.php             # Cards statistiques
│   └── welcome.php                # Message de bienvenue
│
├── includes/                      # Fonctions
│   └── functions.php              # (redirect, debug)
│
└── data/                          # Scripts SQL
    └── database.sql            