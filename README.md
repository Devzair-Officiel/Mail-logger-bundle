# 📬 MailLoggerBundle

Un bundle Symfony léger, modulaire et moderne pour **logger automatiquement tous les emails envoyés** via Symfony Mailer.

---

## ✨ Pourquoi utiliser ce bundle ?

Dans les projets Symfony, on envoie souvent des emails (confirmation d’inscription, notifications, support, etc.).  
Mais en cas de bug ou de doute, il est difficile de savoir :

- **Quel email a été envoyé ?**
- **À qui ?**
- **Avec quel contenu ?**
- **Avec quel résultat (succès / échec) ?**

### ❌ Problèmes classiques sans ce bundle :

| Situation | Conséquence |
|----------|-------------|
| Pas de trace des envois | Impossibilité de diagnostiquer un problème de mail |
| Pas de logs centralisés | Impossible de prouver un envoi ou de refaire un test |
| Erreurs silencieuses | Les échecs SMTP passent inaperçus |

### ✅ Ce que ce bundle vous apporte :

- 📦 Une entité `LoggedEmail` persistée automatiquement
- 📬 Une écoute des événements `SentMessageEvent` et `FailedMessageEvent`
- 🧠 Un `EmailLogger` injectable et configurable
- 🔍 Une commande CLI `mail:log` pour voir les derniers mails
- 🛠 Une commande `mail:test` pour tester facilement le système de mail
- 🔄 Configuration activable par paramètre `mail_logger.enabled`

---

## 🔧 Installation

Ajoutez le bundle à votre projet Symfony  :

```bash
composer require devzair/mail-logger-bundle

composer require symfony/mailer symfony/mime


⚙️ Configuration

1. Déclarez le paramètre pour activer le logger :
# config/packages/parameters.yaml
parameters:
    mail_logger.enabled: true

2. Injectez ce paramètre dans le service :
# config/services.yaml
DevZair\MailLoggerBundle\Service\EmailLogger:
    arguments:
        $loggingEnabled: '%mail_logger.enabled%'


🧪 Commandes disponibles:

    🔍 Voir les 10 derniers emails envoyés
        php bin/console mail:log

    🧾 Affichage JSON (pour API, tests, exports)
        php bin/console mail:log --json

    🔢 Limiter le nombre de résultats
        php bin/console mail:log --limit=25

    🧪 Envoi d’un email de test
        php bin/console mail:test

    📦 Lister tous les paramètres du bundle
        php bin/console mail:config


🧠 Architecture technique

Élément                         | Rôle

LoggedEmail                     | Entité Doctrine pour stocker les emails
EmailLogger                     | Service principal injecté, gère la persistance
EmailLoggerSubscriber           | EventSubscriber qui écoute les envois de mails
MailLogCommand                  | Commande CLI pour afficher les logs
MailTestCommand                 | Commande CLI pour envoyer un mail test
MailLoggerBundleConfigCommand   | Commande CLI pour afficher tous les paramètres du bundle


🧰 Fonctionnement

    Symfony envoie un mail via MailerInterface

    Le bundle écoute les événements SentMessageEvent et FailedMessageEvent

    Le logger transforme les adresses (objet Address) en données JSON (name + email)

    L'entité est persistée automatiquement en base

    Les commandes permettent de consulter ou tester les envois


📌 Prérequis

    Symfony >= 6.3 / 7.x

    PHP >= 8.1

    symfony/mailer, symfony/mime

    Doctrine ORM

