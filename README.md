# Test project for analyzenbd

This project combines Laravel as the backend framework with alpinejs & tailwind css for the frontend. Follow the instructions below to set up and run the project.

## Prerequisites

- [PHP](https://www.php.net/) (>= 8.2)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (>= 18.x)
- [npm](https://www.npmjs.com/) (comes with Node.js)
- [MySQL](https://www.mysql.com/) or another database of your choice

## Getting Started

1. **Clone the repository:**

   ```bash
   https://github.com/imsat/analyzen-test.git

2. **Install Laravel dependencies:**

    ```bash
   composer install

3. **Install Laravel dependencies:**

    ```bash
    cp .env.example .env

4. **Update the database configuration in the .env file:**
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

5. **Generate the application key:**
    ```bash
    php artisan key:generate

6. **Run database migrations and seed data:**
    ```bash
    php artisan migrate --seed

## Running the Application

7. **Run the Laravel development server:**
    ```bash
    php artisan serve
8. **Access the application in your browser:**

Open your browser and navigate to http://127.0.0.1:8000 or desired port show in your terminal.


   
   
    
