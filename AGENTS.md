# AGENTS.md

This file contains guidelines and commands for agentic coding agents working in this Laravel repository.

## Build, Lint, and Test Commands

### PHP/Laravel Commands
- **Install dependencies**: `composer install`
- **Run all tests**: `composer test` or `php artisan test`
- **Run single test file**: `php artisan test tests/Feature/ExampleTest.php`
- **Run single test method**: `php artisan test --filter "the application returns a successful response"`
- **Code formatting**: `./vendor/bin/pint`
- **Start development server**: `php artisan serve`
- **Database migrations**: `php artisan migrate`
- **Clear caches**: `php artisan config:clear && php artisan cache:clear && php artisan view:clear`

### Frontend Commands
- **Install frontend dependencies**: `npm install`
- **Build assets for production**: `npm run build`
- **Start development server**: `npm run dev`
- **Watch for changes**: `npm run dev` (with hot reload)

### Full Development Environment
- **Start all services**: `composer dev` (runs PHP server, queue worker, logs, and Vite)

## Code Style Guidelines

### PHP Code Style
- **Formatter**: Uses Laravel Pint (`./vendor/bin/pint`)
- **Indentation**: 4 spaces (configured in .editorconfig)
- **Line endings**: LF (Unix style)
- **Charset**: UTF-8
- **Trailing whitespace**: Must be trimmed
- **Final newline**: Required

### Naming Conventions
- **Classes**: PascalCase (e.g., `UserController`, `UserService`)
- **Methods**: camelCase (e.g., `getUserById`, `createUser`)
- **Variables**: camelCase (e.g., `$userId`, `$userName`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `MAX_RETRY_ATTEMPTS`)
- **Database tables**: snake_case (e.g., `user_profiles`, `order_items`)
- **Files**: 
  - Classes: PascalCase matching class name
  - Views: kebab-case (e.g., `user-profile.blade.php`)
  - Config files: snake_case (e.g., `app.php`)

### Import Organization
- **Order**: 
  1. PHP built-in classes/functions
  2. Framework classes (Illuminate\*)
  3. Third-party packages
  4. Application classes (App\*)
- **Grouping**: Separate groups with empty lines
- **Alphabetical**: Within each group, sort alphabetically

### Type Hints and Documentation
- **Strict typing**: Always declare `declare(strict_types=1);` at top of files
- **Return types**: Always declare return types for methods
- **Parameter types**: Always declare parameter types
- **PHPDoc**: Use for complex documentation, especially for:
  - Class properties with `@var`
  - Method parameters with complex types
  - Array shapes using `@param array{key: type} $param`

### Error Handling
- **Exceptions**: Use specific exception types from `Illuminate` or custom exceptions
- **Validation**: Use Laravel's built-in validation in controllers
- **Logging**: Use `Log` facade with appropriate levels (debug, info, warning, error)
- **HTTP responses**: Use proper status codes and response formats

### Laravel-Specific Guidelines

#### Models
- **Mass assignment**: Use `$fillable` property, never `$guarded`
- **Casts**: Use modern `casts()` method returning array
- **Relationships**: Define with proper return types (`HasMany`, `BelongsTo`, etc.)
- **Factories**: Use for testing and database seeding

#### Controllers
- **Single responsibility**: One controller per resource/concept
- **Dependency injection**: Use constructor injection for services
- **Request validation**: Use Form Request classes for complex validation
- **Response formatting**: Use API resources for consistent JSON responses

#### Migrations
- **Naming**: Descriptive, timestamped automatically
- **Foreign keys**: Use `constrained()` method for readability
- **Indexes**: Add indexes for frequently queried columns
- **Rollback**: Ensure migrations can be safely rolled back

#### Testing
- **Framework**: Uses Pest testing framework
- **Structure**: 
  - Unit tests for business logic
  - Feature tests for HTTP endpoints
  - Use descriptive test names
- **Assertions**: Use Pest's `expect()` syntax for readability
- **Database**: Use in-memory SQLite for tests (configured in phpunit.xml)

### Frontend Guidelines

#### JavaScript/TypeScript
- **Module system**: ES modules
- **Build tool**: Vite with Laravel plugin
- **CSS framework**: Tailwind CSS v4
- **File organization**: 
  - Components in `resources/js/components/`
  - Utilities in `resources/js/utils/`
  - Styles in `resources/css/`

#### Blade Templates
- **Indentation**: 4 spaces
- **Directives**: Use proper Blade directive syntax
- **Components**: Prefer Blade components over includes
- **Security**: Always escape output, use `{!! !!}` only for trusted HTML

### Security Best Practices
- **Input validation**: Never trust user input
- **SQL injection**: Use Eloquent ORM or parameterized queries
- **XSS protection**: Use Laravel's built-in CSRF protection
- **Authentication**: Use Laravel's built-in auth system
- **Authorization**: Implement policies and gates
- **Environment variables**: Never commit `.env` file

### Git Workflow
- **Branch naming**: Use descriptive names (feature/user-auth, bug/fix-login)
- **Commit messages**: Use conventional commits (feat:, fix:, docs:, etc.)
- **File permissions**: Ensure executable permissions only for scripts

### Performance Considerations
- **Eager loading**: Use `with()` to prevent N+1 queries
- **Caching**: Implement appropriate caching strategies
- **Database indexes**: Add indexes for query optimization
- **Asset optimization**: Use Vite's build optimization

## Development Workflow
1. Run `composer install` and `npm install` after cloning
2. Copy `.env.example` to `.env` and configure
3. Run `php artisan key:generate`
4. Run `php artisan migrate`
5. Start development with `composer dev`
6. Run tests before committing: `composer test`
7. Format code before committing: `./vendor/bin/pint`

## Testing Specific Commands
- **Run all tests**: `php artisan test`
- **Run coverage**: `php artisan test --coverage`
- **Run specific test suite**: `php artisan test --testsuite=Feature`
- **Run with verbose output**: `php artisan test --verbose`
- **Run failing tests only**: `php artisan test --filter-failing`

## Common Issues and Solutions
- **Class not found**: Run `composer dump-autoload`
- **View cache**: Clear with `php artisan view:clear`
- **Config cache**: Clear with `php artisan config:clear`
- **Route cache**: Clear with `php artisan route:clear`
- **Permission issues**: Ensure storage directory is writable