#!/bin/bash
# 26 Labs - Quick Start Installation Script
# For local testing before SiteGround deployment

set -e

echo "========================================"
echo "26 Labs - Quick Start Setup"
echo "========================================"

# Check PHP version
echo ""
echo "Checking PHP version..."
if ! command -v php &> /dev/null; then
    echo "❌ PHP not found. Please install PHP 8.2+"
    exit 1
fi

PHP_VERSION=$(php --version | grep -oP 'PHP \K[^.]+' | head -1)
if [ "$PHP_VERSION" -lt 8 ]; then
    echo "❌ PHP 8.0+ required (you have $PHP_VERSION)"
    exit 1
fi

echo "✓ PHP $PHP_VERSION detected"

# Check MySQL
echo ""
echo "Checking MySQL..."
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL client not found. You'll need to create database manually."
    echo "   Or use phpMyAdmin in SiteGround cPanel"
else
    echo "✓ MySQL found"
fi

# Copy .env
echo ""
echo "Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ Created .env file"
    echo "  Please edit .env with your database credentials"
else
    echo "✓ .env already exists"
fi

# Create directories
echo ""
echo "Creating directories..."
mkdir -p storage/uploads
mkdir -p storage/logs
mkdir -p public/images
echo "✓ Directories created"

# Set permissions
echo ""
echo "Setting file permissions..."
chmod 755 storage 2>/dev/null || echo "⚠️  Could not set storage permissions (Windows?)"
chmod 755 storage/logs 2>/dev/null || true
chmod 755 storage/uploads 2>/dev/null || true
chmod 644 .env 2>/dev/null || true
echo "✓ Permissions set"

echo ""
echo "========================================"
echo "✓ Setup Complete!"
echo "========================================"
echo ""
echo "Next steps:"
echo "1. Edit .env with your database credentials"
echo "2. Point web server to /public directory"
echo "3. Or access http://localhost/installer/install.php"
echo "4. Run the installer in your browser"
echo ""
echo "Documentation:"
echo "  - README.md - Project overview"
echo "  - DEPLOYMENT.md - SiteGround deployment guide"
echo "  - DEVELOPMENT.md - API documentation"
echo ""
