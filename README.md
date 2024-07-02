# AgriVault
## The number 1 link to agriculture stores 

[![N|Solid](https://img.icons8.com/?size=100&id=lRjcvhvtR81o&format=png&color=000000)](https://laravel.com/)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

AgriVault is a platform aimed at facilitating the connection between farmers and storage facilities, providing a user-friendly interface for farmers to explore and access reliable agricultural storage options. 

Idea inception: https://www.researchgate.net/publication/351764965_Complete_Guide_to_Agricultural_Product_Processing_and_Storage_Complete_Guide_to_Agricultural_Product_Processing_and_Storage

This repository contains the source code for the AgriVault website, which offers features such as:

- User Registration: Farmers can create accounts on AgriVault to access the platform's features.
- Storage Facility Listings: AgriVault provides a comprehensive listing of storage facilities, allowing farmers to browse and compare options based on their needs and location.
- Application Submission: Farmers can submit applications for their chosen storage facilities directly through the platform.
- Timely Response: AgriVault ensures timely responses to farmers' storage requests, facilitating seamless communication and coordination.

## Features

- User-friendly interface
- Seamless navigation
- Secure user authentication
- Responsive design for desktop devices

> The overriding design goal for AgriVault
> a simple to use application that
> enables farmers and commercial 
> agricultural product companies
> to seek storage of their comodities

## Tech

AgriVault uses a number of open source projects to work properly:

- [VSCode](https://code.visualstudio.com/) - IDE used to develop the application
- [Laravel](https://laravel.com/) - open-source PHP web application framework
- [Artisan](https://laravel.com/docs/5.0/artisan) - command-line interface included with Laravel
- [Composer](https://getcomposer.org/) - used to manage laravel dependencies
- [node.js](https://nodejs.org/en/download/package-manager)

## Installation

AgriVault uses [Laravel](https://laravel.com/) v10+ to run.

Install the dependencies and devDependencies and start the server.
Dependencies to install are: 
[Composer](https://getcomposer.org/)

```
composer create-project laravel/laravel AgriVault

composer global require laravel/installer
laravel new AgriVault

cd AgriVault
php artisan serve
```

For Databse Setup...

```sh
php artisan migrate
```

AgriVault uses VS Code extensions let you add languages, debuggers, and tools to your installation to support your development workflow.


## Development

Want to contribute? 

1. Clone this repository to your local machine.
2. Open the project in an IDE prefferrably VSCode
2. Set up the laravel project throught your terminal
3. Configure the database connection in the database/migrations/2024_06_30_214058_create_storage_facilities_table file.
4. Run the application locally and start exploring the features of AgriVault.

Step one:

```sh
cd AgriVault
```

Step two:

```sh
php artisan serve
```

Step three:

```sh
php artisan migrate
```


## Project Structure
AgriVault/
├─ app/
│  ├─ Console/
│  ├─ Exceptions/
│  ├─ Http/
│  ├─ Models/
│  ├─ Providers/
├─ bootstrap/
│  ├─ app.php
│  ├─ cache/
├─ config/
├─ database/
├─ public/
├─ routes/
├─ storage/
├─ tests/
├─ .editorconfig
├─ .env.example
├─ .gitatributes
├─ .gitignore
├─ READme.md
├─ artisan
├─ composer.json
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ tailwind.config.js
├─ vite.config.js
├─ Concole/
├─ resources/


## License

The framework,Laravel used is an open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT)




