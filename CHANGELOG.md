# 📦 CHANGELOG – MailLoggerBundle

## [v1.0.0] - 2025-04-15

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

## [v1.0.1] - 2025-04-17
- � Compatibilité Symfony 5.4 et suppression du composer.lock
- chore: update changelog for v1.0.1
- � Compatibilité Symfony 5.4 et suppression du composer.lock
- mise a jour changelog
- chore: update changelog for v1.0.1
- mise a jour README et CHANGELOG
