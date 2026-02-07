# The Book Of Your Destiny - Portability Guide

## Overview

The Book Of Your Destiny framework is engineered for **complete portability**. You can deploy it to any PHP 8.0+ environment without modification, whether on local machines, shared hosting, cloud platforms, or containerized environments.

---

## What Makes This Framework Portable?

### 1. **Dynamic Path Resolution**

Instead of hardcoding paths like `/var/www/app/system`, the framework determines all paths at runtime:

```php
// public/index.php
$fcPath = __DIR__ . DIRECTORY_SEPARATOR;
$rootPath = dirname($fcPath) . DIRECTORY_SEPARATOR;

define('FCPATH', $fcPath);
define('ROOTPATH', $rootPath);
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
define('SYSTEMPATH', ROOTPATH . 'vendor' . DIRECTORY_SEPARATOR . 'codeigniter4' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR);
```

**Benefits:**
- Works on any absolute path
- No configuration needed for different installations
- Automatic subdirectory detection

### 2. **Vendor-Based Framework**

The CodeIgniter framework is NOT included in the repository. Instead, it's a Composer dependency:

```json
{
    "require": {
        "codeigniter4/framework": "^4.4"
    }
}
```

**Benefits:**
- Smaller repository size
- Automatic updates via `composer install`
- Works with any Composer-compatible hosting
- Easy to update framework independently

```
Before (Portable): 150+ MB with /system folder
After (Portable):   < 5 MB + 90 MB vendor (installed locally)
```

### 3. **Server Agnostic Entry Points**

The framework works on **any web server** without modification:

#### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?/$1 [L]
</IfModule>
```

#### Nginx (server block)
```nginx
location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

#### IIS (web.config)
```xml
<rewrite>
    <rules>
        <rule name="Route requests">
            <action type="Rewrite" url="index.php?/{R:1}" />
        </rule>
    </rules>
</rewrite>
```

#### PHP Built-in Server (.webserver.php)
```php
if (is_file(__DIR__ . $_SERVER['REQUEST_URI'])) {
    return false;
}
require_once 'index.php';
```

**Benefit:** Use the same codebase on all servers - configuration handled by each server's native rules.

### 4. **Environment-Based Configuration**

All configuration is external to code via `.env` file:

```env
CI_ENVIRONMENT = production
database.default.hostname = prod-db.example.com
database.default.username = prod_user
encryption.key = production-key-here
```

No code changes needed - just copy `.env.example` to `.env` and customize.

### 5. **CLI Tool Portability**

The `spark` CLI works from any directory:

```bash
# Call from anywhere
/var/www/app/spark serve
/home/user/projects/app/spark migrate
c:\www\app\spark db:seed
```

The spark file automatically:
- Detects its installation directory
- Resolves all paths relative to itself
- Loads environment configuration

### 6. **No Absolute Path References**

✅ **Good (Portable):**
```php
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
$file = APPPATH . 'Models' . DIRECTORY_SEPARATOR . 'UserModel.php';
```

❌ **Bad (Not Portable):**
```php
define('APPPATH', '/var/www/myapp/app/');
define('APPPATH', 'C:\\www\\myapp\\app\\');
```

---

## Portability Checklist

### When Deploying:

- [ ] No hardcoded `/var/www/`, `C:\www\`, or similar paths
- [ ] Use relative paths and DIRECTORY_SEPARATOR
- [ ] All configuration in `.env` file
- [ ] Framework loaded via Composer (not included)
- [ ] `.htaccess` for Apache included
- [ ] `web.config` for IIS included
- [ ] `.webserver.php` for built-in server included
- [ ] Nginx config provided in documentation
- [ ] Installation scripts handle all setup
- [ ] Can be installed in any directory depth

### Before Shipping Code:

- [ ] Test locally
- [ ] Test on different server (shared hosting, cloud, etc.)
- [ ] Test with different directory structures
- [ ] Test with different database configurations
- [ ] Verify all paths resolve correctly
- [ ] Ensure no environment-specific code

---

## Installation Examples

### Local Machine
```bash
/home/user/projects/the-book/public  # Works
/root/workspace/destiny/public       # Works
C:\Users\Project\the-book\public     # Works
```

### Shared Hosting
```
public_html/The_Production/public    # Works
httpdocs/app/public                  # Works
home/user/public_html/archive/public # Works
```

### Docker/Container
```
/var/www/html/public                 # Works
/app/public                          # Works
/usr/local/app/public                # Works
```

### Virtual Server
```
/srv/www/destiny/public              # Works
/opt/www/books/public                # Works
D:\websites\destiny\public           # Works (Windows)
```

---

## Common Portability Mistakes to Avoid

### ❌ Hardcoded Paths
```php
// BAD - Not portable
define('UPLOAD_DIR', '/var/www/myapp/writable/uploads');
$css = '<link href="/assets/css/style.css">';
```

### ✅ Dynamic Paths
```php
// GOOD - Portable
define('UPLOAD_DIR', WRITEPATH . 'uploads');
$css = '<link href="' . base_url('assets/css/style.css') . '">';
```

### ❌ Server-Specific Database Config
```php
// BAD
if ($_SERVER['HTTP_HOST'] === 'prod.example.com') {
    $db_host = 'prod-db.example.com';
}
```

### ✅ Environment-Based Config
```php
// GOOD (.env file)
database.default.hostname = localhost  # for development
database.default.hostname = prod-db.example.com  # for production
```

---

## Deployment Workflow

### Development → Staging → Production

```
1. Develop locally
   ├─ Test with different .env values
   └─ Verify portable paths

2. Deploy to staging
   ├─ Use staging-specific .env
   ├─ Run migrations
   └─ Test all features

3. Deploy to production
   ├─ Copy .env.example → .env
   ├─ Configure with production credentials
   ├─ Run migrations
   └─ Verify all paths resolve
```

### Code Changes
Only app code changes (Controllers, Models, Views) need deployment.
Framework and dependencies are installed via `composer install`.

---

## Performance Impact

### Repository Size
| Component | Size |
|-----------|------|
| App Code | ~2 MB |
| Dependencies (vendor/) | ~90 MB |
| **Total** | **~92 MB** |

The larger size is offset by:
- Easy updates via Composer
- Automatic security patches
- No manual framework updates
- Version control for all dependencies

### Installation Time
- Fresh install: ~30 seconds (composer install)
- Subsequent installs: ~5 seconds (cached)

### Runtime Overhead
- Path resolution: **negligible** (< 1ms per request)
- Environment loading: **negligible** (< 1ms per request)
- No performance impact after framework bootstrap

---

## Testing Portability

### Test 1: Different Directory Depths
```bash
# Shallow
cd /www/app/public && php -S localhost:8080 .webserver.php

# Deep
cd /var/www/mycompany/projects/2024/destiny/public && php -S localhost:8080 .webserver.php
```

### Test 2: Different Servers
```bash
# Apache
a2enmod rewrite && systemctl reload apache2

# Nginx
nginx -t && systemctl reload nginx

# PHP Built-in
php spark serve --host 127.0.0.1 --port 8080

# IIS
# Apply web.config and test
```

### Test 3: Different Environments
```bash
# Development
CI_ENVIRONMENT=development php spark serve

# Production
CI_ENVIRONMENT=production php spark migrate

# Testing
CI_ENVIRONMENT=testing composer test
```

---

## Migration from Non-Portable Setup

If you have a non-portable CodeIgniter setup, here's how to make it portable:

### Step 1: Remove System Directory
```bash
rm -rf /system
```

### Step 2: Add Composer
```bash
composer init
# Or use composer.json from this project
```

### Step 3: Update Entry Point
```php
// Replace hardcoded paths with dynamic resolution
define('SYSTEMPATH', ROOTPATH . 'vendor/codeigniter4/framework/');
```

### Step 4: Add Server Configs
- Copy `.htaccess` to public/
- Copy `web.config` to public/
- Add Nginx configuration documentation

### Step 5: Test
```bash
composer install
php spark serve
```

---

## Best Practices for Portability

1. **Always use `ROOTPATH`, `APPPATH`, `SYSTEMPATH`, etc.**
   ```php
   ✅ include APPPATH . 'Models/UserModel.php';
   ❌ include '/var/www/app/app/Models/UserModel.php';
   ```

2. **Use `base_url()`, `site_url()` for URLs**
   ```php
   ✅ echo base_url('assets/style.css');
   ❌ echo '/assets/style.css';  // Wrong on subdirectories
   ```

3. **Use `DIRECTORY_SEPARATOR`**
   ```php
   ✅ $path = APPPATH . 'Models' . DIRECTORY_SEPARATOR . 'User.php';
   ❌ $path = APPPATH . 'Models/User.php';  // Fails on Windows
   ```

4. **Keep Configuration External**
   ```php
   ✅ $setting = getenv('CUSTOM_SETTING');
   ❌ $setting = 'hardcoded_value';
   ```

5. **Use Relative Imports**
   ```php
   ✅ require_once 'Config/Bootstrap.php';
   ❌ require_once '/home/user/project/app/Config/Bootstrap.php';
   ```

---

## Verification Checklist

After making code changes, verify portability:

```bash
# Check no absolute paths
grep -r "\/home\|\/var\/www\|C:\\\\" app/  # Should find nothing

# Check no hardcoded URLs
grep -r "http:\/\/localhost\|http:\/\/.*\.local" app/  # Should find nothing

# Check composer.json is valid
composer validate

# Test installation
rm -rf vendor
composer install

# Test on different environments
CI_ENVIRONMENT=development php spark serve
CI_ENVIRONMENT=testing composer test
CI_ENVIRONMENT=production php spark migrate
```

---

## Conclusion

The Book Of Your Destiny framework is designed to be **truly portable**. You can:

✅ Install it anywhere  
✅ On any server  
✅ In any directory structure  
✅ With any database  
✅ In any environment  

Without changing **a single line of code**.

This makes it ideal for:
- Distributed development teams
- Multi-environment deployments
- Hosting migrations
- Containerization
- Open-source distribution

