
# Laravel E-Commerce Application

This is a Laravel-based e-commerce application using **PostgreSQL** as the database and Docker containers for easy setup. It includes features like a shopping cart, product filtering, AI-powered recommendations, and more. This guide explains how to configure, execute, and test the program.

---

## **Table of Contents**

1. [Prerequisites](#prerequisites)
2. [Configuration](#configuration)
3. [Setting Up Docker Containers](#setting-up-docker-containers)
4. [Running the Application](#running-the-application)
5. [Running CI/CD Tests](#running-cicd-tests)
6. [Troubleshooting](#troubleshooting)

---

## **1. Prerequisites**

Ensure you have the following installed on your system:

1. **Docker** and **Docker Compose**:
   - [Install Docker](https://docs.docker.com/get-docker/)
   - [Install Docker Compose](https://docs.docker.com/compose/install/)

2. **Composer**:
   - [Install Composer](https://getcomposer.org/)

3. **Node.js** (for frontend assets):
   - [Install Node.js](https://nodejs.org/)

4. **PostgreSQL** (Optional):
   - Required only if you are not using the Dockerized PostgreSQL instance.

---

## **2. Configuration**

### Step 1: Clone the Repository
Clone this repository to your local machine:
```bash
git clone https://github.com/your-username/ecommerce-app.git
cd ecommerce-app
```

### Step 2: Environment Configuration
Copy the `.env.example` file and configure your environment variables:
```bash
cp .env.example .env
```

#### Update the `.env` file:
1. **Database Configuration** (for Dockerized PostgreSQL):
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=db
   DB_PORT=5432
   DB_DATABASE=ecommerce_php
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

2. **App Configuration**:
   - Set `APP_URL` to match your local setup (e.g., `http://localhost`).
   ```env
   APP_URL=http://localhost
   ```

3. **Queue and Cache**:
   Configure cache drivers as needed (default is fine):
   ```env
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   ```

4. **Stripe or Payment API Keys** (Optional):
   Add keys if you’re integrating payments.

---

## **3. Setting Up Docker Containers**

### Step 1: Docker Compose File
Ensure `docker-compose.yml` is properly configured. The default file includes:
- **App** container for Laravel.
- **Database** container for PostgreSQL.

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - .:/var/www
    ports:
      - "8000:8000"
    depends_on:
      - db
    environment:
      DB_HOST: db
      DB_PORT: 5432
      DB_DATABASE: ecommerce_php
      DB_USERNAME: postgres
      DB_PASSWORD: your_password

  db:
    image: postgres:13
    environment:
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: your_password
      POSTGRES_DB: ecommerce_php
    ports:
      - "5432:5432"
    volumes:
      - db_data:/var/lib/postgresql/data

volumes:
  db_data:
```

### Step 2: Build and Start Containers
Run the following command to build and start the containers:
```bash
docker-compose up --build
```

This will:
1. Build the Laravel app container.
2. Start the PostgreSQL database container.

### Step 3: Access the Containers
1. **Laravel App**: Access the app at [http://localhost:8000](http://localhost:8000).
2. **PostgreSQL**:
   - Connect using a tool like pgAdmin with these credentials:
     - Host: `localhost`
     - Port: `5432`
     - Database: `ecommerce_php`
     - Username: `postgres`
     - Password: `your_password`

---

## **4. Running the Application**

### Step 1: Install Dependencies
Run the following commands inside the `app` container:
```bash
docker exec -it ecommerce-app bash
composer install
npm install && npm run dev
```

### Step 2: Migrate and Seed the Database
Run the following commands to set up the database schema and seed initial data:
```bash
php artisan migrate
php artisan db:seed
```

---

## **5. Running CI/CD Tests**

### Step 1: Run PHPUnit Tests
Inside the app container, execute:
```bash
php artisan test
```

This will run unit and feature tests defined in the `tests/` directory.

### Step 2: Execute Tests via GitHub Actions
The project includes a GitHub Actions workflow for CI/CD:

#### Workflow File (`.github/workflows/ci.yml`):
```yaml
name: Laravel CI/CD

on:
  push:
    branches:
      - main
  pull_request:
    branches:
      - main

jobs:
  build:
    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v3
    - name: Set up PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: 8.1
        extensions: mbstring, pdo_pgsql
    - name: Install Dependencies
      run: composer install
    - name: Run Tests
      run: php artisan test
```

### Trigger Tests:
1. Push to the `main` branch:
   ```bash
   git add .
   git commit -m "Add feature X"
   git push origin main
   ```

2. Check GitHub Actions in your repository to ensure the CI workflow is successful.

---

## **6. Troubleshooting**

### Common Issues:
1. **Database Connection Error**:
   - Ensure `docker-compose` is running.
   - Verify `.env` matches the database credentials.
   - Clear Laravel cache:
     ```bash
     php artisan config:clear
     php artisan cache:clear
     ```

2. **Node.js Not Installed**:
   Install Node.js and rerun `npm install && npm run dev`.

3. **Docker Errors**:
   - Restart Docker services:
     ```bash
     docker-compose down
     docker-compose up --build
     ```

4. **CI/CD Fails**:
   - Check GitHub Actions logs for specific errors.
   - Ensure all dependencies are installed correctly.

---

## **Additional Notes**
- **Local Development**: Use `APP_ENV=local` for development.
- **Production Deployment**: Consider using a cloud service (e.g., AWS, DigitalOcean) and securing the app with SSL via Cloudflare.

---
