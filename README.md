## Introduction

This README will guide you through the installation process and explain how to run tests for the project.

## Prerequisites

- Docker
- Docker Compose
***
- PHP
- MySQL
- Composer
- Node.js (for npm)

## Installation With Docker

Follow these steps to set up the project using Docker:

1. Clone the project repository to your local machine:
```bash
git clone https://github.com/AhmedMedDev/it-gates.git
cd it-gates
```

2. Build and start the Docker containers:
```bash
docker-compose up -d
```

3. Run migrations to set up the database:
```bash
docker exec -it backend php artisan migrate
```

4. Seed the database with sample data (optional):
```bash
docker exec -it backend php artisan db:seed
```

## Running Tests

To run tests for the Laravel backend, Execute the following command:
```bash
docker exec -it backend php artisan test
```

## Installation (Without Docker)

If you prefer to run the project without Docker, follow these steps:

1. Create a MySQL database: 
Create a new MySQL database for your project, and remember the database name and credentials (username and password) for the next steps.

2. Update the environment variables:
- Copy the example environment file:
```bash
cp .env.example .env
```

- Open the `.env` file in a text editor and update the following variables with your database connection details:
 ```
 DB_CONNECTION=mysql
 DB_HOST=your_database_host
 DB_PORT=3306
 DB_DATABASE=your_database_name
 DB_USERNAME=your_database_username
 DB_PASSWORD=your_database_password
 ```

3. Install PHP dependencies using Composer:
```bash
composer install
```
4. Run migrations to set up the database:
```bash
php artisan migrate
```

5. Seed the database with sample data (optional):
```bash
php artisan db:seed
```

6. Start the Laravel backend server:
```bash
php artisan serve
```

7. Navigate to the Nuxt.js directory:
```bash
cd ./nuxt
```

8. Install Nuxt.js dependencies using npm:
```bash
npm install
```

9. Build the Nuxt.js application:
```bash
npm run build
```

10. Generate the static pages:
```bash
npm run generate
```

11. Start the Nuxt application:
```bash
npm run start
```

## Running Tests
To run tests for the Laravel backend, Execute the following command:
```bash
php artisan test
```

## Accessing the Application

You can access the application in your web browser:

- Frontend (Nuxt.js): [http://localhost:3000](http://localhost:3000)
- Backend (Laravel): [http://localhost:8000](http://localhost:8000)