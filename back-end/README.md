# E_commerce_backend
## Installation 
**To install this project, follow these steps:**
1. Clone the repo and cd into it 
2. ```composer install``` 
3. Rename or  ```copy .env.example file to .env ```
4. ```php artisan key:generate``` 
5. Set your database credentials in your .env file 
6. ```php artisan migrate --seed ``` . This will migrate the database and run any seeders necessary. See this episode. 
7.``` php artisan serve ``` 
8. Visit /api/admin if you want to access to admin backend. Admin User/Password: admin@example.com/password. 
9. Visit /api/customer if you want to access to customer backend
