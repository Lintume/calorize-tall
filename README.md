# Calorize - Health Tracker Application
<div align="center">
  <img src="https://i.ibb.co/XL4wz00/calorize300.png" alt="calorize300" border="0">
</div>

## Overview

Calorize is a comprehensive health tracker application designed to help users manage their health and fitness goals. It provides features for tracking weight, maintaining a calorie diary, recording body measurements, and more. This application is built using the TALL stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) and other modern web technologies.

## Features

- **User Authentication**: Secure login and registration system with email verification.
- **Weight Tracking**: Record and monitor weight changes over time.
- **Calorie Diary**: Log daily food intake and track calorie consumption.
- **Body Measurements**: Track various body measurements such as chest, waist, thighs, wrist, neck, and biceps.
- **Statistics and Charts**: Visualize progress with charts and statistics.
- **Multi-language Support**: Switch between different languages.
- **Responsive Design**: Optimized for both desktop and mobile devices.
- **Recipe Management**: Calculate complex recipes with calorie accuracy and reuse them.
- **Sleep and Mood Monitoring**: Track your sleep patterns and mood.
- **Extensive Food Database**: Access a large base of basic simple products.
- **Highly Rated**: Endorsed by well-known YouTube blogger and specialist Boris Tsatsulin.

## Prerequisites

Before you begin, ensure you have the following installed:

- **Docker Desktop** (for macOS/Windows) or **Docker Engine** and **Docker Compose** (for Linux)
- **Git**

> **Note**: You don't need to install PHP, Composer, Node.js, or MySQL locally - all dependencies run inside Docker containers via Laravel Sail.

## Installation with Laravel Sail

### Step 1: Clone the Repository

```sh
git clone https://github.com/Lintume/calorize.git
cd calorize
```

### Step 2: Install Dependencies

If you haven't already, install Composer dependencies (Sail is included):

```sh
composer install
```

### Step 3: Set Up Environment Variables

```sh
cp .env.example .env
```

Edit the `.env` file and configure your database settings. Sail will automatically use these values:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=calorize
DB_USERNAME=sail
DB_PASSWORD=password
```

### Step 4: Start Docker Containers

Start the application and all its services:

```sh
./vendor/bin/sail up -d
```

This command will:
- Build the Docker containers
- Start MySQL database
- Start the Laravel application
- Make the application available at `http://localhost`

### Step 5: Generate Application Key

```sh
./vendor/bin/sail artisan key:generate
```

### Step 6: Run Database Migrations

```sh
./vendor/bin/sail artisan migrate
```

### Step 7: Seed the Database (Optional)

```sh
./vendor/bin/sail artisan db:seed
```

This creates a test user:
- Email: `test@example.com`
- Password: (check the seeder for the password)

### Step 8: Install Frontend Dependencies and Build Assets

```sh
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

For development with hot reload:

```sh
./vendor/bin/sail npm run dev
```

### Step 9: Create Storage Link

```sh
./vendor/bin/sail artisan storage:link
```

## Additional Setup (Optional)

### Seed Measurements Data

Ensure a user with ID 1 exists before running:

```sh
./vendor/bin/sail artisan db:seed --class=SeedMeasurements
```

### Parse Products from Excel

Place the `products.xlsx` file in the root directory, then run:

```sh
./vendor/bin/sail artisan parse:products
```

### Collect Translations

```sh
./vendor/bin/sail artisan translatable:export uk,en
```

### NPM Commands

```sh
# Install dependencies
./vendor/bin/sail npm install

# Development build with hot reload
./vendor/bin/sail npm run dev

# Production build
./vendor/bin/sail npm run build

## Xdebug Configuration

Xdebug is pre-configured and enabled in the Docker container. To use it:

### 1. Enable Xdebug in `.env`

The following should already be set:

```env
SAIL_XDEBUG_MODE=debug,develop
SAIL_XDEBUG_CONFIG=client_host=host.docker.internal client_port=9003 start_with_request=yes
```

### 2. Configure Your IDE (Cursor/VS Code)

The project includes a `.vscode/launch.json` configuration file. Make sure you have the **PHP Debug** extension installed.

1. Install the **PHP Debug** extension in Cursor/VS Code
2. Set breakpoints in your PHP code
3. Press `F5` or go to Run and Debug (Cmd+Shift+D)
4. Select "Listen for Xdebug (Laravel Sail)"
5. Start debugging!

### 3. Verify Xdebug

Check if Xdebug is running:

```sh
./vendor/bin/sail php -v | grep -i xdebug
```

## Accessing the Application

Once containers are running:

- **Web Application**: http://localhost
- **Vite Dev Server**: http://localhost:5173
- **MySQL**: localhost:3306
- **Xdebug Port**: 9003

## Development Workflow

### Daily Development

1. Start containers: `./vendor/bin/sail up -d`
2. Run migrations if needed: `./vendor/bin/sail artisan migrate`
3. Start Vite dev server: `./vendor/bin/sail npm run dev`
4. Access the app at http://localhost

### Running Tests

```sh
./vendor/bin/sail artisan test
```

### Code Quality

```sh
# Format code with Pint
./vendor/bin/sail pint
```

## Production Deployment

### Create Database Dump

On production server:

```sh
ssh root@185.67.0.147
mysqldump -u root -p calorize > /var/www/calorize-tall/19_01_25_calorize.sql
```

## Usage

### Authentication

- Register a new account or log in with existing credentials.
- Verify your email address if required.

### Dashboard

- Access the main dashboard to view an overview of your health data.

### Weight Tracking

- Navigate to the weight tracking section.
- Add new weight entries and view historical data.

### Calorie Diary

- Go to the calorie diary section.
- Log your daily food intake and track your calorie consumption.

### Body Measurements

- Record various body measurements such as chest, waist, thighs, wrist, neck, and biceps.
- View historical data and track changes over time.

### Statistics and Charts

- Access the statistics section to view charts and graphs of your progress.
- Filter data by different time ranges (e.g., last week, last month, last year).

### Recipe Management

- Create and manage complex recipes with calorie accuracy.
- Reuse recipes and adjust ingredient ratios without affecting past entries.

### Sleep and Mood Monitoring

- Track your sleep patterns and mood over time.

### Multi-language Support

- Switch between different languages using the language selector.

## Contributing

We welcome contributions from the community. To contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature-name`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## Contact

For any questions or feedback, please contact us at support@calorize.com.

---

Thank you for using Calorize! We hope it helps you achieve your health and fitness goals.
