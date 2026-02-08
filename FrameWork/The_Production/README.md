# CodeIgniter 4 Project

A modern PHP web framework for building web applications.

## Quick Start

### Prerequisites
- PHP 7.4+ or PHP 8.0+
- Composer
- MySQL or compatible database

### Installation

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Configure Environment**
   ```bash
   cp .env .env.local
   ```
   Edit `.env.local` with your settings:
   - `APP_NAME` - Your application name
   - `APP_BASEURL` - Your application's base URL
   - `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` - Database credentials
   - `APP_DEBUG` - Set to `false` in production
   - `APP_ENVIRONMENT` - Set to `production` in production

3. **Generate Encryption Key**
   ```bash
   php spark key:generate
   ```
   Copy the generated key to `ENCRYPTION_KEY` in your `.env.local`

4. **Create Database**
   ```sql
   CREATE DATABASE codeigniter4 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

5. **Run Migrations** (if you have any)
   ```bash
   php spark migrate
   ```

6. **Start Development Server**
   ```bash
   php spark serve
   ```

   The application will be available at `http://localhost/CodeIgniter`

## Project Structure

```
├── app/
│   ├── Config/          # Configuration files
│   ├── Controllers/     # Application controllers
│   ├── Models/          # Database models
│   └── Views/           # View templates
├── public/
│   ├── assets/          # CSS, JS, images
│   └── index.php        # Application entry point
├── writable/
│   ├── cache/           # Cache files
│   ├── logs/            # Log files
│   └── session/         # Session files
├── .env                 # Environment variables
├── composer.json        # Composer dependencies
└── README.md           # This file
```

## Key Settings to Adjust

### 1. **app/Config/App.php**
- `baseURL` - Set to your application URL
- `appTimezone` - Set your timezone
- `defaultController` - Default controller to load
- `defaultMethod` - Default method to call

### 2. **app/Config/Database.php**
- `hostname` - Your database host
- `username` - Database user
- `password` - Database password
- `database` - Database name
- `DBDriver` - Database driver (MySQLi, PostGreSQL, etc)

### 3. **.env File**
- `APP_ENVIRONMENT` - Set to `production` in production
- `APP_DEBUG` - Set to `false` in production
- `ENCRYPTION_KEY` - Generated via `php spark key:generate`
- Database credentials

### 4. **app/Config/Security.php**
- `forceHTTPS` - Enable in production
- `CSRFProtection` - CSRF token protection
- `CSRFTokenName` - Name of CSRF token

## Development Commands

```bash
# Run migrations
php spark migrate

# Rollback migrations
php spark migrate:rollback

# Generate a new controller
php spark make:controller ControllerName

# Generate a new model
php spark make:model ModelName

# Seed the database
php spark db:seed SeedName

# Run tests
php spark test

# Clear cache
php spark cache:clear

# Show all routes
php spark routes
```

## Database Migrations

Create a migration file:
```bash
php spark make:migration CreateUsersTable
```

Run migrations:
```bash
php spark migrate
```

## Security Notes

- **Never commit `.env` file** to version control
- Always set `APP_DEBUG = false` in production
- Enable HTTPS in production (`forceHTTPS = true`)
- Secure your database credentials
- Keep dependencies updated

## Resources

- [CodeIgniter Documentation](https://codeigniter.com/user_guide/)
- [CodeIgniter Forum](https://forum.codeigniter.com/)
- [GitHub Repository](https://github.com/codeigniter4/CodeIgniter4)

## License

This project is built with CodeIgniter 4, released under the MIT License.
