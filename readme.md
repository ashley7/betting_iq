<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

 

## About Betting IQ

 This is an application that saves you from total loss in case you are to loose all the money on a single ticket

## Quickstart
> Ubuntu
- Install Laravel, an open-source PHP web application framework with expressive, elegant syntax using the guide below

 `sudo apt update && sudo apt upgrade`

 `sudo apt install php7.2-common php7.2-cli php7.2-gd php7.2-mysql php7.2-curl php7.2-intl php7.2-mbstring php7.2-bcmath php7.2-imap php7.2-xml php7.2-zip`
 
 `curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer`

- Install MySQL 
- Create a database and name it **betting**
- Make a copy of `.env.example` file to `.env` inside your project root and fill in the database information.
- Run `composer install` or ```php composer.phar install```
- Run `php artisan key:generate` 
- Run `php artisan migrate` to create the database schema
- Run `php artisan db:seed` to run seeders, if any.
- Run `php artisan serve` to run the application. This attempts to run the app on port 8000. If its already in use. Specify a port by running `php artisan serve --port="8888"`