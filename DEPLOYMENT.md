# Deployment Guide - 26 Labs

Step-by-step guide for deploying to SiteGround shared hosting.

## Prerequisites

- SiteGround account (or any PHP 8.2+ hosting)
- Domain name pointing to hosting
- FTP or SSH access
- MySQL database credentials

## Step 1: Prepare Your Files

### Local Setup

```bash
# Clone or download the project
git clone https://github.com/your-repo/26labs.git
cd 26labs

# Copy env template
cp .env.example .env

# Update .env with your settings
nano .env
```

### Key Settings in .env

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_HOST=localhost
```

## Step 2: Upload to SiteGround

### Using FTP (FileZilla recommended)

1. Open SiteGround File Manager or connect via FTP
2. Navigate to `public_html`
3. Create folder: `26labs` (or use `public_html` directly)
4. Upload all project files

**Important directories:**

- Everything should be in `public_html` or subdirectory
- The `/public` folder contains the web-accessible files
- Keep other files outside public root for security

### Directory Layout on Server

```text
public_html/
├── 26labs/                    # Project root
│   ├── public/               # Web root
│   │   ├── index.php
│   │   ├── .htaccess
│   │   ├── css/
│   │   └── js/
│   ├── app/
│   ├── views/
│   ├── config/
│   ├── database/
│   ├── storage/
│   ├── installer/
│   ├── vendor/
│   ├── .env
│   └── README.md
```

## Step 3: Create MySQL Database

### Via SiteGround cPanel

1. Log in to cPanel
2. Find "MySQL Databases"
3. Create new database:
   - Database name: `username_26labs` (SiteGround prefixes it)
   - Create user: `username_26labs_user`
   - Password: Generate strong password
   - Privileges: All

4. Copy credentials for next step

## Step 4: Point Public Directory

### Option A: Direct to `/public`

If using subdirectory `26labs/`:

1. Go to cPanel → Addon Domains (if needed)
2. Or use File Manager → Set public directory to `26labs/public`

### Option B: Using .htaccess redirect

If you must use `public_html` directly, create `/public_html/.htaccess`:

```apache
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ 26labs/public/index.php [L]
```

## Step 5: Configure File Permissions

SSH into server (or use File Manager):

```bash
cd ~/public_html/26labs

# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Allow storage to be writable
chmod 777 storage
chmod 777 storage/uploads
chmod 777 storage/logs
```

## Step 6: Run Installation Script

### Via Browser

1. Navigate to: `https://yourdomain.com/installer/install.php`
2. Fill in database credentials from Step 3
3. Create admin user (save credentials!)
4. System creates tables and generates admin account

### Via SSH

```bash
cd ~/public_html/26labs
php installer/install.php
```

## Step 7: Delete Installer

**Critical for security!**

```bash
rm -rf ~/public_html/26labs/installer
```

Or delete via File Manager.

## Step 8: Enable HTTPS/SSL

### Auto SSL on SiteGround

1. cPanel → Auto SSL
2. Install free Let's Encrypt SSL
3. Update APP_URL in `.env` to `https://`

### Force HTTPS

Update `/public/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

## Step 9: Configure Email (Optional)

For inquiry notifications, update `.env`:

```env
MAIL_FROM=noreply@yourdomain.com
MAIL_HOST=smtp.siteground.com
MAIL_PORT=465
MAIL_USER=your@email.com
MAIL_PASS=your_password
```

## Step 10: Test Installation

1. Visit `https://yourdomain.com/` - should show homepage
2. Visit `https://yourdomain.com/admin/login` - should show login
3. Submit test inquiry - should appear in admin panel
4. Check database in phpMyAdmin - verify tables exist

## Common Issues & Solutions

### 404 Errors on All Pages

**Problem:** mod_rewrite not working

**Solutions:**

```bash
# Check if enabled in SiteGround (usually is)
# In cPanel: Apache Handlers/PHP Version

# Or update Root Domain:
# cPanel → Addon Domains → Manage

# Check .htaccess syntax:
# Must be at YOUR_WEBROOT/public/.htaccess
```

### Blank White Screen

**Problem:** PHP error or missing files

**Solutions:**

```bash
# Check error logs:
# cPanel → Error Log (watch tail -f)

# Enable debug:
# .env: APP_DEBUG=true

# Check PHP version:
# Must be 8.2+ (SiteGround: PHP Version selector)
```

### Database Connection Failed

**Problem:** Wrong credentials or permissions

**Solutions:**

```bash
# Verify .env:
# Double check DB_HOST, DB_NAME, DB_USER, DB_PASS

# Test connection in phpMyAdmin:
# cPanel → phpMyAdmin → Validate

# Check user permissions:
# cPanel → MySQL Users → User Privileges
# Ensure ALL PRIVILEGES for your database
```

### File Upload Not Working

**Problem:** storage/uploads not writable

**Solutions:**

```bash
# Set permissions:
chmod 777 storage/uploads

# Check ownership: 
chown -R nobody:nobody storage/

# Or via cPanel File Manager:
# Right-click → Change Permissions → 777
```

### Session/Login Issues

**Problem:** Sessions not persisting

**Solutions:**

```bash
# Check session path is writable:
chmod 777 storage/

# Verify session settings in php.ini:
# Create ~/public_html/.user.ini with:
session.save_path = "/home/username/public_html/26labs/storage"

# Clear browser cookies and retry
```

## Performance Tuning

### Enable Caching (SiteGround)

1. cPanel → Site Acceleration
2. Enable Caching:
   - Standard Cache (file-based)
   - Memory Cache (if available)

### Optimize Images

Before uploading images:

```bash
# Use ImageMagick or online tools
convert image.jpg -quality 85 image-optimized.jpg

# Or use SiteGround's Image Optimizer addon
```

### Database Optimization

Via phpMyAdmin:

```sql
-- Optimize all tables
REPAIR TABLE `case_studies`;
OPTIMIZE TABLE `case_studies`;
REPAIR TABLE `inquiries`;
OPTIMIZE TABLE `inquiries`;
```

## Monitoring & Maintenance

### Regular Backups

1. **Database:** cPanel → MySQL Databases → Backup
2. **Files:** cPanel → Backup or use FTP
3. **Schedule:** Weekly automated backups

### Monitor Error Logs

```bash
# SSH access
tail -f ~/public_html/26labs/storage/logs/app.log

# Via cPanel Error Log
# Check for PHP warnings/errors
```

### Update Admin Password

After first login:

1. Access `/admin` panel
2. Use "Change Password" (implement if needed)
3. Or directly in database (hash with PHP):

```php
<?php
echo password_hash('new_password', PASSWORD_ARGON2ID);
?>
```

Then update in MySQL:

```sql
UPDATE users SET password = 'hashed_password' WHERE id = 1;
```

## Updating Code

### Via FTP/File Manager

1. Download latest files
2. Upload via FTP (overwrite)
3. Don't overwrite `.env` or database files

### Via Git (if enabled)

```bash
ssh user@siteground
cd ~/public_html/26labs
git pull origin main
```

## SSL Certificate Management

### Auto Renewal with SiteGround

1. SiteGround handles auto-renewal automatically
2. Monitor expiration in cPanel → SSL/TLS Status
3. Or check with: `openssl s_client -connect yourdomain.com:443`

## Getting Help

- **SiteGround Support:** Direct support ticket
- **PHP Errors:** Check error logs in cPanel
- **Database Issues:** Test in phpMyAdmin
- **Configuration:** Review README.md and .env.example

## Security Checklist

Before going live:

- [ ] Delete /installer directory
- [ ] Set proper file permissions (644 files, 755 folders)
- [ ] Update .env with production values
- [ ] Enable HTTPS/SSL
- [ ] Change default admin password
- [ ] Review .htaccess rules
- [ ] Backup database
- [ ] Test all forms and functionality
- [ ] Monitor error logs

## Known Issues Fixed on First Deploy

The following bugs were discovered and patched during the initial production deploy (2026-03-01). All fixes are committed to `main`.

### 1. Middleware.php duplicate class declarations

**Problem:** `app/Core/Middleware.php` declared `AuthMiddleware` and `GuestMiddleware` inline. After those classes were split into their own files (`AuthMiddleware.php`, `GuestMiddleware.php`), the autoloader loaded both files, causing a fatal "class already declared" error on every request.

**Fix:** Stripped `Middleware.php` down to the abstract base class only. The concrete middleware classes live exclusively in their own files.

**Commit:** `fa152c4`

---

### 2. schema.sql duplicate KEY names

**Problem:** Three tables declared a column as `UNIQUE` (which auto-creates an index) and then also declared an explicit `KEY` with the same name. MySQL 8 rejects this, preventing any tables from being created.

Affected tables and columns:
- `users.email`
- `posts.slug`
- `services.slug`

**Fix:** Removed the redundant explicit `KEY` definitions. The `UNIQUE` constraint already handles indexing.

**Commit:** `38aed22`

---

### 3. public_html symlinked to public/ for Apache DocumentRoot compatibility

**Problem:** SiteGround sets the Apache DocumentRoot to `~/www/domain/public_html/`. The project's web root is `public/`. The FTP upload had placed files directly in `public_html/`, but after switching to a git-based deploy the two directories diverged.

**Fix:** Removed the stale `public_html/` directory and replaced it with a symlink:

```bash
cd ~/www/johnd517.sg-host.com
rm -rf public_html
ln -s public public_html
```

Apache now serves from `public/` via the symlink. Future `git pull` deploys automatically stay in sync — no manual file copying required.

---

**Deployment complete! Your 26 Labs website is live.**

For ongoing support, consult SiteGround documentation or PHP/MySQL resources.
