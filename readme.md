# RD Temp ECF

## Déploiement local

### installation de XAMPP

1. Télécharger XAMPP [ici](https://www.apachefriends.org/download.html)

2. Installer XAMPP en s'aidant de la [documentation](https://www.apachefriends.org/faq_windows.html)

### Rapatriement du projet
1. créer un projet symfony en entrant la commande suivante dans un terminal :
    - `composer create-project symfony/skeleton my_project_name`
2. Initialiser un nouveau git en entrant la commande suivante dans un terminal :
    - `git init`
3. cloner le projet avec la commande
    - `git clone https://github.com/JAVRAF/RD_Temp_ECF.git`
4. Installer les dépendances en entrant la commande suivante dans un terminal :
    - `composer install`
### Création de la base de données
4. Creer un nouveau fichier .env.local en copiant/collant le fichier .env à la racine du projet puis
   1. commenter la ligne `DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"`
   2. décommenter la ligne `# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"` et modifier la ligne avec les informations adéquat pour connecter le projet au serveur MySQL
   3. creer une nouvelle base de données via phpMyAdmin
   4. entrer la commande `php bin/console doctrine:migrations:migrate` dans un terminal pour éxecuter les migrations sur la base de données
   5. importer le fichier fixtures.sql via phpMyAdmin

## déploiement en ligne avec Heroku

Vous devez avoir créé un compte sur [Heroku](https://www.heroku.com/) pour continuer

1. Dans le terminal de votre application entrez les commandes `heroku login` et `heroku create`
2. Ajouter Jaws DB MySQL avec la commande `heroku addons:create jawsdb:kitefin`
3. ajouter la variable d'environnement avec la commande `heroku config:set APP_ENV=PROD`
4. déployer le projet avec la commande `git push heroku master`

## Création d'un admin

Creer un admin grâce à la page /admin/add de l'application.