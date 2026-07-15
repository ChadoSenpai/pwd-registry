# PWD Registry System

A comprehensive web-based registry system for managing Persons with Disabilities (PWD) applications, registrations, and ID card issuance. Built with Laravel 12, this system provides a complete solution for government agencies and organizations to track, manage, and process PWD registrations efficiently.

## Features

### Core Functionality
- **PWD Registration Management**: Complete registrant profiles with personal information, disability classification, and contact details
- **Application Workflow**: Support for new applications, renewals, replacements, and information updates
- **Document Management**: Upload and verification of supporting documents for each application
- **Geographic Integration**: Hierarchical location selection (Province → Municipality → Barangay) with cascading dropdowns
- **Card Issuance Tracking**: PWD ID card issuance, expiry monitoring, and status management (active, expired, suspended, lost)
- **User Authentication**: Secure login system with role-based access control
- **Two-Factor Authentication**: Optional Google 2FA for enhanced security
- **Application Review Process**: Staff review workflow with approval/rejection capabilities and notes

### Administrative Features
- **User Management**: Admin and staff roles with appropriate permissions
- **Disability Type Classification**: Configurable disability types with descriptions
- **Geographic Data Management**: Support for provinces, municipalities, and barangays
- **Application Archive**: Soft delete functionality for maintaining application history
- **Audit Trail**: Track who reviewed applications and verified documents

## Tech Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP**: 8.2+
- **Database**: MySQL/PostgreSQL/SQLite (configurable)
- **Authentication**: Laravel's built-in authentication system
- **Queue System**: Laravel Queues for background job processing
- **2FA**: Google2FA Laravel package

### Frontend
- **UI Framework**: AdminLTE 4.1.0
- **CSS Framework**: Bootstrap 5.3
- **Styling**: TailwindCSS 4.0
- **Build Tool**: Vite 7.0
- **Icons**: AdminLTE icon set

### Development Tools
- **Testing**: PHPUnit 11.5
- **Code Style**: Laravel Pint
- **Logging**: Laravel Pail
- **Process Management**: Concurrently for running multiple dev servers

## Database Schema

The system uses a comprehensive database schema with the following main entities:

- **Users**: System administrators and staff with authentication and 2FA
- **PWD Registrants**: Complete profiles of registered persons with disabilities
- **PWD Applications**: Application tracking for new, renewal, replacement, and update requests
- **Application Documents**: Supporting document uploads and verification
- **Geographic Data**: Provinces, municipalities, and barangays hierarchy
- **Disability Types**: Classification system for different disability categories

For detailed schema information, see [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md)

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Database (MySQL, PostgreSQL, or SQLite)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd pwd-registry
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pwd_registry
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

### Quick Setup Script
Use the composer setup script for automated installation:
```bash
composer run setup
```

This will install dependencies, configure environment, run migrations, and build assets.

## Development

### Running Development Environment
The project includes a convenient script to run all development services:
```bash
composer run dev
```

This starts:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite asset builder

### Running Tests
```bash
composer run test
```

### Code Formatting
```bash
./vendor/bin/pint
```

## Application Workflow

1. **Registration**: PWD registrants create profiles with personal information and disability details
2. **Application Submission**: Submit applications for new ID cards, renewals, or replacements
3. **Document Upload**: Attach required supporting documents to applications
4. **Staff Review**: Administrators review applications and verify documents
5. **Approval/Rejection**: Applications are approved or rejected with notes
6. **Card Issuance**: Approved applications receive PWD ID cards with tracking

## Security Features

- Password hashing using Laravel's bcrypt
- Email verification support
- Session management with IP and user agent tracking
- Google 2FA for enhanced authentication
- Role-based access control
- SQL injection protection via Eloquent ORM
- CSRF protection on all forms
- File upload validation and security

## Geographic Coverage

Currently configured for Laguna Province with 20 municipalities and their respective barangays. The system can be extended to support additional provinces by adding geographic data to the database.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues, questions, or contributions, please refer to the project's issue tracker and contribution guidelines.
