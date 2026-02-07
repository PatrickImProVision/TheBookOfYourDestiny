@echo off
REM THE BOOK OF YOUR DESTINY - Installation Script for Windows
REM Makes the framework portable and ready to use

echo.
echo ================================
echo The Book Of Your Destiny Setup
echo ================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo Error: Composer is not installed.
    echo Please install Composer first: https://getcomposer.org
    pause
    exit /b 1
)

echo [OK] Composer found
echo.

REM Install dependencies
echo Installing dependencies...
call composer install --no-interaction
if %ERRORLEVEL% NEQ 0 (
    echo Error: Failed to install dependencies
    pause
    exit /b 1
)

echo [OK] Dependencies installed
echo.

REM Create writable directories if they don't exist
if not exist "writable\cache" mkdir writable\cache
if not exist "writable\logs" mkdir writable\logs
if not exist "writable\session" mkdir writable\session
if not exist "writable\uploads" mkdir writable\uploads

echo [OK] Created writable directories
echo.

REM Copy environment file if it doesn't exist
if not exist ".env" (
    if exist ".env.example" (
        copy .env.example .env
        echo [OK] Created .env file - please configure it
    )
)
echo.

REM Run migrations
echo Running database migrations...
php spark migrate --all
if %ERRORLEVEL% NEQ 0 (
    echo [WARNING] Migration failed (you may need to configure .env first)
)

echo.
echo ================================
echo [OK] Setup Complete!
echo ================================
echo.
echo Next steps:
echo 1. Edit .env file with your database configuration
echo 2. Run: php spark migrate
echo 3. Run: php spark serve
echo 4. Visit: http://localhost:8080
echo.
pause
