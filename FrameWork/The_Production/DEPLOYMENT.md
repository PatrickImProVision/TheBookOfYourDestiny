# The Book Of Your Destiny - Deployment Guide

A comprehensive guide to deploying The Book Of Your Destiny framework on different platforms and environments.

## Table of Contents

1. [Local Development](#local-development)
2. [Apache (Linux/Windows)](#apache)
3. [Nginx (Linux)](#nginx)
4. [IIS (Windows Server)](#iis)
5. [Shared Hosting (cPanel/Plesk)](#shared-hosting)
6. [Docker](#docker)
7. [Cloud Platforms](#cloud-platforms)
8. [Troubleshooting](#troubleshooting)

---

## Local Development

### Prerequisites

- PHP 8.0 or higher
- Composer
- MySQL 8.0+ or MariaDB 10.5+

### Setup

1. **Install dependencies:**
   ```bash
   composer install
   ```

2. **Create environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Configure database in .env:**
   ```ini
   CI_ENVIRONMENT = development
   database.default.hostname = localhost
   database.default.database = the_book_of_your_destiny
   database.default.username = root
   database.default.password = 
   ```

4. **Run migrations:**
   ```bash
   php spark migrate
   ```

5. **Start development server:**
   ```bash
   php spark serve
   ```

6. **Access application:**
   - URL: `http://localhost:8080`

---

## Apache

### Requirements

- Apache 2.4+
- PHP 8.0+ (with php-fpm or mod_php)
- mod_rewrite enabled
- MySQL 8.0+

### Setup

1. **Enable mod_rewrite:**
   ```bash
   a2enmod rewrite
   ```

2. **Create virtual host:**
   ```apache
   <VirtualHost *:80>
       ServerName destinybook.local
       ServerAlias www.destinybook.local
       
       DocumentRoot /var/www/destinybook/public
       <Directory /var/www/destinybook/public>
           Options FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
       
       <Directory /var/www/destinybook>
           Deny from all
       </Directory>
       
       SetEnv CI_ENVIRONMENT production
       
       ErrorLog ${APACHE_LOG_DIR}/destinybook-error.log
       CustomLog ${APACHE_LOG_DIR}/destinybook-access.log combined
   </VirtualHost>
   ```

3. **Enable virtual host:**
   ```bash
   a2ensite destinybook
   systemctl reload apache2
   ```

4. **Configure permissions:**
   ```bash
   chown -R www-data:www-data /var/www/destinybook
   chmod -R 755 /var/www/destinybook
   chmod -R 775 /var/www/destinybook/writable
   ```

5. **Deploy application:**
   ```bash
   cd /var/www/destinybook
   composer install --no-dev --optimize-autoloader
   cp .env.example .env
   # Edit .env with database credentials
   php spark migrate
   ```

### HTTPS (Let's Encrypt)

```bash
certbot --apache -d destinybook.local
```

---

## Nginx

### Requirements

- Nginx 1.20+
- PHP 8.0+ with php-fpm
- MySQL 8.0+

### Setup

1. **Create nginx configuration:**
   ```nginx
   upstream php_backend {
       server unix:/run/php/php8.0-fpm.sock;
   }

   server {
       listen 80;
       listen [::]:80;
       server_name destinybook.local www.destinybook.local;
       
       root /var/www/destinybook/public;
       index index.php index.html;
       
       client_max_body_size 100M;

       # Redirect to HTTPS (uncomment when SSL is ready)
       # return 301 https://$server_name$request_uri;

       location / {
           try_files $uri $uri/ /index.php$is_args$args;
       }

       location ~ \.php$ {
           try_files $uri /index.php =404;
           fastcgi_pass php_backend;
           fastcgi_index index.php;
           include fastcgi_params;
           fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
           fastcgi_param CI_ENVIRONMENT production;
       }

       location ~ /\. {
           deny all;
           access_log off;
           log_not_found off;
       }

       location ~ ~* \.(jpg|jpeg|png|gif|ico|css|js|svg)$ {
           expires 1y;
           add_header Cache-Control "public, immutable";
       }

       # Deny access to sensitive files
       location ~ (\.env|composer\.|\.git|\.sql|\.md)$ {
           deny all;
       }
   }

   # HTTPS Server Block (uncomment and configure)
   # server {
   #     listen 443 ssl http2;
   #     listen [::]:443 ssl http2;
   #     server_name destinybook.local www.destinybook.local;
   #
   #     ssl_certificate /etc/letsencrypt/live/destinybook.local/fullchain.pem;
   #     ssl_certificate_key /etc/letsencrypt/live/destinybook.local/privkey.pem;
   #     # ... rest of configuration
   # }
   ```

2. **Enable site:**
   ```bash
   sudo ln -s /etc/nginx/sites-available/destinybook /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   ```

3. **Configure PHP-FPM:**
   ```bash
   sudo systemctl start php8.0-fpm
   sudo systemctl enable php8.0-fpm
   ```

4. **Deploy:**
   ```bash
   cd /var/www/destinybook
   composer install --no-dev --optimize-autoloader
   cp .env.example .env
   php spark migrate
   ```

---

## IIS

### Requirements

- IIS 10+ (Windows Server 2016+)
- PHP 8.0+ (installed via WebPlatformInstaller or manually)
- MySQL 8.0+ or SQL Server
- URL Rewrite Module

### Setup

1. **Install URL Rewrite Module:**
   - Download from: https://www.iis.net/downloads
   - Install "URL Rewrite Module 2.1"

2. **Create Application Pool:**
   - Open IIS Manager
   - New → Application Pool → "DestinyBook"
   - .NET CLR Version: No Managed Code
   - Start automatically: Checked

3. **Create Website:**
   - Right-click "Sites" → Add Website
   - Site name: DestinyBook
   - Physical path: `C:\path\to\The_Production\public`
   - Binding: `destinybook.local` (or your domain)
   - Application Pool: DestinyBook

4. **Configure Handler Mappings:**
   - Select DestinyBook website
   - Handler Mappings → Add Module Mapping
   - Request path: `*.php`
   - Module: `FastCgiModule`
   - Executable: Path to `php-cgi.exe` (e.g., `C:\PHP\php-cgi.exe`)
   - Name: PHP_via_FastCGI

5. **File Permissions:**
   - Right-click `writable` folder → Properties
   - Security tab → Edit → Select IIS AppPool account
   - Grant Modify permissions

6. **Deploy:**
   ```cmd
   cd C:\path\to\The_Production
   composer install --no-dev --optimize-autoloader
   copy .env.example .env
   # Edit .env with database credentials
   php spark migrate
   ```

### SSL/HTTPS

- IIS Manager → Site → Bindings → Add HTTPS binding
- Use self-signed or Let's Encrypt certificate

---

## Shared Hosting

### cPanel Hosting

1. **Upload files via FTP:**
   - Upload to `public_html` or create subdomain folder
   - Use FTP/SFTP client (FileZilla, Cyberduck, etc.)

2. **If domain uses add-on domain:**
   - cPanel → Addon Domains → Choose domain
   - Document Root should point to `/public`
   - Or create `.htaccess` in root:
     ```apache
     <IfModule mod_rewrite.c>
         RewriteEngine On
         RewriteBase /
         RewriteCond %{REQUEST_FILENAME} !-f
         RewriteCond %{REQUEST_FILENAME} !-d
         RewriteRule ^(.*)$ public/$1 [L]
     </IfModule>
     ```

3. **Create directory for writable:**
   ```bash
   mkdir -p public_html/writable/cache
   mkdir -p public_html/writable/logs
   mkdir -p public_html/writable/session
   mkdir -p public_html/writable/uploads
   chmod -R 755 public_html/writable
   ```

4. **Install Composer dependencies (via SSH):**
   ```bash
   cd public_html
   curl -sS https://getcomposer.org/installer | php
   php composer.phar install --no-dev --optimize-autoloader
   ```

5. **Create database:**
   - cPanel → MySQL Database Wizard
   - Create database and user

6. **Configure .env:**
   ```bash
   cp .env.example .env
   nano .env  # Edit credentials
   ```

7. **Run migrations (via SSH):**
   ```bash
   php spark migrate
   ```

### Plesk Hosting

1. **Upload via SFTP/SSH**
2. **Create Database:**
   - Plesk Control Panel → Databases → Add Database
3. **Install Composer:**
   ```bash
   cd httpdocs
   curl -sS https://getcomposer.org/installer | php
   ```
4. **Install dependencies:**
   ```bash
   php composer.phar install --no-dev --optimize-autoloader
   ```
5. **Follow same deployment steps**

---

## Docker

### Dockerfile

```dockerfile
FROM php:8.0-fpm-alpine

# Install extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    mysql-client \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_mysql \
        mysqldump

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 755 writable && \
    chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
```

### Docker Compose

```yaml
version: '3.8'

services:
  web:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "80:80"
    volumes:
      - ./:/var/www/html
      - ./docker/nginx.conf:/etc/nginx/conf.d/default.conf
    environment:
      - CI_ENVIRONMENT=production
    depends_on:
      - db
      - php

  php:
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - ./:/var/www/html
    environment:
      - CI_ENVIRONMENT=production

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: the_book_of_your_destiny
      MYSQL_USER: app_user
      MYSQL_PASSWORD: app_password
    ports:
      - "3306:3306"
    volumes:
      - database:/var/lib/mysql

volumes:
  database:
```

### Run Docker

```bash
docker-compose up -d
docker-compose exec php spark migrate
```

---

## Cloud Platforms

### AWS (EC2)

1. **Launch EC2 Instance:**
   - AMI: Ubuntu 20.04 LTS or similar
   - Instance type: t3.small (minimum)
   - Security Group: Allow 80, 443

2. **Install stack:**
   ```bash
   sudo apt update && sudo apt upgrade -y
   sudo apt install -y nginx php8.0-fpm php8.0-mysql php8.0-xml php8.0-gd
   
   # Install Composer
   curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
   ```

3. **Configure Nginx** (use configuration from [Nginx section](#nginx))

4. **Deploy:**
   ```bash
   mkdir -p /var/www/destinybook
   cd /var/www/destinybook
   git clone <your-repo> .
   composer install --no-dev --optimize-autoloader
   ```

### DigitalOcean / Linode

1. **Create droplet with:**
   - OS: Ubuntu 20.04 LTS
   - Image: LAMP or custom PHP8.0+
   - Size: $5-10/month

2. **SSH into droplet:**
   ```bash
   ssh root@<ip_address>
   ```

3. **Follow general Linux deployment steps (Nginx or Apache)**

### Heroku

1. **Create `Procfile`:**
   ```
   web: vendor/bin/heroku-php-apache2 public/
   ```

2. **Create `composer.lock` (if not exists):**
   ```bash
   composer update
   ```

3. **Deploy:**
   ```bash
   heroku create destinybook
   git push heroku main
   heroku run php spark migrate
   ```

### Azure App Service

1. **Create App Service (PHP 8.0 Runtime)**

2. **Via Deployment Center:**
   - Source: GitHub / Local Git
   - Runtime stack: PHP 8.0

3. **Configure .env in Azure Key Vault**

4. **Deploy:**
   ```bash
   az webapp deployment slot swap --resource-group mygroup --name destinybook --slot staging
   ```

---

## Troubleshooting

### "500 Internal Server Error"

1. **Check logs:**
   - Apache: `/var/log/apache2/error.log`
   - Nginx: `/var/log/nginx/error.log`
   - App: `/writable/logs/`

2. **Enable debug mode** (temporarily):
   ```env
   CI_ENVIRONMENT = development
   ```

3. **Check PHP errors:**
   ```bash
   php -l public/index.php  # Syntax check
   ```

### "Class 'Config\Database' not found"

```bash
composer dump-autoload --optimize
php spark cache:clear
```

### "Writable directory permission denied"

```bash
chmod -R 755 writable
chmod -R u+w writable
```

### Database connection error

1. **Verify credentials in .env**
2. **Test connection:**
   ```bash
   php spark db:info
   ```
3. **Check MySQL is running:**
   ```bash
   systemctl status mysql  # or mariadb
   ```

### "404 Not Found" on all routes

**Apache:**
- Check `.htaccess` is in `/public`
- Verify `AllowOverride All` in VirtualHost
- Restart Apache: `systemctl reload apache2`

**Nginx:**
- Verify `try_files` directive includes `/index.php`
- Check error logs

**IIS:**
- Verify web.config exists in `/public`
- Check URL Rewrite is installed

---

## Performance Checklist

- [ ] Set `CI_ENVIRONMENT = production`
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Enable HTTP caching headers
- [ ] Use Redis/Memcached for sessions (optional)
- [ ] Set up database backups
- [ ] Enable HTTPS/SSL
- [ ] Configure firewall rules
- [ ] Set up monitoring/logging
- [ ] Enable gzip compression (web server)
- [ ] Minify CSS/JavaScript assets

---

## Security Hardening

1. **Keep PHP updated:** `php -v` should show latest patch
2. **Use strong database passwords**
3. **Enable HTTPS everywhere**
4. **Set secure headers:**
   - X-Frame-Options
   - X-Content-Type-Options
   - X-XSS-Protection
5. **Regular backups** of database and files
6. **Monitor access logs** for suspicious activity
7. **Disable directory listing**
8. **Restrict access to sensitive files** (.env, composer.json, etc.)

---

## Support & Documentation

- CodeIgniter Official: https://codeigniter.com
- PHP Documentation: https://www.php.net
- Database Migration Guides: Check `/app/Database` folder

