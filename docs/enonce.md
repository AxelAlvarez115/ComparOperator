# Projet ComparOperator

## 🌄 Contexte

Notre client souhaite créer un site de comparaison de Tour Opérateur et il nous a confié le projet. Toute l'étude a été faite en amont et c'est à vous désormais de développer ce comparateur : le ComparOperator ! 🚢

Dans un souci de développement agile, vous devez produire dans un premier temps une preuve de concept (POC) : une version simplifiée qui montrera les fonctionnalités du site et un design attrayant mais sans identification ou sécurité spécifique.

À la fin de cette semaine de sprint, vous devrez avoir un prototype fonctionnel pour le présenter au client afin de récolter ses premières impressions dans le but de faire des modifications à sa convenance.

## 🔬 Fonctionnalités

**Le projet se découpe en 2 grandes parties : l'interface utilisateur (front-office) et l'interface administrateur (back-office).**

### 😎 Utilisateur

- Sur la page d'accueil, l'utilisateur peut visualiser toutes les destinations proposées par ComparOpérator.
- Quand une destination est sélectionnée, l'utilisateur est redirigé vers une page qui liste les Tours Opérateur (TO) pour cette destination.
- Chaque TO affichera sa note d'avis global (grade), le prix de la destination (price) ainsi que des messages d'avis d'autres utilisateurs.
- Un utilisateur peut écrire une review dans un simple champ de saisie. Il doit écrire son nom pour chaque avis laissé (comme pour le mini-chat).
  - 🔥 **Bonus** : un utilisateur ne peut écrire qu’une seule review par TO.
- Si le TO est premium, un lien vers son site officiel est disponible (au clic d'un bouton ou sur le nom du TO).
  - 🔥 **Bonus** : un utilisateur peut donner une note à un TO, ce qui augmente ou diminue son score moyen. Il ne peut pas noter deux fois le même TO.

## 👮 Administrateur

- La page administrateur est accessible juste en ajoutant /admin dans l'URL
  - 🔥 **Bonus** : authentification par mot de passe enregistré en session (un mot de passe unique pour tous les administrateurs d'un site).
- Sur cette page, l'administrateur peut ajouter un tour-opérateur.
- L'administrateur peut également ajouter des destinations aux TO parmi une liste fixe.
- Un tour opérateur peut être passé en premium sur cette page.

## 🛠 Consignes et outils

### Pour commencer, voici quelques consignes qui formeront une base de départ.

- Limiter le nombre de destinations à 10 pour démarrer.
- Hiérarchiser votre projet : un soin particulier devra être apporté à l'architecture du projet (chaque objet a son fichier, faites des pages de traitement, pensez à utiliser la session, rassemblez les fichiers d'affichage ensemble, rangez vos assets, etc.).
- Utiliser un framework CSS de votre choix pour optimiser votre workflow d'intégration.
- Votre projet PHP devra respecter les normes et conventions de rigueur [PHP Stardards Recommendations - PHP-FIG](https://www.php-fig.org/psr/).

## 📋 Gestion de projet

**Vous avez un planning de 5 jours pour accomplir la mission qui vous est confiée, vous devrez optimiser votre travail en équipe et définir/dispatcher les tâches entre vous.**

- Créer un backlog sur [Asana](https://asana.com/fr) ou [Trello](https://trello.com/) que vous rendrez collaboratif.
- Créer les users stories du projet et définir les tâches induites.
- Estimer les temps de travail pour chaque tâche.
- Attribuer vous les tâches en fonction des compétences de vos coéquipiers.

**Des Dailies meeting seront organisés entre l'équipe de développement et le chef de projet chaque matin :**

- On décrit ce que l'on a fait hier.
- On décrit ce que l'on va faire aujourd'hui.
- On explique nos problématiques et nos potentiels blocages.

## 🔥 Bonus Gestion de projet

- Découper le projet en 2 sprints égaux, ils devront être de difficulté égale.
- Le sprint 1 sera présenté lors d'une rétrospective avec le client, un premier livrable devra pouvoir être testable.

## 💻📱 Front-office

**Pour satisfaire le client, vous devrez porter un soin particulier sur l'ergonomie et le parcours utilisateur du projet, prévoyez des effets de navigation et de sélection intuitifs. Vous avez carte blanche pour imaginer la charte graphique.**

- L'interface graphique devra respecter la charte graphique définie (logotype, thème de couleurs, typographie et iconographie) et un soin devra être apporté à l'harmonisation de toutes les pages.
- Le parcours utilisateur devra être réfléchi et optimisé pour une utilisation intuitive des interfaces (liens clairs et cliquables, zones de navigation définies, zones d'action visibles et accessibles, textes lisibles et absence d'impasse et liens morts).
- L'interface front-office devra être responsive (ou mobile first), devra être compatible avec tous les terminaux du marché (desktop/laptop/tablet/phone).

## 🔥 Bonus Front-office

- L'interface utilisera des éléments graphiques prédéfinis (nav, sidebar, card, bouton, etc.) réutilisables sous forme de design-system à travers l'ensemble des pages de l'interface.

- Intégrer un POC d'une bannière promotionnelle d'un TO affichant une destination
mise en avant avec un prix réduit et un call-to-action renvoyant vers l'offre.

## 📚 Back-office

**Le projet est amené à évoluer (méthode agile) il doit nécessairement pouvoir être modifiable, vous allez concevoir la partie back-end en POO.**

### Diagrammes

Le chef de projet vous a préparé la base de données et son diagramme UML ainsi que le diagramme de classes pour les objets :
- [Diagramme simple](https://drive.google.com/file/d/1WwWWTW34JeQQyH1sqQ1Fi6BlE4CCWHT5/view)
- [Diagramme avancé](https://drive.google.com/file/d/1epFdVRX_N5eMWzuNcQJjmADCbq40aw0-/view)

### Base de données

La base de données (avec quelques données exemple) vous est fournie aussi :
- [Base de données simple](https://drive.google.com/file/d/1H2iIWjbH_t-x2_CqYDV-gz892HSK0Qb5/view)
- [Base de données avancée](https://drive.google.com/file/d/1AsB7D9Afn7vtS6b0Kp6Dv1Z8e5__3v2P/view)

