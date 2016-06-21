For launch I recommend to use vagrant+homestead or LAMP-environment.

Server apache ar nginx. Domain - "places.loc".

For use YandexOAuth you have to change file config/services.php - add your id and password

Edit the .env file with database configs 

...

- git clone or download repository;
- composer install;
- php artisan migrate;
- php artisan db:seed;







