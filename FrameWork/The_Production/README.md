# The Book Of Your Destiny - Production

A PHP E-Book Store FrameWork built on CodeIgniter v4

## 🎯 Project Description

**The Book Of Your Destiny** is a **fully portable** Micro‑Store MVC FrameWork designed for managing, editing, and distributing e-books. This platform runs on any PHP 8.0+ server without modification.

### ✨ Portability Features:
- ✅ **Dynamic path resolution** - Works from any installation directory
- ✅ **Vendor-based framework** - CodeIgniter loaded via Composer (no local /system folder)
- ✅ **Multi-server support** - Apache, Nginx, IIS, PHP built-in server
- ✅ **Cross-platform** - Windows .bat and Linux .sh installation scripts
- ✅ **No hardcoded paths** - All paths resolved at runtime
- ✅ **Environment-agnostic** - Works in development, staging, and production

## Features

✨ **Core Capabilities:**
- WYSIWYG Editor (TinyMCE integration) with HTML5 support
- Full-text Search with lightweight search library
- URI Injector with FileSystem Support
- Image Injector with FileSystem Support
- Object 360° Alignment
- User-Friendly HTML5 WebView
- JSON Data Structure for all content

📦 **Content Management:**
- Book Case Management (Container for books)
- Book Organization (Multiple sections: PreFace, FlagStone, FullStory, Knowledge, BibleLegend, LeaderShip)
- Page Management with canonical ID system (A-Z, 0-9)
- Media Management (images, audio, video)
- Content Export to Word (.docx) and OpenOffice (.odt)

🎨 **User Interface:**
- Light and Dark Themes
- Responsive Design (A5 book format)
- Bootstrap 5 Integration
- Intuitive Navigation

## Project Structure

```
The_Production/
├── app/                            # Application code
│   ├── Common.php                  # Application helpers
│   ├── Controllers/                # Application controllers
│   ├── Models/                     # Data models
│   ├── Views/                      # Application views
│   └── Config/
│       ├── App.php                 # Application settings
│       ├── Database.php            # Database configuration
│       ├── Routes.php              # Routing configuration
│       ├── Filters.php             # Request filters
│       ├── Cache.php               # Cache configuration
│       ├── Logger.php              # Logging configuration
│       ├── Bootstrap.php           # Portable bootstrap functions
│       └── Boot/
│           └── production.php      # Production bootstrap
├── public/                          # Web root (document root)
│   ├── index.php                   # Application entry point (portable)
│   ├── .htaccess                   # Apache rewrite rules
│   ├── web.config                  # IIS configuration
│   ├── .webserver.php              # PHP built-in server router
│   └── robots.txt                  # SEO configuration
├── writable/                        # Writable directory (logs, cache, uploads)
│   ├── cache/                      # Cache files
│   ├── logs/                       # Application logs
│   ├── session/                    # Session files
│   └── uploads/                    # User uploads
├── vendor/                          # Composer dependencies (gitignored)
├── tests/                           # Unit tests
├── .env                             # Environment configuration (copy of .env.example)
├── .env.example                     # Environment template
├── .gitignore                       # Git ignore rules
├── composer.json                    # PHP dependencies
├── composer.lock                    # Locked dependencies (git committed)
├── spark                            # CodeIgniter CLI tool (portable)
├── install.sh                       # Linux/Mac installation script
├── install.bat                      # Windows installation script
└── README.md                        # This file
```

## Installation

### Quick Start (Recommended)

#### Linux/Mac:
```bash
bash install.sh
```

#### Windows:
```bash
install.bat
```

### Manual Installation

1. **Install PHP 8.0+** if not already installed

2. **Install Composer** from https://getcomposer.org

3. **Clone or download** the framework to your desired location

4. **Install dependencies:**
   ```bash
   composer install
   ```

5. **Create environment file** (if not auto-created):
   ```bash
   cp .env.example .env
   ```

6. **Configure .env** with your database credentials:
   ```
   database.default.hostname = localhost
   database.default.database = the_book_of_your_destiny
   database.default.username = root
   database.default.password = your_password
   ```

7. **Run migrations:**
   ```bash
   php spark migrate
   ```

8. **Serve the application:**
   ```bash
   php spark serve
   ```

9. **Visit:** `http://localhost:8080`

## Deployment Scenarios

### 📍 Apache (with mod_rewrite)

The `.htaccess` file in `/public` handles URL rewriting automatically.

**Requirements:**
- Apache 2.4+
- mod_rewrite enabled
- AllowOverride All

**Setup:**
1. Point document root to `/public`
2. Set up .env with production database
3. Ensure `/writable` directory permissions: `chmod 755 writable`

### 📍 Nginx

Create a nginx configuration:

```nginx
server {
    listen 80;
    server_name example.com;
    root /var/www/html/The_Production/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\. {
        deny all;
    }
}
```

### 📍 IIS (Windows Server)

The `web.config` file handles URL rewriting via IIS modules.

**Requirements:**
- IIS 10+
- URL Rewrite Module installed

**Setup:**
1. Point root to `/public`
2. Set up .env configuration
3. Ensure `/writable` folder has write permissions

### 📍 cPanel/Shared Hosting

1. Upload files to `public_html` or subdomain folder
2. Point document root to `/public` folder
3. Create writable directories:
   ```bash
   mkdir -p writable/cache writable/logs writable/session writable/uploads
   chmod 755 writable/*
   ```
4. Configure .env with your database (provided by host)
5. Run `php spark migrate` via SSH

### 📍 Docker

```dockerfile
FROM php:8.0-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 755 writable

EXPOSE 9000
```

### 📍 Heroku

1. Create `Procfile`:
   ```
   web: vendor/bin/heroku-php-apache2 public/
   ```

2. Deploy:
   ```bash
   git push heroku main
   ```

## Configuration

### Core Settings (.env)

```bash
# Application
app.baseURL = 'http://localhost:8080/'
CI_ENVIRONMENT = development

# Database
database.default.hostname = localhost
database.default.database = the_book_of_your_destiny
database.default.username = root
database.default.password = 
database.default.port = 3306

# Cache
cache.handler = file

# Logging
log.threshold = 4
```

## URL Structure

### Standard Routes:
- `GET /` - Home/Dashboard
- `GET /case/list` - List all cases
- `GET /book/list` - List all books
- `GET /page/list` - List all pages

### Special Routes (As per specification):
- `GET /edit.app?CaseID=X&BookID=Y&PageID=Z` - WYSIWYG Editor
- `GET /view.app?CaseID=X&BookID=Y&PageID=Z` - Content Viewer
- `GET /new.app?type=case|book|page` - Creation Wizard

## Management Commands

```bash
# Run the built-in web server
php spark serve

# Run database migrations
php spark migrate

# Seed the database
php spark db:seed

# Run tests
composer test

# Check code for issues
composer lint
```

## Database Schema

### Tables (To be created via migrations):

**cases**
- id (INT, PK)
- canonical_id (VARCHAR)
- case_name (VARCHAR)
- case_title (VARCHAR)
- case_description (TEXT)
- author (VARCHAR)
- owner_id (INT, FK)
- status (ENUM)
- created_at (DATETIME)
- updated_at (DATETIME)

**books**
- id (INT, PK)
- canonical_id (VARCHAR)
- case_id (INT, FK)
- book_name (VARCHAR)
- book_title (VARCHAR)
- book_description (TEXT)
- book_author (VARCHAR)
- book_type (VARCHAR)
- status (ENUM)
- created_at (DATETIME)
- updated_at (DATETIME)

**pages**
- id (INT, PK)
- canonical_id (VARCHAR)
- book_id (INT, FK)
- section_type (VARCHAR)
- page_sequence (INT)
- page_title (VARCHAR)
- page_content (LONGTEXT)
- page_images (JSON)
- page_uris (JSON)
- is_published (BOOLEAN)
- created_at (DATETIME)
- updated_at (DATETIME)

## Troubleshooting

### "CodeIgniter framework not found"
```bash
composer install
```

### "Writable directory is not writable"
```bash
chmod -R 755 writable
chmod -R u+w writable
```

### Database connection failed
1. Check .env credentials
2. Verify database exists
3. Test connection manually

### Blank page on first run
1. Check `/writable/logs` for errors
2. Verify PHP version: `php -v` (must be 8.0+)
3. Clear cache: `rm -rf writable/cache/*`

## Performance Optimization

For production environments:

1. **Set ENVIRONMENT to 'production'** in .env
2. **Optimize autoloader:** `composer install --no-dev --optimize-autoloader`
3. **Enable caching** in config/Cache.php
4. **Set up proper logging** in config/Logger.php
5. **Use Redis/Memcached** for session storage (optional)

## Next Steps (Phase 2)

1. **Database Migrations** - Create schema migration files
2. **TinyMCE Integration** - Full WYSIWYG editor implementation
3. **Media Management** - File upload and processing system
4. **Search Engine** - Full-text search implementation
5. **Export Features** - Word/ODT export functionality
6. **User Authentication** - Auth system with roles (Admin, Moderator, User)
7. **API Layer** - REST API for frontend integration

## Guiding Principle

> "Maintain strict continuity with all previously established elements—conceptual, structural, narrative, symbolic, and relational—unless explicitly authorized otherwise."

This framework upholds this principle, ensuring consistent semantic ontology throughout the application structure.

## License

MIT License - See LICENSE file for details

## Author

ImProVision Man  
The Book Of Your Destiny - Created by The Will Of God


## Features

✨ **Core Capabilities:**
- WYSIWYG Editor (TinyMCE integration) with HTML5 support
- Full-text Search with lightweight search library
- URI Injector with FileSystem Support
- Image Injector with FileSystem Support
- Object 360° Alignment
- User-Friendly HTML5 WebView
- JSON Data Structure for all content

📦 **Content Management:**
- Book Case Management (Container for books)
- Book Organization (Multiple sections: PreFace, FlagStone, FullStory, Knowledge, BibleLegend, LeaderShip)
- Page Management with canonical ID system (A-Z, 0-9)
- Media Management (images, audio, video)
- Content Export to Word (.docx) and OpenOffice (.odt)

🎨 **User Interface:**
- Light and Dark Themes
- Responsive Design (A5 book format)
- Bootstrap 5 Integration
- Intuitive Navigation

## Project Structure

```
The_Production/
├── app/
│   ├── Common.php                  # Application helpers
│   ├── Controllers/                # Application controllers
│   │   ├── BaseController.php      # Base controller with common functionality
│   │   ├── Home.php                # Home/Dashboard controller
│   │   ├── Case.php                # Case management
│   │   ├── Book.php                # Book management
│   │   ├── Page.php                # Page management
│   │   ├── Editor.php              # WYSIWYG editor (edit.app)
│   │   ├── Viewer.php              # Content viewer (view.app)
│   │   └── Creator.php             # Creation wizard (new.app)
│   ├── Models/                     # Data models
│   │   ├── BaseModel.php           # Base model with ID generation
│   │   ├── CaseModel.php           # Case entity
│   │   ├── BookModel.php           # Book entity
│   │   └── PageModel.php           # Page entity
│   ├── Views/                      # Application views
│   │   ├── layout/                 # Base layout templates
│   │   ├── home/                   # Home page views
│   │   ├── case/                   # Case management views
│   │   ├── book/                   # Book management views
│   │   ├── page/                   # Page management views
│   │   ├── editor/                 # Editor interface
│   │   ├── viewer/                 # Viewer interface
│   │   └── creator/                # Creation wizard views
│   └── Config/                     # Configuration files
│       ├── App.php                 # Application settings
│       ├── Database.php            # Database configuration
│       ├── Routes.php              # Routing configuration
│       ├── Filters.php             # Request filters
│       ├── Cache.php               # Cache configuration
│       ├── Logger.php              # Logging configuration
│       └── Boot/
│           └── production.php      # Production bootstrap
├── public/
│   ├── index.php                   # Application entry point
│   └── robots.txt                  # SEO configuration
├── system/                         # CodeIgniter system files
├── writable/                       # Writable directory (logs, cache, uploads)
├── .env                            # Environment configuration
├── .gitignore                      # Git ignore rules
├── composer.json                   # PHP dependencies
└── spark                           # CLI tool
```

## URL Structure

### Main Routes:
- `GET /` - Home/Dashboard
- `GET /case/list` - List all cases
- `GET /case/create` - Create new case
- `GET /case/view/{id}` - View case
- `GET /case/edit/{id}` - Edit case
- `GET /case/delete/{id}` - Delete case

### Book Routes:
- `GET /book/list` - List all books
- `GET /book/create` - Create new book
- `GET /book/view/{id}` - View book
- `GET /book/edit/{id}` - Edit book
- `GET /book/delete/{id}` - Delete book

### Page Routes:
- `GET /page/list` - List all pages
- `GET /page/create` - Create new page
- `GET /page/view/{id}` - View page
- `GET /page/edit/{id}` - Edit page
- `GET /page/delete/{id}` - Delete page

### Special Routes (As per specification):
- `GET /edit.app?CaseID=X&BookID=Y&PageID=Z` - WYSIWYG Editor
- `GET /view.app?CaseID=X&BookID=Y&PageID=Z` - Content Viewer
- `GET /new.app?type=case|book|page` - Creation Wizard

## Technology Stack

- **Framework:** CodeIgniter v4.4+
- **Language:** PHP 8.0+
- **Database:** MySQL 8.0+ (configured via .env)
- **Frontend:** HTML5, Bootstrap 5, JavaScript
- **Editor:** TinyMCE 6.0
- **Export:** PHPOffice/PHPWord
- **Dependency Manager:** Composer

## Installation

1. Clone the repository to `The_Production` folder
2. Copy `.env` and configure database credentials:
   ```bash
   cp .env.example .env
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Create database and run migrations:
   ```bash
   php spark migrate
   ```

5. Serve the application:
   ```bash
   php spark serve
   ```

6. Access at: `http://localhost:8080`

## Configuration

Edit `.env` file to configure:
```
# Database
database.default.hostname = localhost
database.default.database = the_book_of_your_destiny
database.default.username = root
database.default.password = 

# Application URL
app.baseURL = 'http://localhost:8080/'

# Environment
CI_ENVIRONMENT = development
```

## Database Schema

### Tables (To be created via migrations):

**cases**
- id (INT, PK)
- canonical_id (VARCHAR)
- case_name (VARCHAR)
- case_title (VARCHAR)
- case_description (TEXT)
- author (VARCHAR)
- owner_id (INT, FK)
- status (ENUM)
- created_at (DATETIME)
- updated_at (DATETIME)

**books**
- id (INT, PK)
- canonical_id (VARCHAR)
- case_id (INT, FK)
- book_name (VARCHAR)
- book_title (VARCHAR)
- book_description (TEXT)
- book_author (VARCHAR)
- book_type (VARCHAR)
- status (ENUM)
- created_at (DATETIME)
- updated_at (DATETIME)

**pages**
- id (INT, PK)
- canonical_id (VARCHAR)
- book_id (INT, FK)
- section_type (VARCHAR)
- page_sequence (INT)
- page_title (VARCHAR)
- page_content (LONGTEXT)
- page_images (JSON)
- page_uris (JSON)
- is_published (BOOLEAN)
- created_at (DATETIME)
- updated_at (DATETIME)

## Next Steps (Phase 2)

1. **Database Migrations** - Create schema migration files
2. **TinyMCE Integration** - Full WYSIWYG editor implementation
3. **Media Management** - File upload and processing system
4. **Search Engine** - Full-text search implementation
5. **Export Features** - Word/ODT export functionality
6. **User Authentication** - Auth system with roles (Admin, Moderator, User)
7. **API Layer** - REST API for frontend integration

## Guiding Principle

> "Maintain strict continuity with all previously established elements—conceptual, structural, narrative, symbolic, and relational—unless explicitly authorized otherwise."

This principle ensures consistent semantic ontology throughout the application structure, maintaining the integrity of "The Book Of Your Destiny" framework.

## License

MIT License - See LICENSE file for details

## Author

ImProVision Man
The Book Of Your Destiny - Created by The Will Of God
