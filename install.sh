#!/bin/sh -e

./composer.phar install
ln --symbolic --force vendor/bin/npm .
./npm install
ln --symbolic --force ../../node_modules app/Resources
bin/console doctrine:schema:update --force

exit 0
