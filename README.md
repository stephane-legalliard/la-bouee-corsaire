La Bouée Corsaire
=================

## Installation

Créez une base de données vide, avec le nom de votre choix.

Installez les dépendances de l’application en lançant le script './install.sh'

Lorsque la question vous est posée, renseignez le nom de la base de données et
 les identifiants d’un utilisateur autorisé à la modifier.

Configurez ensuite votre serveur de mail en donnant les identifiants d’un
 utilisateur du système autorisé à l’utiliser pour envoyer des messages à
 des serveurs distants. Le champ 'postmaster_email' correspond à l’adresse qui
 sera affiché en tant qu’expéditeur des messages envoyés par l’application.

## Utilisation

Lancez le script './run.sh' pour lancer une instance de l’application.

## Tests

Après modification de classes PHP, lancez le script './phpunit' pour tester le
 bon fonctionnement de l’application.
