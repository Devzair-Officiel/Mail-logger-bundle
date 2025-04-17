# 📦 CHANGELOG – MailLoggerBundle

Toutes les modifications notables du bundle seront documentées ici.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/)  
et ce projet adhère à [Semantic Versioning](https://semver.org/lang/fr/).

---

## [1.0.1] - 2025-04-15

### ✨ Ajouté

- Création du bundle MailLoggerBundle
- Entité `LoggedEmail` avec mapping Doctrine
- Service `EmailLogger` pour la persistance
- EventSubscriber `EmailLoggerSubscriber` (logs automatiques)
- Commandes :
  - `mail:log` : affichage des emails envoyés
  - `mail:log --json` : version JSON
  - `mail:config` : afficher la config active
  - `mail:test` : envoi d’un mail de test
- Configuration centralisée via `mail_logger.yaml`
- Injection de `%mail_logger.enabled%` dans les services

## [v1.0.2] - 2025-04-16
- chore: update changelog for v1.0.2
- ✨ feat(composer): ajouter la dépendance symfony/validator

## [v1.0.3] - 2025-04-16
- ✨ feat(composer): ajouter la dépendance symfony/validator
-  maj
- chore: update changelog for v1.0.2
- chore: update changelog for v1.0.2
- ✨ feat(composer): ajouter la dépendance symfony/validator

## [v1.0.4] - 2025-04-16
- Déplacement du fichier MailLoggerBundle dans le dossier src

## [v1.0.5] - 2025-04-16
- mise a jour du fichier composer.json pour l'autoload

## [v1.0.6] - 2025-04-16
- mise a jour du fichier MailLoggerExtension, car il n'y a pas de services.yaml

## [v1.0.1] - 2025-04-17
- mise a jour composer
