#!/bin/sh -e

./composer.phar install
ln --symbolic --force vendor/bin/simple-phpunit ./phpunit
ln --symbolic --force ./simple-phpunit vendor/bin/phpunit
bin/console doctrine:schema:update --force
bin/console cache:clear

exit 0
