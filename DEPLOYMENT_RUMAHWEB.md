# Deployment Guide for Rumahweb Shared Hosting

Since Rumahweb shared hosting typically doesn't allow `composer` or `npm` commands via SSH, you need to prepare files locally first.

## 📋 Step-by-Step Deployment Process

### **Part 1: Prepare on Your Local Machine**

#### 1. Pull Latest Changes
```bash
git pull origin main
# or
git pull origin master
```

#### 2. Install Composer Dependencies Locally
```bash
composer install --no-dev --optimize-autoloader
```
This installs/updates the `vendor/` folder with all PHP dependencies. **This is REQUIRED** - without `vendor/`, your Laravel app won't work!

#### 3. Build Frontend Assets (if CSS/JS files changed)
```bash
npm install
npm run production
```
This compiles Tailwind CSS and generates `public/public_assets/css/tailwind.css`. Only needed if you modified CSS or JavaScript.

#### 4. Prepare Files for Upload
You need to upload these files/folders to your Rumahweb server:

**✅ MUST Upload:**
- `vendor/` folder (PHP dependencies - **CRITICAL!**)
- All changed code files:
  - `app/` folder
  - `config/` folder  
  - `database/migrations/` folder (for new migrations)
  - `resources/views/` folder
  - `routes/` folder
  - `public/` folder (but see notes below)

**✅ Upload if Modified:**
- `public/public_assets/css/tailwind.css` (if you ran `npm run production`)
- `public/js/` (if JavaScript files were built)

**❌ DO NOT Upload:**
- `.env` file (keep server's existing .env - contains database credentials!)
- `storage/logs/*.log` (log files - server will generate these)
- `node_modules/` (not needed on server, very large)
- `.git/` folder (not needed on server)

**⚠️ IMPORTANT:** Make sure to preserve server's `.env` file! It contains your production database credentials.

### **Part 2: Upload to Rumahweb Server**

#### Option A: Using FTP/SFTP
1. Connect to your Rumahweb hosting via FTP (FileZilla, WinSCP, etc.)
2. Upload the prepared files
3. Make sure `vendor/` folder is uploaded completely

#### Option B: Using cPanel File Manager
1. Login to cPanel
2. Use File Manager to upload files
3. Extract ZIP files if you compressed them

### **Part 3: On Server - After Uploading Files**

#### 1. Run Migrations (CRITICAL!)
After uploading files, you MUST run migrations for the new database columns:

**Option A: Use Deployment Helper Routes (Already Added!)**
I've added helper routes in `routes/web.php` that you can access via web browser:

1. **Run Migrations:**
   ```
   https://yourdomain.com/admin/deployment/migrate
   ```
   Visit this URL while logged in as admin to run migrations.

2. **Clear All Caches:**
   ```
   https://yourdomain.com/admin/deployment/clear-cache
   ```

3. **Optimize Application (Production):**
   ```
   https://yourdomain.com/admin/deployment/optimize
   ```

4. **Create Storage Link:**
   ```
   https://yourdomain.com/admin/deployment/storage-link
   ```

**Option B: Use cPanel Cron Jobs**
Set up a cron job to run migrations (not recommended, use Option A or SSH if available).

**Option C: Use Rumahweb's PHP Runner (if available)**
Some hosting provides web-based PHP script execution.

#### 3. Set Permissions via cPanel
1. Login to cPanel → File Manager
2. Right-click on `storage` folder → Change Permissions → Set to `775`
3. Right-click on `bootstrap/cache` folder → Change Permissions → Set to `775`
4. Check `public/images/berita` folder exists and has `775` permissions

#### 4. Verify Storage Link
Check if `public/storage` symlink exists. If not, you may need to:
- Use cPanel's "Symbolic Link" feature, OR
- Create a temporary route to run: `php artisan storage:link`

#### 3. (Optional) Optimize for Production
For better performance on production:

Visit: `https://yourdomain.com/admin/deployment/optimize`

**Note:** Only do this AFTER clearing caches and verifying everything works!

### **Part 4: Verify Deployment**

1. **Check Application Loads**
   - Visit your homepage
   - Check if no errors appear

2. **Test Admin Panel**
   - Login to admin panel
   - Check if berita management works
   - Test image uploads

3. **Check Logs**
   - View `storage/logs/laravel.log` via cPanel
   - Look for any errors

4. **Test New Features**
   - Secretariat carousel
   - Berita modal
   - Staff photo uploads
   - Edit/delete berita

## 🔧 Quick Deployment Script (Create Locally)

Create `deploy-to-rumahweb.sh` on your local machine:

```bash
#!/bin/bash
echo "=== Preparing files for Rumahweb deployment ==="

# 1. Pull latest changes
echo "Pulling latest changes..."
git pull

# 2. Install dependencies
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Build assets
echo "Building frontend assets..."
npm install
npm run production

# 4. Create deployment package (optional)
echo "Creating deployment package..."
tar -czf deployment-$(date +%Y%m%d-%H%M%S).tar.gz \
    --exclude='.git' \
    --exclude='.env' \
    --exclude='node_modules' \
    --exclude='storage/logs/*.log' \
    --exclude='tests' \
    vendor/ \
    public/public_assets/css/tailwind.css \
    app/ \
    config/ \
    database/ \
    resources/ \
    routes/ \
    public/

echo "=== Deployment package ready! ==="
echo "Upload the .tar.gz file to your server and extract it."
```

## 📝 Important Notes for Rumahweb

1. **Environment File**: Never overwrite `.env` on server. Keep server's existing `.env` with production settings.

2. **Storage Permissions**: Rumahweb typically uses `www-data` or similar user. Check with their support if permission issues occur.

3. **PHP Version**: Ensure server has PHP 7.3+ (check `php -v` via SSH or cPanel)

4. **Artisan Access**: Some Rumahweb plans include SSH access. If you have it, use it for migrations and cache clearing.

5. **Database**: Today's migrations:
   - `add_media_fields_to_home_page_contents_table`
   - `add_photo_to_tbm_nama_sekretariat_table`
   
   Make sure these run successfully!

6. **File Upload Size**: Check PHP `upload_max_filesize` and `post_max_size` in cPanel for image uploads.

## 🚨 Troubleshooting

### Issue: "Class not found" errors
**Solution**: Make sure `vendor/` folder is uploaded completely. Check file permissions.

### Issue: "Storage not writable"
**Solution**: Set `storage/` and `bootstrap/cache/` to 775 permissions via cPanel.

### Issue: "Migration failed"
**Solution**: Check database credentials in `.env`. Ensure user has CREATE/ALTER table permissions.

### Issue: "CSS not loading"
**Solution**: Rebuild Tailwind CSS locally (`npm run production`) and upload `public/public_assets/css/tailwind.css`.

### Issue: "Image upload failed"
**Solution**: 
- Check `public/images/berita` folder exists
- Set permissions to 775
- Check PHP upload limits in cPanel

## 📞 Need Help?

If you encounter issues:
1. Check `storage/logs/laravel.log`
2. Contact Rumahweb support for SSH access or PHP configuration
3. Verify all file permissions are correct
