#!/bin/bash

# Wait for the database to be ready (optional, useful for external databases)
echo "Waiting for database connection..."
sleep 10  # This sleep is to wait for the DB to be ready (you can adjust the time)

# Run migrations and optimize the application
echo "Running migrations and optimizations..."
php artisan migrate --force --no-interaction
php artisan optimize

# Start the Laravel development server
exec php artisan serve --host=0.0.0.0 --port=9000
