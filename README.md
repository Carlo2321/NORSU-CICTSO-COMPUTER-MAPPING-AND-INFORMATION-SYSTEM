<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About NORSU CMIS

This project is made using Laravel v.10x and Filament v3.0x. It is a computer mapping system, designed to show the graphical representation of each computer of Negros Oriental State University Main Campus. To display the availability of each computer whether it is disconnected or connected.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## Installing the Project

- Clone or download project
- Do ```composer install```
- Do ```npm install```
- Install Laravel Filament v3.0x using the command ```composer require filament/filament:"^3.2" -W``` and ```php artisan filament:install --panels```
- For the activity logs do ```composer require alexjustesen/filament-spatie-laravel-activitylog:^0.7```
- Publish the SpatieActivityLog config file using ```php artisan vendor:publish --tag="filament-spatie-activitylog-config"```
- To fix the error "Array to string conversion". Navigate through ```vendor/filament/src/FilamentManager.php and change "name" to "userName" in the line "return $user->getAttributeValue('name');".```
- Since the filament project has been modified and is under development. Insert a user through the database.
- Rename .env.example to .env and match the database name to yours and do ```php artisan migrate```.
- Open the web app using the commands ```php artisan serve``` and ```npm run dev``` and paste the directory ```http://127.0.0.1:8000/admin```


