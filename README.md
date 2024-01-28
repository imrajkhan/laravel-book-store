# Set up Environment

#### Npm version 10.2.4

#### Node version v20.11.0

### Composer required

#### Tested on PHP version 7.4 and 8.1

# Set Up Database connection

#### Either create database with name "laravel" where user should be root without password 
    CREATE DATABASE your_database_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
#### Or edit .env file in root directory to set Database connection details
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
# Clone the repo and run the below commands the in cloned directory
     run commands
     composer install
     npm install
     npm run dev
     php artisan migrate
     php artisan migrate --seed
     php artisan serve --port=8000

### Login with the following details.

    ADMIN detail:-
    Username: admin@example.com
    Password: password

    USER detail:-
    Username: user1@example.com, user2@example.com, user3@example.com, user4@example.com
    Password: password
