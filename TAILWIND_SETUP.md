# Tailwind CSS Setup Instructions

This document explains how to set up and build Tailwind CSS for the public home page.

## Installation Steps

1. **Install Dependencies**
   ```bash
   npm install
   ```
   This will install Tailwind CSS, PostCSS, Autoprefixer, and other dependencies defined in `package.json`.

2. **Build Tailwind CSS**
   
   For development (with watch mode):
   ```bash
   npm run watch
   ```
   
   For production build:
   ```bash
   npm run production
   ```
   
   For one-time development build:
   ```bash
   npm run dev
   ```

## File Structure

- **Tailwind Config**: `tailwind.config.js` - Configuration for Tailwind CSS
- **PostCSS Config**: `postcss.config.js` - PostCSS configuration
- **Source CSS**: `resources/css/tailwind.css` - Tailwind source file with custom styles
- **Compiled CSS**: `public/public_assets/css/tailwind.css` - Compiled output (generated after build)
- **Template**: `resources/views/public/home.blade.php` - Blade template using Tailwind classes

## Custom Styles

Custom styles and animations are defined in `resources/css/tailwind.css`:
- Flip card animations
- Fade in animations (Up, Down, Left)
- Video overlay styles
- Sticky header styles

## Notes

- The compiled CSS will be output to `public/public_assets/css/tailwind.css`
- Make sure to run `npm run production` before deploying to production
- The template uses Tailwind utility classes instead of the previous CSS framework
- All JavaScript files remain unchanged for compatibility

## Troubleshooting

If you encounter issues:

1. Make sure Node.js and npm are installed
2. Delete `node_modules` and `package-lock.json`, then run `npm install` again
3. Check that the build output appears in `public/public_assets/css/tailwind.css`
4. Clear Laravel cache: `php artisan cache:clear` and `php artisan view:clear`
