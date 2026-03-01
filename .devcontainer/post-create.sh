#!/bin/bash
set -e

echo "🔧 Setting up 26labs development environment..."

# Update package manager
echo "📦 Installing system dependencies..."
apk update
apk add --no-cache \
  php82-pdo \
  php82-pdo_mysql \
  php82-sqlite3 \
  php82-mbstring \
  php82-json \
  php82-tokenizer \
  php82-ctype \
  php82-dom \
  php82-fileinfo \
  php82-openssl

# Install Composer
echo "📝 Installing Composer..."
if ! command -v composer &> /dev/null; then
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php composer-setup.php --install-dir=/usr/local/bin --filename=composer
  php -r "unlink('composer-setup.php');"
fi

# Install PHP dependencies
if [ -f "composer.json" ]; then
  echo "📚 Installing PHP dependencies..."
  composer install --no-interaction --prefer-dist
fi

# Install Node dependencies
if [ -f "package.json" ]; then
  echo "🎨 Installing Node dependencies..."
  npm install
fi

# Set proper permissions
echo "🔐 Setting up file permissions..."
if [ -d "storage" ]; then
  chmod -R 755 storage
  chmod -R 777 storage/logs storage/uploads 2>/dev/null || true
fi

if [ -d "public/uploads" ]; then
  chmod -R 777 public/uploads 2>/dev/null || true
fi

echo "✅ Setup complete! Your development environment is ready."
echo ""
echo "📋 To get started:"
echo "   - Run: php -S localhost:8000 -t public"
echo "   - Or: npm run dev (if configured)"
