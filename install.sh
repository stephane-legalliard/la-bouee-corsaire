#!/bin/sh -e

./composer.phar install
./npm install
bin/console doctrine:schema:update --force

exit 0
