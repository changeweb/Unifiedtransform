# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Unifiedtransform is an open-source school management and accounting software built with Laravel 12.x and Bootstrap 5.x (5.3.0). The application manages academic operations including sessions, semesters, classes, sections, courses, students, teachers, attendance, exams, grading, and more.

**Version 2.x** was built from scratch with a redesigned UI and internal workflow. This is the active development branch.

## Development Environment

### Docker Setup (Recommended)

The project uses Docker with:
- Nginx (webserver)
- PHP 7.4 (app container)
- MySQL 5.7 (db container)

**Setup Commands:**
```bash
# Clone and setup
cp .env.example .env
docker-compose up -d

# Database setup (inside db container)
docker exec -it db sh
mysql -u root -p
# Password: your_mysql_root_password (from docker-compose.yml)
# Then run:
GRANT ALL ON unifiedtransform.* TO 'unifiedtransform'@'%' IDENTIFIED BY 'secret';
FLUSH PRIVILEGES;
EXIT;

# Application setup (inside app container)
docker exec -it app sh
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate:fresh --seed
```

**IMPORTANT:** Create a `purify` folder in `storage/app/` directory before running setup.

**Access the application:** http://localhost:8080

**Default admin credentials:**
- Email: admin@ut.com
- Password: password

### Common Commands

**Running inside the app container:**
```bash
docker exec -it app sh
```

**Testing:**
```bash
# Inside app container
php artisan test
```

**Database operations:**
```bash
php artisan migrate:fresh --seed  # Reset and seed database
php artisan migrate               # Run pending migrations
php artisan db:seed              # Seed database
```

**Frontend assets:**
```bash
npm run dev          # Development build
npm run watch        # Watch for changes
npm run production   # Production build
```

**Cache operations:**
```bash
php artisan config:cache   # Cache configuration
php artisan config:clear   # Clear config cache
php artisan cache:clear    # Clear application cache
```

## Architecture

### Repository Pattern

The application implements the **Repository Pattern** with dependency injection:

1. **Interfaces** (`app/Interfaces/`) - Define contracts for data operations
2. **Repositories** (`app/Repositories/`) - Implement the interfaces
3. **Service Providers** (`app/Providers/`) - Bind interfaces to implementations
4. **Controllers** (`app/Http/Controllers/`) - Inject interface dependencies

**Example flow:**
```
Controller → Interface → Repository → Model
```

Each service provider (e.g., `AcademicSettingServiceProvider`) binds an interface to its repository implementation:
```php
$this->app->bind(AcademicSettingInterface::class, AcademicSettingRepository::class);
```

Controllers receive the interface via dependency injection and work with the repository through the interface contract.

### Core Architecture Components

**Models** (`app/Models/`):
- Core entities: SchoolSession, Semester, SchoolClass, Section, Course
- Academic: Assignment, Attendance, Exam, ExamRule, Mark, FinalMark
- Grading: GradingSystem, GradeRule
- Management: AssignedTeacher, Notice, Event, Routine, Promotion
- User relationships: StudentAcademicInfo, User (with Spatie Laravel Permission)

**Traits** (`app/Traits/`):
- `SchoolSession` - Critical trait for session management
  - `getSchoolCurrentSession()` checks for browsing session or returns latest session
  - Used across multiple controllers to determine active academic session

**Middleware**:
Located in `app/Http/Middleware/`

**Routes** (`routes/web.php`):
- All authenticated routes under `auth` middleware
- School-specific routes prefixed with `school` and named with `school.` prefix
- Role-based access control via Spatie Laravel Permission

**Views** (`resources/views/`):
Organized by feature: academics, assignments, attendances, classes, courses, events, exams, marks, notices, promotions, routines, sections, students, syllabi, teachers

### Session Browsing System

The application has a unique **session browsing** feature that allows viewing previous academic sessions in read-only mode. The `SchoolSession` trait manages this:
- Active session comes from either `session('browse_session_id')` or the latest session
- When browsing previous sessions, the system operates in read-only mode
- Controllers must use `getSchoolCurrentSession()` to respect the browsing context

### Permissions and Roles

Uses **Spatie Laravel Permission** package for role-based access control. Permissions are seeded via `PermissionSeeder`.

### HTML Purification

Uses **Stevebauman/Purify** package for sanitizing HTML input. Configuration handled by `PurifySetupProvider`. A `purify` folder must exist in `storage/app/`.

## Database

**Connection:** MySQL
- Default database: `unifiedtransform`
- Default user: `unifiedtransform`
- Default password: `secret`

**Seeding:**
The `DatabaseSeeder` calls:
- `AcademicSettingSeeder`
- `PermissionSeeder`

Additional seeders exist for all major entities but must be called manually or added to DatabaseSeeder.

**Testing:** Uses SQLite in-memory database (configured in phpunit.xml)

## Key Workflows

### Academic Setup Flow (Admin Role)
1. Create School Session
2. Create Semester(s) within session
3. Create Classes
4. Create Sections for each class
5. Create Courses and assign to semester/class
6. Set attendance type (by section or by course)
7. Add Teachers
8. Assign Teachers to semester/class/section/course
9. Add Students and assign to class/section
10. Create Grading Systems for each class/semester
11. Add Grading System Rules

### Teaching Flow (Teacher Role)
1. View assigned courses
2. Take attendance (by section or course)
3. Upload syllabus
4. Create assignments
5. Create exams and exam rules
6. Give marks
7. Submit final marks (when submission window is open)

### Student Flow
1. View attendance
2. View assigned courses
3. View marks and grades
4. View and download syllabus
5. View and download assignments
6. View routine

## Important Notes

- **Final marks submission** is controlled by admin via Academic Settings (default: disallowed)
- **Student promotion** requires creating a new session with classes/sections first
- **Attendance type** (by section or by course) should remain consistent within a semester
- All rich text editing uses HTML purification for security
- The application supports browsing historical sessions in read-only mode

## Testing

Test structure:
- `tests/Feature/` - Feature tests
- `tests/Unit/` - Unit tests
- `tests/TestCase.php` - Base test case with `CreatesApplication` trait

Run tests inside the app container:
```bash
php artisan test
```

## Features Pending Migration from v1.x

These features exist in v1.x and will be added to v2.x:
- Stripe payment integration
- Messaging system
- Library management
- Income and expense management
- Mass student/teacher import/export
- Report printing
- Certificate management
- Internationalization (Spanish, etc.)
