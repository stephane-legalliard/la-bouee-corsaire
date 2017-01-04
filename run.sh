#!/bin/sh -e

bin/console cache:warmup
bin/console server:run

exit 0
