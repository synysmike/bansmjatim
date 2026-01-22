# Pre-Pull Checklist - Before Pulling Updates on Server

## Commands to Run BEFORE `git pull`

### 1. Check Git Status
```bash
git status
```
**Purpose**: See if there are any uncommitted local changes that might conflict with incoming updates.

**If you see modified files:**
- Review them: `git diff`
- Either commit them: `git add . && git commit -m "Local changes"`
- Or stash them: `git stash` (you can restore later with `git stash pop`)

### 2. Check Current Migration Status
```bash
php artisan migrate:status
```
**Purpose**: Know which migrations have already been run. This helps you understand what database changes are already in place.

**Output shows:**
- ✅ Migrations that have run
- ⏳ Migrations that haven't run yet

### 3. (Optional) Backup Database
```bash
# If you have mysqldump access
mysqldump -u your_db_user -p your_db_name > backup_$(date +%Y%m%d_%H%M%S).sql
```
**Purpose**: Safety backup before pulling updates that might include new migrations.

**Alternative**: Use cPanel's backup feature or phpMyAdmin export.

### 4. Check Current Branch
```bash
git branch
```
**Purpose**: Make sure you're on the correct branch (usually `main` or `master`).

### 5. View Recent Commits (Optional)
```bash
git log --oneline -10
```
**Purpose**: See what commits are currently on the server.

---

## Quick Pre-Pull Command Sequence

```bash
# Navigate to your project directory
cd /path/to/your/project

# Check status
echo "=== Git Status ==="
git status

# Check migrations
echo "=== Migration Status ==="
php artisan migrate:status

# Check branch
echo "=== Current Branch ==="
git branch

# View recent commits
echo "=== Recent Commits ==="
git log --oneline -5
```

---

## After Running Pre-Pull Checks

Once you've verified:
1. ✅ No conflicting local changes
2. ✅ You're on the correct branch
3. ✅ You know current migration status
4. ✅ (Optional) Database is backed up

**Then you can safely pull:**
```bash
git pull origin main
# or
git pull origin master
```

---

## After Pulling - Run These Commands

See `DEPLOYMENT_CHECKLIST.md` for the full post-pull checklist. Quick version:

```bash
# Run new migrations (if any)
php artisan migrate --force

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or use the web helper route:
# Visit: https://yourdomain.com/admin/deployment/clear-cache
```

---

## Important Notes

- **Never pull if you have uncommitted changes** that you want to keep (unless you stash them)
- **Always check migration status** before pulling to avoid surprises
- **Backup database** if you're unsure about new migrations
- **On shared hosting**, you might not have SSH access - use cPanel File Manager and web helper routes instead
