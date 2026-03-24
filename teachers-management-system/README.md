# Teacher Management System (TMS)

A comprehensive Laravel-based Teacher Management System with role-based access control, designed for schools and educational institutions.

## Features

- ✅ **Authentication System** - Admin and Teacher login with role-based access control
- ✅ **Teacher Management** - Add, edit, delete, and view teacher profiles
- ✅ **Subject Management** - Create, assign, and manage subjects for teachers
- ✅ **Attendance Tracking** - Mark and manage teacher attendance
- ✅ **Salary Management** - Track salary records with bonus and deduction
- ✅ **User Dashboard** - Admin and Teacher dashboards with statistics
- ✅ **Profile Management** - Teachers can update their own profiles
- ✅ **Responsive Design** - Bootstrap 5 for mobile-friendly interface

## Technology Stack

- **Backend**: Laravel (Latest Version)
- **Frontend**: Blade Templates with Bootstrap 5
- **Database**: MySQL
- **Authentication**: Custom Laravel Authentication
- **Environment**: XAMPP / Windows

## Installation Guide

### Prerequisites

- PHP 8.1 or higher
- MySQL/MariaDB
- Composer
- XAMPP (or any local development environment)
- Git (optional)

### Step-by-Step Installation

#### 1. **Create Database**

Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database:
```sql
CREATE DATABASE teachers_management_system;
```

#### 2. **Clone/Download Project**

Navigate to your XAMPP htdocs folder:
```bash
cd C:\xampp\htdocs\teachers-management-system
```

#### 3. **Install Dependencies**

```bash
composer install
```

#### 4. **Setup Environment File**

Copy `.env.example` to `.env`:
```bash
copy .env.example .env
```

Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teachers_management_system
DB_USERNAME=root
DB_PASSWORD=
```

#### 5. **Generate Application Key**

```bash
php artisan key:generate
```

#### 6. **Run Migrations**

```bash
php artisan migrate
```

#### 7. **Seed Database (Optional)**

This creates sample data including admin and test teacher accounts:
```bash
php artisan migrate --seed
```

#### 8. **Start Development Server**

```bash
php artisan serve
```

The application will be available at: **http://127.0.0.1:8000**

## Login Credentials

After running the seeder, you can use the following credentials:

### Admin Account
- **Email**: `admin@tms.com`
- **Password**: `admin123`

### Teacher Accounts
- **Email**: `john@tms.com` | **Password**: `password123`
- **Email**: `jane@tms.com` | **Password**: `password123`
- **Email**: `mike@tms.com` | **Password**: `password123`

## Database Schema

### Users Table
- id, name, email, password, role, timestamps

### Teachers Table
- id, user_id, phone, address, subject, joining_date, salary, profile_image, timestamps

### Subjects Table
- id, name, code, timestamps

### Subject_Teacher (Pivot Table)
- id, teacher_id, subject_id, timestamps

### Attendance Table
- id, teacher_id, date, status, timestamps

### Salaries Table
- id, teacher_id, basic_salary, bonus, deduction, total_salary, payment_date, timestamps

## Project Structure

```
teachers-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   └── LogoutController.php
│   │   │   ├── TeacherController.php
│   │   │   ├── SubjectController.php
│   │   │   ├── AttendanceController.php
│   │   │   ├── SalaryController.php
│   │   │   ├── DashboardController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── TeacherMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Teacher.php
│       ├── Subject.php
│       ├── Attendance.php
│       └── Salary.php
├── database/
│   ├── migrations/ (All migration files)
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard/
│       │   ├── admin.blade.php
│       │   └── teacher.blade.php
│       ├── teachers/
│       ├── subjects/
│       ├── attendance/
│       ├── salaries/
│       └── profile/
└── routes/
    └── web.php
```

## Module Details

### 1. Authentication
- Login/Register system with email validation
- Role-based authentication (Admin/Teacher)
- Secure password hashing
- Remember me functionality

### 2. Teacher Management (Admin Only)
- **Index**: View all teachers with pagination
- **Create**: Add new teacher with profile image
- **Edit**: Update teacher information
- **Show**: View detailed teacher profile
- **Delete**: Remove teacher from system

### 3. Subject Management (Admin Only)
- **Index**: List all subjects
- **Create/Edit**: Add or modify subjects
- **Assign**: Assign subjects to multiple teachers
- **Show**: View subject and assigned teachers

### 4. Attendance Management (Admin Only)
- **Index**: View attendance with filtering by teacher/date
- **Create**: Mark attendance for teachers
- **Edit**: Update attendance records
- **Delete**: Remove attendance records

### 5. Salary Management (Admin Only)
- **Index**: List all salary records with filtering
- **Create**: Add new salary record with calculations
- **Edit**: Update salary information
- **Show**: View detailed salary breakdown
- **Delete**: Remove salary records

### 6. Teacher Dashboard
- View personal profile
- View assigned subjects
- View attendance history and statistics
- View salary history
- Update own profile

### 7. Admin Dashboard
- Total teachers count
- Total subjects count
- Attendance records overview
- Salary distribution overview
- Today's attendance statistics
- Recent teachers and activities

## API Routes

### Authentication Routes
- `POST /login` - Login
- `POST /register` - Register
- `POST /logout` - Logout

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `RESOURCE /teachers` - Teacher CRUD
- `RESOURCE /subjects` - Subject CRUD
- `RESOURCE /attendance` - Attendance CRUD
- `RESOURCE /salaries` - Salary CRUD

### Teacher Routes
- `GET /teacher/dashboard` - Teacher dashboard
- `GET /profile` - View profile
- `GET /profile/edit` - Edit profile
- `PUT /profile` - Update profile

## Validation Rules

### Teacher Registration
- Name: Required, max 255 characters
- Email: Required, email format, unique
- Password: Required, min 6 characters, confirmed
- Phone: Optional, max 20 characters
- Subject: Optional, max 255 characters
- Joining Date: Optional, valid date
- Salary: Optional, numeric, min 0

### Subject Creation
- Name: Required, unique, max 255 characters
- Code: Required, unique, max 50 characters

### Attendance
- Teacher: Required, exists in database
- Date: Required, valid date
- Status: Required, in [present, absent, leave]

### Salary
- Teacher: Required, exists in database
- Basic Salary: Required, numeric, min 0
- Bonus: Optional, numeric, min 0
- Deduction: Optional, numeric, min 0

## Middleware

- **AdminMiddleware**: Restricts access to admin-only routes
- **TeacherMiddleware**: Restricts access to teacher-only routes
- **Guest**: Redirects authenticated users from login/register
- **Auth**: Requires authentication for protected routes

## File Storage

- Profile images are stored in: `storage/app/public/teachers/`
- Make sure symbolic link exists: `php artisan storage:link`

## Troubleshooting

### Database Connection Error
- Ensure MySQL is running in XAMPP
- Check `.env` file database credentials
- Create the database manually if `migrate` fails

### Migration Errors
- Run `php artisan migrate:reset` to rollback
- Then run `php artisan migrate --seed` again

### Permission Errors
- Run: `php artisan cache:clear`
- Run: `composer dump-autoload`
- Run: `php artisan config:cache`

Storage Link Error
- Run: `php artisan storage:link`

 Features Implemented

✅ User Authentication & Authorization
✅ Admin Dashboard with Statistics
✅ Teacher Management Module
✅ Subject Assignment System
✅ Attendance Tracking System
✅ Salary Management System
✅ Profile Management
✅ Responsive UI with Bootstrap 5
✅ Flash Messages & Error Handling
✅ Data Validation (Server-side)
✅ Pagination for Large Datasets
✅ Search & Filter Functionality
✅ Image Upload Functionality

