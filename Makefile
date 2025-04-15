.PHONY: install-dev test dump-autoload release

install-dev:
	@echo "📦 Installation des dépendances dev (PHPUnit, tools)..."
	composer install
	composer require --dev phpunit/phpunit
	composer dump-autoload
	@echo "✅ Installation terminée."

test:
	@echo "🧪 Lancement des tests..."
	vendor/bin/phpunit --testdox

dump-autoload:
	@echo "♻️ Regénération de l'autoload Composer..."
	composer dump-autoload

release:
	@echo "🚀 Création du tag de release (v1.0.0)..."
	git tag v1.0.0
	git push origin v1.0.0
	@echo "✨ Tag v1.0.0 créé. Va sur GitHub pour créer la release."

