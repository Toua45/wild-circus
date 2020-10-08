# wild-circus


 Projet développé dans le cadre d'une évaluation lors de ma formation à la Wild Code School.
 
# Installer le projet :

- Cloner le repository

- Créer et configurer le fichier .env.local (copie non versionnée du fichier .env), en renseignant les éléments nécessaires à la connexion à la BDD : 
*db_user*:  votre nom d’utilisateur
*db_password*: votre mot de passe
*db_name*: le nom de la base de données

- Installer composer

  $ composer install

- Installer et initialiser yarn

  $ yarn install 
  
- Créer une base de données, avec la commande :

$ php bin/console doctrine:database:create

- Mettre à jour la base de données, avec la commande :

$ php bin/console make:migration
$ php bin/console doctrine:schema:update --force

- Charger les fixtures : 

$ php bin/console doctrine:fixture:load --append

- Exécuter Webpack, avec la commande :

$ yarn encore dev –watch (pour un environnement de développement)
$ yarn encore production (pour un environnement de production)

- Lancer le serveur, avec la commande :

$ symfony server:start

