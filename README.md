# Laravel Test Task


### Quick Project Setup - Installation

1. To clone the repository using the command line, open your terminal and type in the following command:
```git clone https://github.com/1986webdeveloper/blog-test.git```

2. Next, install Laravel dependencies by running the following commands in the terminal:
```composer install```
```npm install```

3. After the dependencies are installed, copy the example file using the following command from the project's root folder:
```cp .env.example .env```

4. Update the database credentials in the .env file with your own database details.

5. Once the database credentials have been updated, setup the database schema using the following command in the terminal from the project's root folder:
```php artisan migrate```

6. Running the command 'npm run dev' will create a development build of your project. This command will compile your assets and generate a public folder that contains the compiled code.
```npm run dev```

7. Then start your server by running the following command in the terminal:
```php artisan serve```

8. Finally, check the unit testing by running the following command in the terminal:
```php artisan test```

9. To view your project locally, you can open your web browser and navigate to the following address:
```http://127.0.0.1:8000/```


Finally - This will open the project in your default web browser. You should see the homepage of your Laravel project.


Thanks

