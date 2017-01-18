#!/bin/sh -e

if [ ! -e ./composer.phar ]; then
	echo "Installation de composer…"
	EXPECTED_SIGNATURE=$(wget -q -O - https://composer.github.io/installer.sig)
	php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	ACTUAL_SIGNATURE=$(php -r "echo hash_file('SHA384', 'composer-setup.php');")

	if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]; then
		>&2 echo 'ERROR: Invalid installer signature'
		rm composer-setup.php
		exit 1
	fi

	php composer-setup.php --quiet
	rm composer-setup.php
fi

./composer.phar install --no-dev
bin/console doctrine:schema:update --force
bin/console assetic:dump
bin/console cache:clear

exit 0
