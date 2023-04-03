
# Find the breach - Site

[![My Skills](https://skills.thijs.gg/icons?i=php)](https://skills.thijs.gg)[![My Skills](https://skills.thijs.gg/icons?i=html)](https://skills.thijs.gg)[![My Skills](https://skills.thijs.gg/icons?i=css)](https://skills.thijs.gg)[![My Skills](https://skills.thijs.gg/icons?i=js)](https://skills.thijs.gg)

Projet universitaire visant à la création d'un **serious game** sur les réseaux, évolutif.  
Nous avons choisi un scénario afin de rendre l'application plus attrayante :   

Vous êtes un étudiant en informatique et vous venez de trouver une signature laissée par un groupe de hackers. Votre mission est de les retrouver afin de les dénoncer à la police.  

Ce site sert à se connecter et à administrer l'application.

## Demandes ✍️

- Possibilité de télécharger le jeu
- Administration de la base de données
- Création de salons de jeu
- Intégration de code JS pour simplifier la navigation et la compréhension

## Ce que nous avons réalisé ⚙️

- Une page d'accueil qui explique l'histoire et le fonctionnement du jeu
- Un onglet de téléchargement accessible aux utilisateurs connectés
- Une page de connexion/inscription
- Des pages réservées aux administrateurs où ils peuvent :
  - Modifier / ajouter / supprimer des questions dans la partie "solo"
  - Ajouter des salons, les modifier et y ajouter des questions
  - Invitation d'utilisateurs pour les salons
  - Gestion des utilisateurs
  - Récupération des scores

## Démarrage 🚀

Site accessible sur <https://findthebreach.ddns.net>

## Utilisation 🎮

Pour simplifier l’hébergement du site, nous avons eu recours à docker.
Pour l’héberger, il n’y a rien de plus simple, il vous suffit d’avoir docker d’installé et de lancer la commande suivante :

```bash
docker run -d -p 80 :80 fredegen/sitesaes4:VOTRE ARCHITECTURE PROCESSEUR
```

Il est compatible avec deux architectures, amd64 et arm64 qui sont les deux plus courantes actuellement. Il faut donc remplacer VOTRE ARCHITECTURE PROCESSEUR par celle qui vous concerne.

---

**Remarque** : Pour des soucis de sécurité si vous voulez héberger le site fraichement télécharger depuis GitHub, il faudra aller dans le répertoire “Core/Database/” et modifier le fichier Connection.php.

Vous allez trouver à la ligne 39 ce code :

```php
return Connection::connect("kandula.db.elephantsql.com","dyfslksj","");
```

Il faudra mettre entre les guillemets du 3ème argument le mot de passe suivant communiqué par l'intermédiaire d'Amétice.

Pour ce qui est de l’utilisation du site, nous l’avons hébergé à l’adresse suivante :
https://findthebreach.ddns.net

## Membres du projet 🧑‍💻

- Ceccarelli Luca
- Egenscheviller Frédéric
- Ramdani Djibril
- Saadi Nils
- Vial Amaury
