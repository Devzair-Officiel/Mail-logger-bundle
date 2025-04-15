#!/bin/bash

echo "📦 Installation des dépendances dev..."
composer install
composer require --dev phpunit/phpunit
composer dump-autoload
echo "✅ Installation terminée."

echo "💡 Lance les tests avec : ./vendor/bin/phpunit"
