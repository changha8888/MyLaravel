
	--- LARAVEL PROJECT ---


	Description : Project Laravel trainning.
	Create by : Ho Nghia Linh.
	Status : Updating...


	- DETAILS:

	+ Framework: Laravel 5.4
	+ Php ver: 7.1.1

	- INSTALLATION:

 	+ Install Server Requirements: php, apache2, mysql...
 	+ Install Composer.



Apr-4-2017: - Chuc nang Login:

+ Input/validate cac field: email, password(halfwidth,min:8).
+ Remember me( auto login cho nhung lan access sau).


Cai dat:
1. Tao database ( creat database )
2. Config database trong file .env
3. Tao bang CSDL su dung Migration (php artisan migrate )
4. Seeding CSDL ( php artisan db:seed )

Coding:

- 2 Route :getLogin va postLogin ( routes/web.php )
- Form Login ( resources/views/login.blade.php )
- Creat LoginController / php artisan make:controller LoginController (App/Http/Controllers/LoginController.php)
- Make seeder / php artisan make:seeder UsersTableSeeder ( database/seeds/UsersTableSeeder.php ).


