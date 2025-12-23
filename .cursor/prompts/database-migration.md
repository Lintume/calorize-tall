# Creating Database Migrations

## Migration Command

```bash
php artisan make:migration add_column_to_table_name
```

## Migration Template

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('table_name', function (Blueprint $table) {
            // Add columns
        });
    }

    public function down(): void
    {
        Schema::table('table_name', function (Blueprint $table) {
            // Reverse the changes
        });
    }
};
```

## Table Naming Conventions

- Tables: snake_case plural (`products`, `food_intake`)
- Pivot: `singular_to_singular` (`product_to_products`)
- Foreign keys: `singular_id` (`user_id`)

## Common Column Types

```php
// Nutritional values (allow decimals)
$table->decimal('proteins', 8, 2)->default(0);
$table->decimal('fats', 8, 2)->default(0);
$table->decimal('carbohydrates', 8, 2)->default(0);
$table->decimal('calories', 8, 2)->default(0);

// User ownership
$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

// Dates
$table->date('date');

// Slugs
$table->string('slug')->unique();

// Fulltext index
$table->fullText('title');
```

## Running Migrations

```bash
# Run all pending migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration (drops all tables)
php artisan migrate:fresh
```

## Production Notes

- Always have a reversible `down()` method
- Test migrations locally before deploying
- Back up production database before major migrations

