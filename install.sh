#!/bin/sh -e

./composer.phar install
ln --symbolic --force vendor/bin/simple-phpunit ./phpunit
bin/console doctrine:schema:update --force

exit 0
