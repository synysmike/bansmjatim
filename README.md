# BAN-PDM Provinsi Jawa Timur

A comprehensive web application for Badan Akreditasi Nasional - Pendidikan Dasar dan Menengah (BAN-PDM) Provinsi Jawa Timur. This Laravel-based system provides a modern, elegant interface for managing organizational content, news, staff information, and administrative tasks.

## 🚀 Features

### Public-Facing Website
- **Home Page Management**: Dynamic hero section with customizable media (images/videos)
- **News Management (Berita)**: Complete CRUD operations with image cropping and preview
- **Staff Directory**: Manage and display staff information
- **YouTube Integration**: Automatically fetch and display latest videos from YouTube channel
- **Responsive Design**: Modern UI built with Tailwind CSS and Bootstrap 5
- **Elegant Typography**: Professional font pairing (Playfair Display + Source Sans Pro)

### Admin Panel
- **Role & Permission Management**: Full user, role, and permission management using Spatie Laravel Permission
- **Content Management**: Easy-to-use interface for managing all website content
- **DataTables Integration**: Server-side processing for efficient data handling
- **Image Cropping**: Built-in image cropping with Cropper.js for news and content
- **Modern Dashboard**: Clean, elegant admin interface with Bootstrap 5

### Additional Features
- **Attendance System (Daftar Hadir)**: Track visitor attendance
- **Guest Book (Buku Tamu)**: Manage guest registrations
- **PDF Export**: Generate PDF documents using DomPDF and mPDF
- **Configuration Management**: Centralized configuration system

## 🛠️ Tech Stack

- **Framework**: Laravel 8.x
- **PHP**: ^7.3
- **Frontend**: 
  - Bootstrap 5.3
  - Tailwind CSS 2.2
  - Font Awesome 6.1
  - Google Fonts (Playfair Display, Source Sans Pro, Inter)
- **JavaScript Libraries**:
  - jQuery
  - DataTables (Yajra Laravel DataTables)
  - Select2
  - Cropper.js
- **Key Packages**:
  - Spatie Laravel Permission (^5.10)
  - Yajra Laravel DataTables (^9.21)
  - Laravel Sanctum (^2.15)
  - DomPDF (^2.2)
  - mPDF (^2.1)

## 📋 Requirements

- PHP >= 7.3
- Composer
- Node.js & npm (for frontend assets)
- MySQL/MariaDB
- Web server (Apache/Nginx)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ban-pdm-jatim
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure `.env` file**
   - Set database credentials
   - Configure app URL and other settings

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets**
   ```bash
   npm run production
   ```

9. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

10. **Clear and cache configuration**
    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan view:clear
    php artisan route:clear
    ```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   │   ├── Admin/            # Admin panel controllers
│   │   └── ...
│   └── Models/               # Eloquent models
├── resources/
│   ├── views/
│   │   ├── ad_layout/        # Admin layout templates
│   │   ├── admin/            # Admin panel views
│   │   ├── public/           # Public-facing views
│   │   └── ...
│   └── css/                  # Tailwind CSS source
├── public/
│   └── public_assets/        # Compiled assets
├── routes/
│   └── web.php               # Web routes
└── database/
    ├── migrations/           # Database migrations
    └── seeders/             # Database seeders
```

## 🎨 Design Features

- **Modern & Elegant UI**: Clean, professional design with smooth animations
- **Responsive Layout**: Fully responsive across all devices
- **Typography**: Elegant font pairing for enhanced readability
- **Color Scheme**: Modern gradient backgrounds and consistent color palette
- **User Experience**: Intuitive navigation and user-friendly interfaces

## 🔐 Security

- Laravel's built-in security features
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection
- Role-based access control (RBAC)

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Creator

**Ir Teguh Solution**

Developed with ❤️ for BAN-PDM Provinsi Jawa Timur

---

## 📞 Support

For support, please contact the development team or create an issue in the repository.

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- Tailwind CSS
- Spatie for Laravel Permission package
- Yajra for Laravel DataTables package
- All contributors and open-source libraries used in this project
