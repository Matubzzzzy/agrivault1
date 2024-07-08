# AgriVault
## The number 1 link to agriculture stores 



AgriVault is a platform aimed at facilitating the connection between farmers and storage facilities, providing a user-friendly interface for farmers to explore and access reliable agricultural storage options. 


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

npm run dev  //if you wish to modify it
```

For Databse Setup...

```sh
php artisan migrate
```

AgriVault uses VS Code extensions let you add languages, debuggers, and tools to your installation to support your development workflow.




## Project Structure
![README](https://github.com/Matubzzzzy/agrivault1/assets/131341869/398e1810-0a50-476f-a435-1373f0dca6a3)


## License

The framework,Laravel used is an open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT)




