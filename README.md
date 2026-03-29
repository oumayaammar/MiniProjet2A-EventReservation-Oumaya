# 🎫 MiniProjet2A — Application Web de Gestion de Réservations d'Événements

![Symfony](https://img.shields.io/badge/Symfony-7.0-black?logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)

## 📋 Description

Application web complète développée avec **Symfony 7** permettant :
- Aux **utilisateurs** de consulter des événements et effectuer des réservations en ligne
- À l'**administrateur** de gérer les événements et consulter les réservations via une interface sécurisée

---

## 🚀 Technologies utilisées

|PHP | 8.2 | Langage principal |
| Symfony | 7.0 | Framework backend |
| Doctrine ORM | 3.x | Gestion base de données |
| MySQL | 8.0 | Base de données |
| Twig | 3.x | Moteur de templates |
| Bootstrap | 5.3 | Framework CSS |
| JWT | - | Authentification API |

---

## 🗂️ Structure des branches
```
main                    ← code stable et fonctionnel
dev                     ← intégration et tests 
feature/events-list     ← liste des événements
feature/events-Controller ← contrôleur événements
feature/form            ← formulaires
feature/templates       ← templates Twig
```

---

## ⚙️ Installation

### Prérequis
- PHP 8.2+
- Composer
- Symfony CLI
- MySQL 8.0

### 1. Cloner le projet
```bash
git clone https://github.com/oumayaammar/MiniProjet2A-EventReservation-Oumaya
cd MiniProjet2A-EventReservation-Oumaya
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer l'environnement
```bash
cp .env .env.local
```
Modifier `.env.local` :
```env
DATABASE_URL="mysql://root:@127.0.0.1:3306/event_db?serverVersion=8.0"
```

### 4. Créer la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Charger les données de test
```bash
php bin/console doctrine:fixtures:load
```

### 6. Lancer le serveur
```bash
symfony serve
```

Ouvrir 👉 http://127.0.0.1:8000

---

## 🔑 Comptes de test

| Rôle | Username | Mot de passe | URL |
|------|----------|-------------|-----|
| Administrateur | `admin` | `admin123` | `/admin/login` |
| Utilisateur | `user1` | `user123` | `/login` |

---

## 📱 Fonctionnalités

### Côté Utilisateur
- ✅ Inscription et connexion
- ✅ Liste des événements
- ✅ Détail d'un événement
- ✅ Formulaire de réservation
- ✅ Message de confirmation

### Côté Administrateur
- ✅ Connexion sécurisée
- ✅ Tableau de bord
- ✅ CRUD complet sur les événements
- ✅ Consultation des réservations
- ✅ Déconnexion sécurisée

---

## 👥 Membres de l'équipe

 Oumaya Ammar  | Développeur Full-Stack |

---

## 📄 Licence

Projet académique — ISSAT Sousse — Département Informatique 