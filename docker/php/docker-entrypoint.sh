#!/bin/bash

cd /var/www/html/TP-Final-3IW-ESGI

# Installation des dépendances PHP
composer install

# Installation des dépendances Node.js et build
npm install
npm run build

php artisan migrate

# Copier le fichier .env si nécessaire
if [ ! -f .env ]; then
    cp .env.example .env
    # Mettre à jour les configurations de base de données
    sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env
    sed -i 's/DB_DATABASE=laravel/DB_DATABASE=laravel/' .env
    sed -i 's/DB_USERNAME=root/DB_USERNAME=laravel/' .env
    sed -i 's/DB_PASSWORD=/DB_PASSWORD=secret/' .env
fi

# Démarrer PHP-FPM
exec "$@"
