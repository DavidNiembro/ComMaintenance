# ComMaintenance

## Installation

1. Cloner le repo

2. Allez dans le dossier du repo

3. Installer les dépendances du projet

   composer install

4. Dupliquer le fichier .env.exemple en le renommant en .env

5. Générer une clé

   php artisan key:generate

6. Renseigner le nom de la base de donnée dans le .env ainsi que les identifiants de votre serveur SQL

7. Créer la base de donnée

   php artisan migrate

8. Peupler la base

   php artisan migrate:fresh --seed

## Identification

| Rôle  | Email          | Mot de passe |
| ----- | -------------- | ------------ |
| admin | admin@admin.ch | secret       |
| user  | user@user.ch   | secret       |

