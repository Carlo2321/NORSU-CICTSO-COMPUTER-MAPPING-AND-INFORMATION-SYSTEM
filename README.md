## About NORSU CMIS

This system is a capstone project submitted and developed by Carlo Estaras, Boni Jun Sechico and April Rose Sarte. This is a requirement for the degree of Bachelor of Science in Information Technology.

The project is made using Laravel v.10x and Filament v3.0x. It is a computer mapping system, designed to show the graphical representation of each computer of the College of Arts and Sciences buidling of Negros Oriental State University Main Campus. To display the availability of each computer whether it is working or not working.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

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
- Login through the Network Admin account and Admin account.
- Username: NetworkAdmin      Username: Admin 
  Password: password          Password: 12345


