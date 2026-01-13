#!/bin/bash
set -e

cd /var/www/calorize-tall

# Завантажуємо nvm для доступу до npm
export NVM_DIR="/root/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

echo "🚀 Starting deployment..."

# Вмикаємо режим обслуговування
php artisan down --refresh=15 --secret="calorize-deploy-secret" || true

# Отримуємо останні зміни з git
echo "📥 Pulling latest changes..."
git pull origin main

# Встановлюємо/оновлюємо composer залежності
echo "📦 Installing composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Встановлюємо npm залежності і збираємо assets
echo "🎨 Building frontend assets..."
npm ci
npm run build

# Запускаємо міграції
echo "🗃️ Running migrations..."
php artisan migrate --force

# Очищуємо кеші
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Виправляємо права доступу ПЕРЕД кешуванням
echo "🔐 Fixing permissions..."
sudo chown -R www-data:www-data storage bootstrap/cache
sudo find storage bootstrap/cache -type d -exec chmod 775 {} \;
sudo find storage bootstrap/cache -type d -exec chmod g+s {} \;
sudo find storage bootstrap/cache -type f -exec chmod 664 {} \;

# Кешуємо (як www-data щоб файли мали правильного власника)
echo "📦 Rebuilding caches..."
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
sudo -u www-data php artisan event:cache

# Вимикаємо режим обслуговування
php artisan up

echo "✅ Deployment completed successfully!"
