# Database Migrations & Seeders Guide

## Overview

This guide explains how to use CodeIgniter's migration system to create and manage database tables for The Book Of Your Destiny framework.

---

## 📋 Migration Files Created

### Core Tables

| Migration | Table | Purpose |
|-----------|-------|---------|
| `2026_02_07_000001_CreateCasesTable.php` | `cases` | Book case/container entity |
| `2026_02_07_000002_CreateBooksTable.php` | `books` | Book entity within cases |
| `2026_02_07_000003_CreatePagesTable.php` | `pages` | Page content with rich media |
| `2026_02_07_000004_CreateUsersTable.php` | `users` | User accounts and auth |

---

## 🚀 Running Migrations

### Initial Setup

First, ensure CodeIgniter is installed and your `.env` file is configured:

```bash
# 1. Install dependencies
composer install

# 2. Configure database in .env
# Edit .env and set:
# database.default.hostname = localhost
# database.default.database = book_of_destiny
# database.default.username = root
# database.default.password = yourpassword

# 3. Create database (if not exists)
mysql -u root -p -e "CREATE DATABASE book_of_destiny CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 4. Run all migrations
php spark migrate
```

### Check Migration Status

```bash
# See which migrations have been run
php spark migrate:status
```

Example output:
```
Name                                    Batch  Migrated On
2026-02-07 00:00:01 CreateCasesTable        1    2026-02-07 10:30:45
2026-02-07 00:00:02 CreateBooksTable        1    2026-02-07 10:30:46
2026-02-07 00:00:03 CreatePagesTable        1    2026-02-07 10:30:47
2026-02-07 00:00:04 CreateUsersTable        1    2026-02-07 10:30:48
```

### Run Specific Migration

```bash
# Run a specific migration
php spark migrate --name CreateCasesTable

# Run migrations for a specific namespace
php spark migrate --group App
```

### Rollback Migrations

```bash
# Rollback last batch
php spark migrate:rollback

# Rollback all migrations
php spark migrate:rollback --all

# Rollback to specific batch
php spark migrate:rollback --batch 1
```

### Fresh Install

```bash
# Rollback all then run fresh
php spark migrate:refresh

# Include seeders
php spark migrate:refresh --seed
```

---

## 🌱 Database Seeders

Seeders populate your database with test/sample data.

### Available Seeders

| Seeder | Table | Records | Purpose |
|--------|-------|---------|---------|
| `CaseSeeder` | cases | 3 | Sample book cases |
| `BookSeeder` | books | 5 | Sample books |
| `DatabaseSeeder` | - | - | Main seeder that calls others |

### Run Seeders

```bash
# Run all seeders
php spark db:seed DatabaseSeeder

# Run specific seeder
php spark db:seed CaseSeeder

# Run with migrations
php spark migrate --seed
```

### Creating New Seeders

```bash
# Generate a new seeder
php spark make:seeder PageSeeder
```

Example seeder structure:

```php
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'canonical_id'   => 'A0P0',
                'book_id'        => 1,
                'section_type'   => 'fullstory',
                'page_sequence'  => 1,
                'page_title'     => 'First Page',
                'page_content'   => 'Sample content...',
                'status'         => 'published',
            ],
            // More records...
        ];

        $this->db->table('pages')->insertBatch($data);
    }
}
```

---

## 📊 Database Schema

### Cases Table

```sql
CREATE TABLE cases (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  canonical_id VARCHAR(36) UNIQUE NOT NULL,
  case_name VARCHAR(255),
  case_title VARCHAR(500),
  case_description LONGTEXT,
  author VARCHAR(255),
  owner_id BIGINT,
  status ENUM('draft', 'published', 'archived'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL,
  KEY (canonical_id),
  KEY (owner_id),
  KEY (status)
);
```

### Books Table

```sql
CREATE TABLE books (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  canonical_id VARCHAR(36) UNIQUE NOT NULL,
  case_id BIGINT NOT NULL,
  book_name VARCHAR(255),
  book_title VARCHAR(500),
  book_description LONGTEXT,
  book_author VARCHAR(255),
  book_type ENUM('inspirational_pages', 'preface', 'flagstone', 'fullstory', 'knowledge', 'biblelegend', 'leadership'),
  status ENUM('draft', 'published', 'archived'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL,
  KEY (canonical_id),
  KEY (case_id),
  FOREIGN KEY (case_id) REFERENCES cases(id) ON DELETE CASCADE
);
```

### Pages Table

```sql
CREATE TABLE pages (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  canonical_id VARCHAR(36) UNIQUE NOT NULL,
  book_id BIGINT NOT NULL,
  section_type ENUM('preface', 'flagstone', 'fullstory', 'knowledge', 'biblelegend', 'leadership'),
  page_sequence INT UNSIGNED,
  page_title VARCHAR(500),
  page_moto VARCHAR(500),
  page_subtitle VARCHAR(500),
  page_author VARCHAR(255),
  page_content LONGTEXT,
  page_images JSON,
  page_uris JSON,
  page_layout VARCHAR(100),
  align_text ENUM('left', 'center', 'right', 'justify'),
  align_images ENUM('left', 'center', 'right'),
  is_published TINYINT(1),
  status ENUM('draft', 'published', 'archived'),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL,
  KEY (canonical_id),
  KEY (book_id),
  KEY (section_type),
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);
```

### Users Table

```sql
CREATE TABLE users (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(100) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password_hash VARCHAR(255),
  first_name VARCHAR(100),
  last_name VARCHAR(100),
  role ENUM('admin', 'moderator', 'user', 'guest'),
  status ENUM('active', 'inactive', 'banned'),
  email_verified TINYINT(1),
  email_verified_at TIMESTAMP NULL,
  last_login_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP NULL,
  KEY (username),
  KEY (email),
  KEY (role)
);
```

---

## ✅ Complete Setup Checklist

- [ ] Edit `.env` with correct database credentials
- [ ] Create the database: `mysql -u root -p -e "CREATE DATABASE book_of_destiny;"`
- [ ] Run migrations: `php spark migrate`
- [ ] Check status: `php spark migrate:status`
- [ ] Run seeders: `php spark db:seed DatabaseSeeder`
- [ ] Verify tables in database: `mysql -u root -p book_of_destiny -e "SHOW TABLES;"`

---

## 🔍 Troubleshooting

### Migrations Not Running

**Problem:** `php spark migrate` shows no output

**Solutions:**
```bash
# Check if migrations path is correct
ls app/Database/Migrations/

# Run with verbose
php spark migrate -v

# Check CodeIgniter Config
cat app/Config/Migrations.php
```

### Foreign Key Constraint Error

**Problem:** `Error: Cannot add or modify row due to foreign key constraint`

**Cause:** Trying to insert book with non-existent case_id

**Solution:**
```bash
# Seed in correct order
php spark db:seed CaseSeeder    # First
php spark db:seed BookSeeder    # Then this (depends on cases)
```

### Database Doesn't Exist

**Problem:** `database not found` error

**Solution:**
```bash
# Create database first
mysql -u root -p -e "CREATE DATABASE book_of_destiny CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Canonical ID Conflicts

**Problem:** `Duplicate entry for unique key canonical_id`

**Cause:** Re-running seeders without fresh database

**Solution:**
```bash
# Fresh install with new data
php spark migrate:refresh --seed
```

---

## 📝 Environment Configuration

### .env Settings for Database

```ini
# Database
database.default.hostname = localhost
database.default.database = book_of_destiny
database.default.username = root
database.default.password = yourpassword
database.default.port = 3306
database.default.charset = utf8mb4

# Migrations
database.migrations.FFMigrations = true
```

---

## 🔄 Workflow Examples

### Local Development Setup

```bash
# Fresh start with demo data
php spark migrate:refresh --seed

# Development server
php spark serve

# Visit: http://localhost:8080/case/list
```

### Production Deployment

```bash
# Run migrations without seeders
php spark migrate

# Production data loaded separately
mysql < backups/production.sql
```

### Testing Database

```bash
# Refresh for each test run
php spark migrate:refresh

# Use test seeders with predictable data
php spark db:seed TestDatabaseSeeder
```

---

## 📚 Additional Resources

- [CodeIgniter Migrations](https://codeigniter.com/user_guide/dbutil/migration.html)
- [CodeIgniter Seeders](https://codeigniter.com/user_guide/database/seeds.html)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

**Status:** ✅ Database Layer Complete  
**Date:** February 7, 2026  
**Next Phase:** Authentication & Authorization System
