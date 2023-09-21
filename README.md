## Introduction

This README will guide you through the installation process and explain how to run tests for the project.

## Prerequisites

Before you begin, please make sure you have the following prerequisites installed on your system:

- Docker
- Docker Compose
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

This command will create and start Docker containers for the Nuxt.js frontend and Laravel backend.

1. Run migrations to set up the database:

```bash
docker exec -it backend php artisan migrate
```

This will apply the database migrations, creating the necessary tables.

4. Seed the database with sample data (optional):

```bash
docker exec -it backend php artisan db:seed
```
Now, your Nuxt.js application should be running on port 3000, and the Laravel backend should be running on port 8000.

## Running Tests

To run tests for the Laravel backend, follow these steps:

1. Open a terminal and navigate to the project directory.

2. Execute the following command to run the tests:

```bash
docker exec -it backend php artisan test
```

## Installation (Without Docker)

If you prefer to run the project without Docker, follow these steps:


2. Create a MySQL database: 
Create a new MySQL database for your project, and remember the database name and credentials (username and password) for the next steps.

3. Update the environment variables:
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

1. Install PHP dependencies using Composer:
```bash
composer install
```
2. Run migrations to set up the database:
```bash
php artisan migrate
```

3. Seed the database with sample data (optional):
```bash
php artisan db:seed
```

4. Start the Laravel backend server:
```bash
php artisan serve
```

5. Navigate to the Nuxt.js directory:
```bash
cd ./nuxt
```

6. Install Nuxt.js dependencies using npm:
```bash
npm install
```

7.  Build the Nuxt.js application:
```bash
npm run build
```

8.  Generate the static pages:
```bash
npm run generate
```

9. Start the Nuxt application:
```bash
npm run start
```

## Accessing the Application

You can access the application in your web browser:

- Frontend (Nuxt.js): [http://localhost:3000](http://localhost:3000)
- Backend (Laravel): [http://localhost:8000](http://localhost:8000)

Congratulations! You've successfully installed and set up the project.