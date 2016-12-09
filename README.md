La Bouée Corsaire
=================

## Installation

Créez une base de données vide, avec le nom de votre choix.

Installez les dépendances de l’application en lançant le script './install.sh'

Lorsque la question vous est posée, renseignez le nom de la base de données et
 les identifiants d’un utilisateur autorisé à la modifier.

## Utilisation

Lancez le script './run.sh' pour lancer une instance de l’application.

## Données de test

Vous pouvez remplir la base de données avec des données de test en important les
 fichiers dont le nom commence par "test" dans le répertoire '/sql'. Importez en
 premier le fichier 'test_0_users.sql' puis les fichiers 'test_1_needs.sql' et
 'test_1_services.sql'.

## Tests

Après modification de classes PHP, lancez le script './phpunit' pour tester le
 bon fonctionnement de l’application.
