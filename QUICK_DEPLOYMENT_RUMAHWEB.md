# 🚀 Quick Deployment Guide for Rumahweb

## What You Need to Do After Pulling Changes

### ⚡ Quick Steps (On Your Local Computer)

```bash
# 1. Pull latest code
git pull

# 2. Install PHP dependencies (REQUIRED!)
composer install --no-dev --optimize-autoloader

# 3. Build CSS (only if you modified CSS/JS)
npm install
npm run production
```

### 📤 Upload to Rumahweb

Upload these folders/files via FTP/cPanel:
- ✅ `vendor/` folder (PHP dependencies - **MUST UPLOAD!**)
- ✅ `app/`, `config/`, `database/`, `resources/`, `routes/` folders
- ✅ `public/public_assets/css/tailwind.css` (if built)
- ❌ **DO NOT** upload `.env` file (keep server's existing one!)

### 🌐 On Server (Via Web Browser)

After uploading files, visit these URLs while logged in as admin:

1. **Run Migrations:**
   ```
   https://yourdomain.com/admin/deployment/migrate
   ```
   ⚠️ This adds new database columns - **DO THIS FIRST!**

2. **Clear Caches:**
   ```
   https://yourdomain.com/admin/deployment/clear-cache
   ```
   ✅ This clears old cached files so new code loads

3. **Verify It Works:**
   - Visit your homepage
   - Check admin panel
   - Test new features

### 📋 What Changed Today

- Added hero media fields to database
- Added staff photo upload feature
- Added berita edit/delete features
- Updated secretariat carousel
- Added berita detail modal

All require running migrations!

### 🆘 Troubleshooting

**"Class not found" error?**
→ Make sure `vendor/` folder was uploaded completely

**"Migration failed"?**
→ Check database credentials in `.env` on server

**"Permission denied" for storage?**
→ Set `storage/` and `bootstrap/cache/` to `775` permissions via cPanel

**Need help?**
→ Check `storage/logs/laravel.log` for detailed errors
