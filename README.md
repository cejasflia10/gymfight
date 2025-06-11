# Gymfight

Gymfight is a PHP application for managing everyday tasks in a gym. It lets you register clients and memberships, keep track of payments and attendance, handle class schedules and manage the sale of products such as sporting goods or supplements. Several reporting pages make it easy to review sales and trainer work hours.

## Features

- Client and membership administration
- Payment records and revenue reports
- Trainer management and class registration
- Product sales and inventory pages
- Attendance tracking for members

## Local setup

1. Install **PHP 8.2** or higher with the MySQLi extension enabled. The included `Dockerfile` uses the `php:8.2-apache` image as reference.
2. Clone the repository and install a MySQL server.
3. Create a database and configure the connection values using the environment variables listed below.
4. Launch the built‑in PHP server:
   ```bash
   php -S localhost:8080 -t .
   ```
   The application will be available at [http://localhost:8080](http://localhost:8080).

### Environment variables

`conexion.php` expects the following variables to be defined in the environment before the server starts:

- `DB_HOST` – database host name
- `DB_USER` – database user
- `DB_PASSWORD` – user password
- `DB_NAME` – name of the database
- `DB_PORT` – MySQL port (defaults to `3306`)

## Deployment on Render

This project includes a `render.yaml` file that configures deployment on Render.com. Create a new Web Service and select **Environment: PHP**. Set the same environment variables for the database connection and Render will run the start command specified in the YAML:

```yaml
services:
  - type: web
    name: gymfight
    env: php
    buildCommand: ""
    startCommand: php -S 0.0.0.0:10000 -t .
    plan: free
```

Once deployed, Render will run the PHP built‑in server on port 10000. Ensure your database is reachable from the service.
