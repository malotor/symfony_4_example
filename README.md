
  $ composer install
  $ composer require symfony/web-server-bundle --dev

  $ docker-compose exec app php bin/console cache:clear
  $ docker-compose exec app bin/phpunit

