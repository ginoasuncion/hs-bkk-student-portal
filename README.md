# Harbour Space Bangkok Student Portal

Harbour Space Bangkok Student Portal is a web application developed as a school project for the "Introduction to Web Development" course using Laravel framework in Harbour Space University. The purpose of this application is to provide students with resources such as articles related to academic and general life in Bangkok.

## Features

- **Article Management**: Users can create, edit, and delete articles.
- **User Authentication**: Secure user authentication system with login and registration functionality.
- **Search Functionality**: Users can search for articles based on keywords.
- **Responsive Design**: Mobile-friendly design for seamless user experience across devices.
- **Admin Panel**: Admin users have access to additional features for managing articles and user accounts.

## Technologies Used

- **Laravel**: PHP web application framework for building the backend of the application.
- **HTML, CSS, JavaScript**: Frontend development technologies for creating the user interface and interactivity.
- **Bootstrap**: Frontend framework for responsive and mobile-first design.
- **SQLite**: Relational database management system for storing application data.
- **Git**: Version control system for tracking changes in the codebase.

## Getting Started

To get started with Harbour Space Bangkok Student Portal, follow these steps:

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/your-username/harbour-space-bangkok-student-portal.git
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Configure the environment variables by copying the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Create a new MySQL database and update the `.env` file with the database credentials.

6. Migrate the database:

    ```bash
    php artisan migrate
    ```

7. Serve the application:

    ```bash
    php artisan serve
    ```

8. Access the application in your web browser at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
