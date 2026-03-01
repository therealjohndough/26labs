# SITEGROUND DEPLOYMENT QUICK REFERENCE

## Requirements Met ✓
- PHP 8.2+ compatible
- MySQL 5.7+ compatible  
- Apache mod_rewrite compatible
- Zero external dependencies
- No Node.js/npm required
- No Docker required
- FTP/Git deployment ready

## Installation Flow

### Step 1: Upload Files
```
Use SiteGround File Manager or FTP
Upload to: public_html/26labs (or subdirectory)
Web root should point to: 26labs/public
```

### Step 2: Create Database
```
SiteGround cPanel → MySQL Databases
- Database name: username_26labs
- User: username_26labs_user
- Password: [generate strong password]
- Privileges: ALL
```

### Step 3: Run Installer
```
Visit: https://yourdomain.com/installer/install.php
- Enter database host: localhost
- Enter database name from Step 2
- Enter database user from Step 2
- Enter database password from Step 2
- Enter admin email
- Enter admin password
- Click Install
```

### Step 4: Security
```
DELETE /installer directory immediately!
This is CRITICAL for security.
```

### Step 5: Configure Hosting
```
- cPanel → Addon Domains (if using subdirectory)
- Set document root to 26labs/public
- Or point main domain directly to public directory
- Enable Auto SSL for HTTPS
```

## File Structure on Server

```
public_html/
└── 26labs/
    ├── public/              ← DocumentRoot points here
    ├── app/
    ├── views/
    ├── config/
    ├── database/
    ├── storage/
    ├── vendor/
    ├── .env                 ← Auto-created by installer
    ├── .htaccess           ← Rewrite rules
    ├── composer.json
    └── installer/          ← DELETE THIS AFTER INSTALL!
```

## Environment Variables (.env)

The installer creates this file automatically. Key variables:

```
DB_HOST=localhost
DB_NAME=[from cPanel]
DB_USER=[from cPanel]
DB_PASS=[from cPanel]
APP_ENV=production
APP_URL=https://yourdomain.com
APP_DEBUG=false
```

## Database Credentials Example

If SiteGround prefixes your database:
- Database created as: `username_26labs`
- User created as: `username_26labs_user`
- Add these EXACTLY to installer form

## Troubleshooting

### 404 Errors on All Pages
- Check DocumentRoot points to `/public`
- Verify .htaccess exists in `/public`
- Check mod_rewrite enabled

### Database Connection Failed  
- Verify credentials in .env
- Check user privileges in cPanel
- Test connection in phpMyAdmin

### Blank White Page
- Check error log: cPanel → Error Log
- Enable debug: APP_DEBUG=true in .env
- Ensure PHP 8.2+ (check cPanel PHP Selector)

## Security Checklist

- [ ] .env created with correct credentials
- [ ] /installer directory deleted
- [ ] HTTPS/SSL enabled
- [ ] Admin password is strong
- [ ] File permissions correct (755 dirs, 644 files)
- [ ] storage/ directory writable
- [ ] Database backed up

## After Installation

1. **Login:** Visit /admin/login
2. **Test:** Submit inquiry form
3. **Check:** View inquiry in admin
4. **Customize:** Add case studies, update services
5. **Monitor:** Check storage/logs for errors

## Maintenance

- Weekly backup via cPanel
- Monitor error logs
- Keep PHP updated
- Review and respond to inquiries
- Update content regularly

## Support Resources

- **Detailed guide:** See DEPLOYMENT.md
- **API docs:** See DEVELOPMENT.md
- **Error logs:** storage/logs/ or cPanel Error Log
- **FAQ:** Check README.md troubleshooting section

---

**Ready to deploy!**

Delete notes after reviewing them.
