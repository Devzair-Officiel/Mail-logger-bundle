.PHONY: install-dev test dump-autoload release changelog

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
ifndef VERSION
	$(error ❌ Tu dois spécifier la nouvelle version avec VERSION=x.y.z)
endif
ifndef PREV
	$(error ❌ Tu dois spécifier la version précédente avec PREV=x.y.z)
endif
	@if ! echo $(VERSION) | grep -Eq '^[0-9]+\.[0-9]+\.[0-9]+$$'; then \
		echo "❌ VERSION invalide : $(VERSION) (format attendu : x.y.z)"; \
		exit 1; \
	fi
	@if ! echo $(PREV) | grep -Eq '^[0-9]+\.[0-9]+\.[0-9]+$$'; then \
		echo "❌ PREV invalide : $(PREV) (format attendu : x.y.z)"; \
		exit 1; \
	fi
	@echo "🚀 Création de la release v$(VERSION)..."
	./release.sh v$(VERSION) v$(PREV)

changelog:
ifndef VERSION
	$(error ❌ Tu dois spécifier la nouvelle version avec VERSION=x.y.z)
endif
ifndef PREV
	$(error ❌ Tu dois spécifier la version précédente avec PREV=x.y.z)
endif
	@if ! echo $(VERSION) | grep -Eq '^[0-9]+\.[0-9]+\.[0-9]+$$'; then \
		echo "❌ VERSION invalide : $(VERSION) (format attendu : x.y.z)"; \
		exit 1; \
	fi
	@if ! echo $(PREV) | grep -Eq '^[0-9]+\.[0-9]+\.[0-9]+$$'; then \
		echo "❌ PREV invalide : $(PREV) (format attendu : x.y.z)"; \
		exit 1; \
	fi
	@echo "📝 Génération du changelog pour v$(VERSION)..."
	@git log v$(PREV)..HEAD --pretty=format:"- %s" --no-merges > /tmp/changelog-v$(VERSION).md
	@echo "## [v$(VERSION)] - $$(date +%Y-%m-%d)" > /tmp/changelog-block.md
	@cat /tmp/changelog-v$(VERSION).md >> /tmp/changelog-block.md
	@echo "" >> $(CHANGELOG_FILE)
	@cat /tmp/changelog-block.md >> $(CHANGELOG_FILE)
	@rm -f /tmp/changelog-*.md
	@git add $(CHANGELOG_FILE)
	@git commit -m "chore: update changelog for v$(VERSION)"
	@echo "✅ Changelog ajouté pour v$(VERSION) dans $(CHANGELOG_FILE)"
