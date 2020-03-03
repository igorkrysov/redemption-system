<p align="center">##Что бы развернуть</p>
git clone https://github.com/igorkrysov/redemption-system.git

cd redemption-system

php composer.phar install

npm install && npm run dev

cp .env.example .env

Создаем БД и прописываем в .env файле параметры подключения к этой базе

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=test-task

DB_USERNAME=php

DB_PASSWORD=123

php artisan key:generate

php artisan migrate

php artisan passport:install

php artisan db:seed

php artisan serve

заходим на http://127.0.0.1:8080/login, данные логина и пароля уже вбиты

<p align="center">##Тестирования</p>
Для тестирования небоходима библиотека sqlite под php. Чаще всего она не установлена.

проверяем версию php: php -v

устанавливаем либу(вместо 7.2 вписываем свою версию):

sudo apt-get update

sudo apt-get install php7.2-sqlite

vendor/bin/phpunit

PS: Я использовал Laravel Framework 6.17.1(LTS). На данный момент(03.03.20) вышла 7 версия, но она забагованная, кроме того она не LTS.