# 📦 CHANGELOG – MailLoggerBundle

Toutes les modifications notables du bundle seront documentées ici.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/)  
et ce projet adhère à [Semantic Versioning](https://semver.org/lang/fr/).

---

## [1.0.0] - 2025-04-15

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
