# CI4 Shield Starter

A modern starter template for CodeIgniter 4 with Shield authentication, Bootstrap 5, and jQuery.

## Features

- **Authentication System**: User registration with email verification, login/logout, password reset, and remember me option
- **User Management**: Regular users and admin roles, profile management, account activation/deactivation
- **Admin Dashboard**: User management (view, edit, delete users, manage permissions)
- **Modern UI**: Clean, responsive design with Bootstrap 5 and jQuery
- **Security**: CSRF protection, form validation, secure session handling, rate limiting

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL/MariaDB
- Apache/Nginx web server

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/sdvventures/ci4-shield-starter.git
cd ci4-shield-starter
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the example environment file and update it with your configuration:

```bash
cp .env.example .env
```

Edit the `.env` file and update the following:

- `app.baseURL` - Set to your application's base URL
- Database settings
- Email settings (for email verification and password reset)
- Any other settings you need to customize

### 4. Set Up Database

Create a database for your application, then run the migrations:

```bash
php spark migrate
```

### 5. Set Up Shield

Run the Shield setup command:

```bash
php spark shield:setup
```

### 6. Create Admin User

Run the database seeder to create an admin user:

```bash
php spark db:seed AdminSeeder
```

Default admin credentials:
- Email: admin@example.com
- Password: Admin123!

### 7. Run the Application

```bash
php spark serve
```

Visit `http://localhost:8080` in your browser.

## Project Structure

```
app/
├── Controllers/
│   ├── Home.php
│   ├── Account.php (user settings)
│   ├── Admin/
│   │   ├── Dashboard.php
│   │   └── Users.php (user management)
├── Views/
│   ├── layouts/
│   │   ├── main.php (base layout)
│   │   ├── auth.php (auth layout)
│   │   └── admin.php (admin layout)
│   ├── partials/
│   │   ├── header.php
│   │   ├── footer.php
│   │   ├── admin_sidebar.php
│   │   └── alerts.php
│   ├── pages/
│   │   ├── home/
│   │   │   └── index.php (landing page)
│   │   ├── account/
│   │   │   └── settings.php
│   │   └── admin/
│   │       ├── dashboard.php
│   │       └── users/
│   │           ├── index.php
│   │           ├── create.php
│   │           └── edit.php
public/
├── assets/
│   ├── css/
│   │   └── custom.css
│   ├── js/
│   │   └── custom.js
│   └── images/
```

## Configuration

### Email Settings

Email settings are managed via the `.env` file. The application is configured to use SMTP by default, but you can change this in the Email config.

### Database Settings

Database settings are also managed via the `.env` file. The application is configured to use MySQL/MariaDB by default.

### Authentication Settings

Shield authentication settings can be customized in the `.env` file. You can enable/disable registration, configure password requirements, and more.

## Customization

### Styling

The application uses Bootstrap 5 for styling. You can customize the look and feel by editing the `public/assets/css/custom.css` file.

### JavaScript

Custom JavaScript functionality is in the `public/assets/js/custom.js` file. This includes form validation, toast notifications, and more.

### Views

All views are located in the `app/Views` directory. You can customize the layouts, partials, and pages as needed.

## Security Features

- CSRF protection on all forms
- Input validation and sanitization
- Rate limiting on auth endpoints
- Secure session handling
- Password hashing with bcrypt

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
