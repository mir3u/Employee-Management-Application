**REQUIREMENTS and basic commands**


For WINDOWS:
Install 
php 7.4: https://windows.php.net/downloads/releases/php-7.4.5-Win32-vc15-x64.zip

Composer: https://getcomposer.org/Composer-Setup.exe

Symfony cli: https://get.symfony.com/cli/setup.exe

Yarn: https://classic.yarnpkg.com/en/docs/install/

FOR UNIX/MAC:

php 7.4: for unix ppa-ondrej for mac  brew install php@7.4

Composer: https://getcomposer.org/Composer-Setup.exe

Symfony cli: https://get.symfony.com/cli/setup.exe

Yarn: https://classic.yarnpkg.com/en/docs/install/


Create a schema in mysql.

Create a .env file and add: DATABASE_URL=mysql://{{mysqlUser}}:{{mysqlPassword@127.0.0.1:3306/{{nameOfSchema}}

After this run the following commands:

composer install

php bin/console doctrine:schema:update --force --dump-sql

php bin/console cache:warmup

To start the server: symfony server:start
If you change css change the assets/css/app.css file and be sure to run yarn encore dev --watch (continuous compiling) or yarn encore dev (single compiling)

