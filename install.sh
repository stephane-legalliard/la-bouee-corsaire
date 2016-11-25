#!/bin/sh -e

./composer.phar install
bin/console doctrine:schema:update --force

exit 0
