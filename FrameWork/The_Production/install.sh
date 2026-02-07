#!/bin/bash

# THE BOOK OF YOUR DESTINY - Installation Script
# Makes the framework portable and ready to use

echo "================================"
echo "The Book Of Your Destiny Setup"
echo "================================"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first: https://getcomposer.org"
    exit 1
fi

echo "✓ Composer found"

# Install dependencies
echo "Installing dependencies..."
composer install --no-interaction
if [ $? -ne 0 ]; then
    echo "❌ Failed to install dependencies"
    exit 1
fi

echo "✓ Dependencies installed"

# Make spark executable
if [ -f "spark" ]; then
    chmod +x spark
    echo "✓ Made spark executable"
fi

# Create writable directories if they don't exist
mkdir -p writable/cache
mkdir -p writable/logs
mkdir -p writable/session
mkdir -p writable/uploads

# Set permissions
chmod 755 writable
chmod 755 writable/cache
chmod 755 writable/logs
chmod 755 writable/session
chmod 755 writable/uploads

echo "✓ Created writable directories"

# Copy environment file if it doesn't exist
if [ ! -f ".env" ]; then
    if [ -f ".env.example" ]; then
        cp .env.example .env
        echo "✓ Created .env file (please configure it)"
    fi
fi

# Run migrations
echo ""
echo "Running database migrations..."
php spark migrate --all
if [ $? -ne 0 ]; then
    echo "⚠ Migration failed (you may need to configure .env first)"
fi

echo ""
echo "================================"
echo "✓ Setup Complete!"
echo "================================"
echo ""
echo "Next steps:"
echo "1. Edit .env file with your database configuration"
echo "2. Run: php spark migrate"
echo "3. Run: php spark serve"
echo "4. Visit: http://localhost:8080"
echo ""
