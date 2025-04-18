# 📦 CHANGELOG – MailLoggerBundle

Toutes les modifications notables du bundle seront documentées ici.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/)  
et ce projet adhère à [Semantic Versioning](https://semver.org/lang/fr/).

---

## [v2.0.0] - 2025-04-15

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


## [v2.0.1] - 2025-04-17
- mise a jour composer, branche et CHANGELOG
- chore: update changelog for v1.0.1
- mise a jour composer et changelog
- chore: update changelog for v1.0.1
- mise a jour composer
