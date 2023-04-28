# Laravel - Blog Test Task!


### Quick Project Setup - Installation

1. Clone the repository
To get started, open your terminal and run the command ```git clone https://github.com/1986webdeveloper/blog-test.git```. This will create a copy of the project on your local machine.

2. Install Dependencies
Next, navigate to the project's root folder in the terminal and run ```composer install``` and ```npm install```. This will install all the required Laravel dependencies.

3. Create the .env file
After the dependencies are installed, copy the example file using the command ```cp .env.example .env``` in the terminal from the project's root folder. Update the database credentials in the .env file with your own database details.

4. Generate an Application Key
In the terminal, run ```php artisan key:generate``` to generate a unique application key for your project. Then, create a symbolic link for the storage folder by running ```php artisan storage:link```.

5. Setup the Database Schema
Once the database credentials have been updated, setup the database schema using the command ```php artisan migrate``` in the terminal from the project's root folder.

6. Compile Assets
Run ```npm run dev``` in the terminal to create a development build of your project. This command will compile your assets and generate a public folder that contains the compiled code.

7. Start the Server
To start the server, run ```php artisan serve``` in the terminal from the project's root folder. This will launch your Laravel project.

8. Test Your Project
Finally, check the unit testing by running ```php artisan test``` in the terminal from the project's root folder.

9. View Your Project
To view your project locally, open your web browser and navigate to ```http://127.0.0.1:8000/```. This will open the project in your default web browser, and you should see the homepage of your Laravel project.

That's it! You're now ready to start working on your Laravel project.

