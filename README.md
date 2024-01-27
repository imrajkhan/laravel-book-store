## Set up Environment

### npm version 10.2.4

### node version v20.11.0

### Tested on PHP version 7.4 and 8.1

### create DB with name "laravel" in mysql shell where user is root with no password 
    CREATE DATABASE your_database_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
### Just clone it, run below commands in the cloned directory
     run commands
     composer install
     npm install
     npm run dev
     php artisan migrate
     php artisan migrate --seed
     php artisan serve --port=8000
