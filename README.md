# Laravel - Blog Test Task!


### Quick Project Setup - Installation

You're absolutely right! Here's a revised version with separate lines for code snippets:

1. Clone the repository
To get started, open your terminal and run the command:
```git clone https://github.com/1986webdeveloper/blog-test.git```
This will create a copy of the project on your local machine.


2. Install Dependencies
Next, navigate to the project's root folder in the terminal and run the following commands:

  ```composer install```
  ```npm install```

  This will install all the required Laravel dependencies.


3. Create the .env file
After the dependencies are installed, copy the example file using the command:

  ```cp .env.example .env```

  in the terminal from the project's root folder. Update the database credentials in the .env file with your own database details.


4. Generate an Application Key
In the terminal, run:

  ```php artisan key:generate```

  to generate a unique application key for your project. Then, create a symbolic link for the storage folder by running:

  ```php artisan storage:link```


5. Setup the Database Schema
Once the database credentials have been updated, setup the database schema using the command:

  ```php artisan migrate```

  in the terminal from the project's root folder.


6. Compile Assets
Run:

  ```npm run dev```

  in the terminal to create a development build of your project. This command will compile your assets and generate a public folder that contains the compiled code.


7. Start the Server
To start the server, run:

  ```php artisan serve```

  in the terminal from the project's root folder. This will launch your Laravel project.


8. Test Your Project
Finally, check the unit testing by running:

  ```php artisan test```

  in the terminal from the project's root folder.


9. View Your Project
To view your project locally, open your web browser and navigate to:

  ```http://127.0.0.1:8000/```

  This will open the project in your default web browser, and you should see the homepage of your Laravel project.


That's it! You're now ready to start working on your Laravel project.



### Implemented the following features - Requirements


1. Home Page:
  - Users should be able to view a list of all blog posts on the homepage.
  - Blog posts should be ordered by most recent first.

2. Blog Post Details:
  - Users should be able to view the details of each blog post on a separate page.

3. Create Blog Post:
  - Users should be able to create a new blog post by filling out a form with the following fields:
  - Title (required, max 255 characters)
  - Body (required)
  - Image (optional)

4. Edit/Delete Blog Post:
  - Users should be able to edit or delete their own blog posts.

That's it! 