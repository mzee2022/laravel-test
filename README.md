## About This Project

This application is about creating a todo list.

This application has following featured.

- User login
- User logout
- View own user profile
- Edit own user profile
- View "todos"
- Create new "todos"
- Edit existing "todos"
- Delete "todos"

## Project Requirements

This project needs following requirements before setting up.

- PHP Version 8.1
- Node Version v14.17.4
- Composer 2
- SQLite Drivers `sudo apt-get install php8.1-sqlite3`


## Setting Up This Project

This project can be setup using the following steps.

- Clone this project from github
- Run `composer install` to install PHP packages
- Run `php artisan migrate` to run the migrations
- Run `npm install` to install Node packages

## Running The Application

For this application to run we need to fire up 2 services.

- First we need to start laravel server using `php artisan serve` command
- Then, we need to start vite server using `npm run dev` command

After that the application should be accessible at the following url:
http://127.0.0.1:8000/#

The default credentials for login are following:

- Email: `admin@gmail.com`
- Password: `12345678`