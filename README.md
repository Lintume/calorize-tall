# Calorize - Health Tracker Application

<div align="center">
  <img src="https://i.ibb.co/XL4wz00/calorize300.png" alt="calorize300" border="0">
</div>

## Overview

Calorize is a comprehensive health tracker application designed to help users manage their health and fitness goals. It provides features for tracking weight, maintaining a calorie diary, recording body measurements, and more. The application is built using the TALL stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) and leverages AI-powered natural language processing for intuitive food logging.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Livewire 3, Alpine.js, Tailwind CSS, Vite
- **Database**: MySQL 8.0
- **Search**: Meilisearch (~86,000 products)
- **AI**: OpenAI GPT-4o-mini / Google Gemini (configurable) via [Prism PHP](https://github.com/prism-php/prism)
- **Containerization**: Docker via Laravel Sail
- **Monitoring**: Sentry, Helicone (LLM observability)

## Features

- **AI-Powered Diary Chat**: Natural language food logging with intelligent product search and automatic meal detection
- **User Authentication**: Secure login and registration system with email verification
- **Weight Tracking**: Record and monitor weight changes over time
- **Calorie Diary**: Log daily food intake and track calorie consumption
- **Body Measurements**: Track chest, waist, thighs, wrist, neck, biceps, mood, hunger, and sleep
- **Statistics and Charts**: Visualize progress with Chart.js
- **Multi-language Support**: Ukrainian and English localization
- **Responsive Design**: Optimized for both desktop and mobile devices
- **Recipe Management**: Calculate complex recipes with calorie accuracy and reuse them
- **Extensive Food Database**: Access a database of ~86,000 Ukrainian products via Meilisearch

## AI Diary Agent

The core feature of Calorize is an LLM-driven food diary agent that allows users to log food using natural language (voice or text).

### Architecture

```
┌─────────────────┐     ┌─────────────────────┐     ┌─────────────────┐
│   DiaryChat     │────▶│  DiaryAgentService  │────▶│  Prism (LLM)    │
│   (Livewire)    │     │    (Orchestrator)   │     │  GPT/Gemini     │
└─────────────────┘     └─────────────────────┘     └─────────────────┘
                                  │
                                  ▼
                        ┌─────────────────────┐
                        │      Tools          │
                        ├─────────────────────┤
                        │ • SearchProductTool │
                        │ • CreateProductTool │
                        │ • AddToFoodIntake   │
                        │ • GetFoodIntake     │
                        │ • UpdateFoodIntake  │
                        │ • DeleteFoodIntake  │
                        │ • AddMeasurement    │
                        └─────────────────────┘
```

### Entry Points

| Component | Path | Description |
|-----------|------|-------------|
| UI Component | `app/Livewire/DiaryChat.php` | Livewire chat interface |
| Orchestrator | `app/Services/DiaryAgent/DiaryAgentService.php` | Builds prompts, calls LLM, parses responses |
| Tools | `app/Services/DiaryAgent/Tools/*` | Individual tool implementations |
| Config | `config/diary_agent.php` | Model configuration |

### Available Tools

| Tool | Function | Description |
|------|----------|-------------|
| `searchProduct` | Search products | Returns up to 10 matches from Meilisearch |
| `createProduct` | Create product | Creates user product (nutrition per 100g) |
| `addToFoodIntake` | Add to diary | Adds product to meal with smart duplicate merging |
| `getFoodIntake` | Get diary | Returns items for specific date/meal |
| `updateFoodIntake` | Update entry | Updates grams and recalculates macros |
| `deleteFoodIntake` | Delete entry | Removes entry from diary |
| `addMeasurement` | Add measurement | Logs weight, body metrics, mood, hunger, sleep |

### Key Behaviors

- **Automatic meal detection**: Based on current time (breakfast 6-11, lunch 11-15, snack 15-19, dinner 19-23)
- **Recent diary memory**: Uses 7-day history for disambiguation and 30-day frequency analysis
- **Smart token extraction**: Ukrainian/Russian stemming for better search matching
- **Duplicate prevention**: Merges same product entries within ~90 seconds
- **Multi-provider support**: Automatically detects OpenAI vs Gemini based on model name

### Configuration

Set the AI model in `.env`:

```env
# OpenAI models
DIARY_AGENT_MODEL=gpt-4o-mini
DIARY_AGENT_MODEL=gpt-4o

# Google Gemini models
DIARY_AGENT_MODEL=gemini-2.0-flash
```

### LLM Observability

All LLM requests are logged to [Helicone](https://helicone.ai/) for monitoring costs, latency, and debugging. Configure in `.env`:

```env
HELICONE_API_KEY=your-key
```

## Prerequisites

Before you begin, ensure you have the following installed:

- **Docker Desktop** (for macOS/Windows) or **Docker Engine** and **Docker Compose** (for Linux)
- **Git**

> **Note**: You don't need to install PHP, Composer, Node.js, or MySQL locally - all dependencies run inside Docker containers via Laravel Sail.

## Installation

### Step 1: Clone the Repository

```sh
git clone https://github.com/Lintume/calorize.git
cd calorize
```

### Step 2: Install Dependencies

```sh
composer install
```

### Step 3: Set Up Environment Variables

```sh
cp .env.example .env
```

Configure your database and API keys in `.env`:

```env
# Database (Sail defaults)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=calorize
DB_USERNAME=sail
DB_PASSWORD=password

# AI Agent
OPENAI_API_KEY=sk-...
DIARY_AGENT_MODEL=gpt-4o-mini
```

### Step 4: Start Docker Containers

```sh
./vendor/bin/sail up -d
```

This starts MySQL, Meilisearch, and the Laravel application.

### Step 5: Initialize Application

```sh
# Generate application key
./vendor/bin/sail artisan key:generate

# Run migrations
./vendor/bin/sail artisan migrate

# Seed database (optional - creates test user)
./vendor/bin/sail artisan db:seed

# Create storage link
./vendor/bin/sail artisan storage:link

# Build frontend assets
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

## Development Workflow

### Daily Development

```sh
# Start containers
./vendor/bin/sail up -d

# Run migrations if needed
./vendor/bin/sail artisan migrate

# Start Vite dev server (hot reload)
./vendor/bin/sail npm run dev

# Access app at http://localhost:8081
```

### Running Tests

```sh
./vendor/bin/sail test
```

### Code Quality

```sh
# Format code with Laravel Pint
./vendor/bin/sail pint
```

## Meilisearch (Product Search)

The application uses Meilisearch for fast product search with ~86,000 Ukrainian products.

### Reindex Products

If you manually modify the `products` table, reindex Meilisearch:

```sh
# Clear and reimport
./vendor/bin/sail artisan scout:flush "App\Models\Product"
./vendor/bin/sail artisan scout:import "App\Models\Product"
./vendor/bin/sail artisan scout:sync-index-settings
```

> **Note:** Eloquent methods (`Product::create()`, `->save()`, `->delete()`) auto-update the index.

### Troubleshooting Search

```sh
# Check health
curl http://localhost:7701/health

# Verify index
curl http://localhost:7701/indexes/products/stats -H "Authorization: Bearer masterKey"
```

## Additional Commands

### Parse Products from Excel

```sh
./vendor/bin/sail artisan parse:products
```

### Export Translations

```sh
./vendor/bin/sail artisan translatable:export uk,en
```

### Seed Measurements Data

```sh
./vendor/bin/sail artisan db:seed --class=SeedMeasurements
```

## Xdebug Configuration

Xdebug is pre-configured in Docker. Enable in `.env`:

```env
SAIL_XDEBUG_MODE=debug,develop
SAIL_XDEBUG_CONFIG=client_host=host.docker.internal client_port=9003 start_with_request=yes
```

Use the **PHP Debug** extension in Cursor/VS Code with the included `.vscode/launch.json`.

## Service Ports

| Service | URL/Port |
|---------|----------|
| Web Application | http://localhost:8081 |
| Vite Dev Server | http://localhost:5174 |
| MySQL | localhost:3307 |
| Meilisearch | http://localhost:7701 |
| Xdebug | 9004 |

## Queues

Email notifications use Laravel queues:

- **Local**: `QUEUE_CONNECTION=sync` (immediate, no worker needed)
- **Production**: `QUEUE_CONNECTION=database` + queue worker

```sh
# Run worker locally (if using database driver)
./vendor/bin/sail artisan queue:work
```

## Project Structure

```
app/
├── Livewire/
│   └── DiaryChat.php          # AI chat UI component
├── Models/
│   ├── Product.php            # Food product model
│   ├── FoodIntake.php         # Diary entry model
│   └── ...
├── Services/
│   └── DiaryAgent/
│       ├── DiaryAgentService.php    # LLM orchestrator
│       ├── DiaryAgentResult.php     # Response DTO
│       ├── WhisperService.php       # Voice transcription
│       └── Tools/                   # LLM tools
│           ├── SearchProductTool.php
│           ├── CreateProductTool.php
│           ├── AddToFoodIntakeTool.php
│           └── ...
config/
├── diary_agent.php            # AI agent configuration
├── prism.php                  # Prism LLM configuration
└── helicone.php               # LLM observability config
```

## Contributing

We welcome contributions! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit changes (`git commit -m 'Add feature'`)
4. Push to branch (`git push origin feature/your-feature`)
5. Open a pull request

## License

This project is licensed under the MIT License.

## Contact

For questions or feedback, please contact us at support@calorize.com.
