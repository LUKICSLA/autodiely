cd C:\Users\pc\Documents\laravel_projects\autodiely
php artisan migrate:fresh
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=CarsSeeder
php artisan db:seed --class=PartsSeeder
php artisan serve