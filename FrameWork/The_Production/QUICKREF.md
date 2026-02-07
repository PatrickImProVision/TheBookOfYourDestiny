# The Book Of Your Destiny - Quick Reference Guide

A quick reference for developers working with the portable CodeIgniter framework.

---

## 🚀 Quick Start

### First Time Setup
```bash
cd The_Production
bash install.sh          # Linux/Mac
# or
install.bat              # Windows
```

### Development
```bash
php spark serve          # Start dev server on http://localhost:8080
php spark migrate        # Run database migrations
php spark db:seed        # Seed database with test data
composer test            # Run unit tests
```

### Production Deployment
```bash
cp .env.example .env
# Edit .env with production database credentials
composer install --no-dev --optimize-autoloader
php spark migrate
# Point web server document root to /public
```

---

## 📁 File Structure

```
The_Production/
├── public/               # Web root - point server here
│   ├── index.php        # Entry point (portable)
│   ├── .htaccess        # Apache config
│   ├── web.config       # IIS config
│   └── .webserver.php   # PHP built-in server config
├── app/
│   ├── Controllers/     # PHP controllers
│   ├── Models/          # Database models
│   ├── Views/           # View templates (.php files)
│   ├── Config/          # Application configuration
│   └── Common.php       # Helper functions
├── vendor/              # Composer dependencies (auto-generated)
├── writable/            # Runtime files (logs, cache, uploads)
├── .env                 # Your configuration (git-ignored)
├── .env.example         # Configuration template
├── composer.json        # PHP dependencies
├── spark                # CLI tool
└── README.md            # Documentation
```

---

## 🔑 Key Commands

### CLI (spark)

```bash
# Development server
php spark serve

# Database
php spark migrate                 # Run all pending migrations
php spark migrate --latest        # Run latest migration
php spark db:seed                 # Run seeders
php spark db:shrink               # Reset database

# Cache
php spark cache:clear             # Clear application cache
php spark cache:info              # Show cache info

# Code generation
php spark make:controller NameController         # Generate controller
php spark make:model NameModel                   # Generate model
php spark make:migration create_users_table      # Generate migration
php spark make:seeder UserSeeder                # Generate seeder

# Debugging
php spark routes                  # List all routes
php spark tinker                  # Interactive shell

# Testing
composer test                     # Run PHPUnit tests
composer lint                     # Check code style
```

### Composer

```bash
composer install                  # Install dependencies
composer update                   # Update dependencies
composer install --no-dev         # Install for production
composer install --optimize-autoloader  # Optimize for production
composer dump-autoload            # Regenerate autoloader
```

---

## 🌐 Routes

### Built-in Routes

All routes are configured in `app/Config/Routes.php`:

```php
// Examples:
$routes->get('/', 'Home::index');              // Home page
$routes->get('/case/list', 'Case::list');      // List cases
$routes->post('/book/create', 'Book::create'); // Create book
```

### Special Routes (As Specified)

```
/edit.app?CaseID=X&BookID=Y&PageID=Z   # WYSIWYG Editor
/view.app?CaseID=X&BookID=Y&PageID=Z   # Content Viewer
/new.app?type=case|book|page           # Create New Wizard
```

### RESTful Routes

```php
// Automatically handle CRUD
$routes->resource('users');

// GET /users              → Users::index()
// GET /users/new          → Users::new()
// POST /users             → Users::create()
// GET /users/:id          → Users::show($id)
// GET /users/:id/edit     → Users::edit($id)
// PUT /users/:id          → Users::update($id)
// DELETE /users/:id       → Users::delete($id)
```

---

## 🗄️ Database

### Configuration

Edit `.env`:
```env
database.default.hostname = localhost
database.default.database = the_book_of_your_destiny
database.default.username = root
database.default.password = yourpassword
database.default.port = 3306
```

### Migrations

Generate migration:
```bash
php spark make:migration CreateUsersTable
```

Edit migration file in `app/Database/Migrations/`:
```php
class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->createTable('users', function(ColumnDefinition $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
```

Run migrations:
```bash
php spark migrate
```

### Models

Create model:
```bash
php spark make:model UserModel
```

Use model:
```php
class UserController extends BaseController
{
    public function list()
    {
        $users = new UserModel();
        $data['users'] = $users->findAll();
        return view('users/list', $data);
    }
}
```

---

## 📝 Controllers

### Anatomy

```php
namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        // Logic here
        return view('user/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            // Handle form submission
        }
        return view('user/create');
    }
}
```

### Accessing Request

```php
$queryParam = $this->request->getGet('param');    // GET
$postParam = $this->request->getPost('field');    // POST
$method = $this->request->getMethod();            // GET, POST, PUT, etc.
$json = $this->request->getJSON();                // Parse JSON body
```

### Returning Responses

```php
// View
return view('path/to/view', $data);

// JSON
return $this->response->setJSON(['key' => 'value']);

// Redirect
return redirect()->to('/path');

// Download
return $this->response->download('file.pdf', 'name.pdf');
```

---

## 🎨 Views

### View Files

All views are in `app/Views/` (use `.php` extension):

```php
<!-- app/Views/user/index.php -->
<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
    <h1>Users</h1>
    <p><?= esc($message) ?></p>
<?= $this->endSection() ?>
```

### View Functions

```php
// Escape output (security)
<?= esc($variable) ?>

// URL generation
<a href="<?= site_url('/user/view/' . $user['id']) ?>">View</a>

// Asset URL
<img src="<?= base_url('images/logo.png') ?>" />

// CSRF token
<?= csrf_field() ?>

// Session data
<?= session('key') ?>

// Form helper
<?= form_open('/submit', ['id' => 'myform']) ?>
    <?= form_input(['name' => 'email', 'value' => old('email')]) ?>
    <?= form_submit('submit', 'Send') ?>
<?= form_close() ?>
```

### Layouts

Base layout in `app/Views/layout/base.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= esc($page_title) ?></title>
</head>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>
```

---

## 🔐 Security

### Input Validation

```php
$rules = [
    'email' => 'required|valid_email',
    'password' => 'required|min_length[8]',
];

if (!$this->validate($rules)) {
    return view('login', ['errors' => $this->validator->getErrors()]);
}
```

### Session

```php
// Set
session()->set('user_id', $user['id']);

// Get
$userId = session('user_id');

// Destroy
session()->destroy();
```

### CSRF Protection

```php
<?= csrf_field() ?>  <!-- In forms -->
```

### Password Hashing

```php
$hash = password_hash($password, PASSWORD_DEFAULT);
if (password_verify($input, $hash)) {
    // Password matches
}
```

---

## 🧪 Testing

### Create Test

```bash
php spark make:test UserTest
```

### Write Test

```php
namespace Tests\App\Controllers;

use Tests\Support\TestCase;

class UserTest extends TestCase
{
    public function testIndex()
    {
        $result = $this->get('/user');
        $result->assertStatus(200);
        $result->assertSee('Users');
    }
}
```

### Run Tests

```bash
composer test                          # All tests
./vendor/bin/phpunit tests/UserTest.php  # Specific test
./vendor/bin/phpunit --filter='testIndex'  # Filter
```

---

## 📚 Paths & Constants

Use these constants instead of hardcoding paths:

```php
ROOTPATH    // Project root: /var/www/destiny/
APPPATH     // App directory: /var/www/destiny/app/
SYSTEMPATH  // Framework: /var/www/destiny/vendor/codeigniter4/framework/
WRITEPATH   // Writable: /var/www/destiny/writable/
FCPATH      // Public folder: /var/www/destiny/public/
```

### Helper Functions

```php
base_url('assets/css/style.css')       // Full URL to asset
site_url('/user/view/1')               // Full URL to route
current_url()                          // Current page URL
previous_url()                         // Previous page URL
esc($string)                           // Escape for security
```

---

## 🐛 Debugging

### Enable Debug Mode

Edit `.env`:
```env
CI_ENVIRONMENT = development
```

Debug toolbar appears in development mode.

### Logging

```php
log_message('info', 'User created: ' . $userId);
log_message('error', 'Database error: ' . $error);
```

Logs stored in: `writable/logs/`

### var_dump & die

```php
// During debugging (NOT in production)
dd($variable);   // Dump and die
dump($variable); // Dump only
```

---

## 📦 .env Configuration

| Setting | Purpose | Example |
|---------|---------|---------|
| `CI_ENVIRONMENT` | Runtime environment | `development`, `production` |
| `app.baseURL` | Site base URL | `http://localhost:8080/` |
| `database.default.hostname` | Database host | `localhost` |
| `database.default.username` | Database user | `root` |
| `database.default.password` | Database password | `secret123` |
| `database.default.database` | Database name | `the_book_of_your_destiny` |
| `encryption.key` | Encryption key | Generate with `php spark key:generate` |
| `cache.handler` | Cache driver | `file`, `redis`, `memcached` |

---

## 🚢 Deployment Checklist

Before going to production:

- [ ] Set `CI_ENVIRONMENT = production` in `.env`
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Run database migrations: `php spark migrate`
- [ ] Test all routes and features
- [ ] Check error logs: `writable/logs/`
- [ ] Set proper file permissions on `writable/`
- [ ] Enable HTTPS/SSL certificate
- [ ] Configure backups
- [ ] Set up monitoring
- [ ] Document any custom configuration

---

## 📖 Documentation

- **README.md** - Full project documentation
- **DEPLOYMENT.md** - Deployment guides for different platforms
- **PORTABILITY.md** - How the framework stays portable
- **app/Config/Routes.php** - Route definitions

---

## 📞 Common Issues

### "Class not found"
```bash
composer dump-autoload
```

### "Database connection failed"
- Check `.env` credentials
- Verify database exists
- Check MySQL is running

### "Permission denied (writable)"
```bash
chmod -R 755 writable
```

### "404 on all routes"
- Verify `.htaccess` is in `/public` (Apache)
- Check mod_rewrite is enabled (Apache)
- Check Routes.php configuration

---

## 🔗 Useful Links

- CodeIgniter Docs: https://codeigniter.com/user_guide/
- PHP Manual: https://www.php.net/manual/
- Composer: https://getcomposer.org/
- MySQL: https://dev.mysql.com/doc/

---

## 💡 Tips & Tricks

### Useful Composer Scripts

```bash
composer serve    # Same as: php spark serve
composer migrate  # Same as: php spark migrate
composer test     # Run PHPUnit tests
composer lint     # Check code for issues
```

### Generate New Files

```bash
php spark make:controller UsersController  --restful
php spark make:model User -m               # With migration
php spark make:migration AddStatusToUsers
php spark make:seeder UserSeeder
```

### Clear Everything

```bash
php spark cache:clear
rm -rf writable/cache/*
rm -rf writable/logs/*
composer dump-autoload
```

### Fresh Start

```bash
rm .env
cp .env.example .env
# Edit .env with your settings
composer install
php spark migrate
php spark db:seed
```

---

## Version Information

- **Framework**: The Book Of Your Destiny v1.0.0
- **CodeIgniter**: 4.4+
- **PHP Required**: 8.0+
- **Database**: MySQL 8.0+ or MariaDB 10.5+

