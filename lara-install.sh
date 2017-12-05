#!/bin/sh

# lara-install.sh
#
#title           :lara-install.sh
#description     :Sets up a new Laravel project by installing npm, composer resources and artisan keygen, migrate, seed.
#author          :steve.g.banton@gmail.com
#

echo -n "Are you in homestead box (y/n)? "
read answer
if echo "$answer" | grep -iq "^y" ;then
    echo Yes
    composer install
    yarn
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    npm run dev
    phpunit
    npm run watch-poll
else
    echo No
fi
