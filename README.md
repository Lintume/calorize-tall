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

## Installation

### Prerequisites

- PHP 8.0 or higher
- Composer
- Node.js and npm
- MySQL or any other supported database

### Steps

1. **Clone the repository**:
    ```sh
    git clone https://github.com/Lintume/calorize.git
    cd calorize
    ```

2. **Install PHP dependencies**:
    ```sh
    composer install
    ```

3. **Install JavaScript dependencies**:
    ```sh
    npm install
    ```

4. **Set up environment variables**:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure the `.env` file** with your database and other settings.

6. **Run database migrations**:
    ```sh
    php artisan migrate
    ```

7. **Seed the database** (optional):
    ```sh
    php artisan db:seed
    ```

8. **Seed measurements data for testing purposes** (optional):
   Ensure a user with ID 1 exists before running this command.
    ```sh
    php artisan db:seed --class=SeedMeasurements
    ```

9. **Parse products from `table.xlsx` file** (optional):
   Ensure the `table.xlsx` file is placed in the root directory before running this command.
    ```sh
    php artisan parse:products
    ```

10. **Build front-end assets**:
    ```sh
    npm run dev
    ```

11. **Start the development server**:
    ```sh
    php artisan serve
    ```
12. **Collect translations (if needed)**:
    ```sh
    php artisan translatable:export uk,en
    ```

13.**Create dump DB on prod**:
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