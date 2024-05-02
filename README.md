# Harbour Space Bangkok Student Portal

Harbour Space Bangkok Student Portal is a web application developed as a school project for the "Introduction to Web Development" course using Laravel framework in Harbour Space University. The project idea is to develop a web application that will serve as a student portal for Harbour Space students in Bangkok to support their learning and life in Thailand. The platform will offer a diverse array of resources to aid students in their onboarding and overall student experience.

## Application Features

1. Allowing users to search for posts based on keywords.
2. Permitting registered users to create comments on posts.
3. Providing admin users with additional capabilities for managing posts and comments, such as creating, editing, and deleting comments.

## Development Installation Guide

Follow these steps to set up the development environment for the project:

1. **Create Project Directory**: Create a directory for the project on your local machine.

2. **Clone the Repository**: Clone the project repository into the directory you created:
```
git clone https://github.com/ginoasuncion/hs-bkk-student-portal
```

4. **Install Dependencies**: Navigate into the project directory and install Composer dependencies:
```
composer install
```

6. **Create Configuration File**: Duplicate the `.env.example` file and rename it to `.env`:
```
cp .env.example .env
```

8. **Generate Application Key**: Generate an application key by running the following command:
```
php artisan key:generate
```

10. **Migrate Database Tables**: Run database migrations to create necessary tables:
```
php artisan migrate
```

12. **Create Synthetic Data**: Use Laravel's tinker tool to generate and insert fake posts into the database:
```
php artisan tinker
```
```
\App\Models\Post::factory(50)->create();
```

14. **Install Node.js Dependencies**: Install Node.js dependencies by running the following command:
```npm install```

15. **Run npm run dev**: Run the following command in your terminal:
 ```npm run dev```

16. **Start the Development Server**: Start the Laravel development server in terminal to view the application in your web browser:
 ```
php artisan serve
```

18. **Access the Application**: Open your web browser and navigate to the URL provided by the Laravel development server to access the application.


## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.
