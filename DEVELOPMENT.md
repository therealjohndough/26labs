# 26 Labs - API & CMS Documentation

Complete documentation for developers integrating with 26 Labs.

## API Endpoints

### Public API

All endpoints are relative to domain root.

#### Homepage

```
GET /
```

Returns rendered homepage with all sections.

**Includes:**
- Case studies (6 latest)
- Blog posts (3 latest)  
- Services listing
- Statistics
- Navigation
- Contact form

---

#### Project Inquiry

```
POST /inquiry
Content-Type: application/x-www-form-urlencoded
```

Submit project inquiry from contact form.

**Required Parameters:**
- `name` (string, 2-100 characters)
- `email` (string, valid email)
- `message` (string, 10-2000 characters)
- `_csrf_token` (string, CSRF token)

**Optional Parameters:**
- `company` (string, 0-255 characters)
- `services[]` (array of strings)
- `budget` (string)

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Thank you for your inquiry. We will be in touch soon!"
}
```

**Response (422 Unprocessable Entity):**
```json
{
  "errors": {
    "name": ["Name is required."],
    "email": ["Email must be a valid email."],
    "message": ["Message must be at least 10 characters."]
  }
}
```

**Response (403 Forbidden):**
```json
{
  "error": "Security token invalid"
}
```

---

### Admin API (Authenticated)

All admin endpoints require valid session (login first).

#### Authentication

```
GET /admin/login
```
Shows login form.

```
POST /admin/login
Content-Type: application/x-www-form-urlencoded
```

Authenticate user.

**Parameters:**
- `email` (string)
- `password` (string)
- `_csrf_token` (string)

**Success:** Redirect to /admin/dashboard

**Failure:** Redirect back to /admin/login with error

```
GET /admin/logout
```

Logout and clear session.

---

#### Dashboard

```
GET /admin/dashboard
```

Main admin panel showing:
- Unread inquiries count
- Total case studies
- Total posts
- Recent inquiries list

---

#### Case Studies

**List**
```
GET /admin/case-studies
```

Shows all case studies (paginated, 50 per page).

**Create Form**
```
GET /admin/case-studies/create
```

Shows creation form.

**Create**
```
POST /admin/case-studies
Content-Type: application/x-www-form-urlencoded
```

**Parameters:**
- `title` (string, required)
- `client_name` (string, required)
- `description` (text, required)
- `tags` (string, comma-separated)
- `services_provided` (text)
- `year` (int, default current year)
- `_csrf_token` (string)

**Edit Form**
```
GET /admin/case-studies/{id}/edit
```

Shows edit form with current data.

**Update**
```
POST /admin/case-studies/{id}/update
```

Same parameters as create.

**Delete**
```
POST /admin/case-studies/{id}/delete
```

Soft delete (marks deleted_at timestamp).

---

#### Project Inquiries

**List**
```
GET /admin/inquiries
```

Shows all inquiries, newest first, with read status.

**View**
```
GET /admin/inquiries/{id}
```

Shows full inquiry detail, marks as read.

**Delete**
```
POST /admin/inquiries/{id}/delete
```

Permanently deletes inquiry.

---

## CMS Data Models

### User

```php
[
    'id' => int,
    'email' => string,
    'password' => string (hashed),
    'name' => string,
    'remember_token' => string|null,
    'remember_token_expiry' => datetime|null,
    'created_at' => datetime,
    'updated_at' => datetime,
    'deleted_at' => datetime|null
]
```

### CaseStudy

```php
[
    'id' => int,
    'title' => string,
    'client_name' => string,
    'description' => text,
    'tags' => string (comma-separated),
    'hero_image' => string (path),
    'gallery_images' => text (JSON or comma-separated paths),
    'services_provided' => string,
    'year' => int,
    'created_at' => datetime,
    'updated_at' => datetime,
    'deleted_at' => datetime|null
]
```

### Post

```php
[
    'id' => int,
    'title' => string,
    'slug' => string (unique),
    'content' => text,
    'featured_image' => string (path),
    'publish_date' => datetime,
    'created_at' => datetime,
    'updated_at' => datetime,
    'deleted_at' => datetime|null
]
```

### Service

```php
[
    'id' => int,
    'title' => string,
    'description' => text,
    'bullets' => text (newline-separated),
    'order_index' => int,
    'created_at' => datetime,
    'updated_at' => datetime,
    'deleted_at' => datetime|null
]
```

### Stat

```php
[
    'id' => int,
    'label' => string,
    'value' => string,
    'order_index' => int,
    'created_at' => datetime,
    'updated_at' => datetime,
    'deleted_at' => datetime|null
]
```

### Inquiry

```php
[
    'id' => int,
    'name' => string,
    'company' => string|null,
    'email' => string,
    'message' => text,
    'services' => string (comma-separated),
    'budget' => string,
    'ip_address' => string,
    'user_agent' => text,
    'read_at' => datetime|null,
    'created_at' => datetime
]
```

---

## Database Queries

### Access Database

```php
use App\Core\Database;
use App\Models\CaseStudy;

// Get connection
$db = Database::getConnection();

// Use prepared statement
$stmt = $db->prepare('SELECT * FROM case_studies WHERE year = ?');
$stmt->execute([2025]);
$results = $stmt->fetchAll();
```

### Model Methods

#### CaseStudy

```php
// Get all
$all = CaseStudy::all(); // 50 limit

// Get latest (homepage)
$latest = CaseStudy::latest(6);

// Find by ID
$case = CaseStudy::find(1);

// Create
$created = CaseStudy::create([
    'title' => 'New Project',
    'client_name' => 'Client Name',
    'description' => 'Description...',
    'year' => 2025
]);

// Update
$updated = CaseStudy::update(1, [
    'title' => 'Updated Title'
]);

// Delete (soft delete)
CaseStudy::delete(1);
```

#### Post

```php
// Get all posts
$all = Post::all();

// Get latest (homepage - 3 latest)
$latest = Post::latest(3);

// Find by ID
$post = Post::find(1);

// Find by slug
$post = Post::findBySlug('my-article');

// Create
$created = Post::create([
    'title' => 'Blog Post',
    'slug' => 'blog-post',
    'content' => 'Content...',
    'publish_date' => date('Y-m-d H:i:s')
]);

// Update
PostPost::update(1, ['title' => 'New Title']);

// Delete
Post::delete(1);
```

#### Service

```php
// Get all (ordered by order_index)
$services = Service::all();

// Find by ID
$service = Service::find(1);

// Create
$created = Service::create([
    'title' => 'Brand Strategy',
    'description' => 'Description...',
    'order_index' => 1
]);

// Update
Service::update(1, ['description' => 'New desc']);

// Delete
Service::delete(1);
```

#### Stat

```php
// Get all (ordered by order_index)
$stats = Stat::all();

// Find by ID
$stat = Stat::find(1);

// Create
Stat::create(['label' => 'Projects', 'value' => '100+']);

// Update
Stat::update(1, ['value' => '150+']);

// Delete
Stat::delete(1);
```

#### Inquiry

```php
// Get all inquiries
$all = Inquiry::all(100); // limit

// Find by ID
$inquiry = Inquiry::find(1);

// Create
Inquiry::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'message' => 'Interested in...'
]);

// Mark as read
Inquiry::markAsRead(1);

// Count unread
$unread = Inquiry::countUnread();

// Delete
Inquiry::delete(1);
```

#### User

```php
// Find by ID
$user = User::find(1);

// Find by email
$user = User::findByEmail('admin@example.com');

// Check if exists
$exists = User::exists('admin@example.com');

// Create
User::create('admin@example.com', 'password', 'Admin');

// Update
User::update(1, ['name' => 'New Name']);

// Get all
$users = User::all();
```

---

## Authentication

### Login

```php
use App\Core\Auth;

// Attempt login
$login = Auth::login('email@example.com', 'password', remember: true);

if ($login) {
    // Login successful
} else {
    // Login failed
}
```

### Check Authentication

```php
// Check if authenticated
$isAuth = Auth::isAuthenticated();

// Require authentication (redirects if not)
Auth::requireAuth();

// Get current user
$user = Auth::getUser();

// Get user ID
$id = Auth::getId();
```

### Logout

```php
Auth::logout(); // Clears session and remember token
```

---

## CSRF Protection

### Generate Token

In forms:
```php
$token = CSRF::getToken();
$fieldName = CSRF::getFieldName(); // '_csrf_token'
```

```html
<form method="POST">
    <input type="hidden" name="<?php echo $fieldName; ?>" value="<?php echo $token; ?>">
    <!-- form fields -->
</form>
```

### Verify Token

```php
$token = $_POST[CSRF::getFieldName()] ?? '';

if (!CSRF::verify($token)) {
    // CSRF token invalid - reject request
    http_response_code(403);
    exit;
}
```

---

## Validation

```php
use App\Core\Validator;

$validator = new Validator();

$rules = [
    'name' => 'required|min:2|max:100',
    'email' => 'required|email',
    'message' => 'required|min:10|max:2000'
];

if ($validator->validate($_POST, $rules)) {
    // Validation passed
} else {
    // Validation failed
    $errors = $validator->getErrors();
    // $errors = [
    //     'email' => ['Email must be a valid email.'],
    //     'message' => ['Message must be at least 10 characters.']
    // ]
}
```

Supported rules:
- `required` - Field must not be empty
- `email` - Valid email format
- `min:N` - Minimum N characters
- `max:N` - Maximum N characters
- `url` - Valid URL format

---

## Creating Custom Controllers

```php
<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\YourModel;

class YourController {
    public function index(): void {
        // Require authentication
        Auth::requireAuth();
        
        // Get data
        $data = YourModel::all();
        
        // Render view
        $this->render('your-view', [
            'title' => 'Page Title',
            'data' => $data
        ]);
    }
    
    private function render(string $view, array $data = []): void {
        extract($data);
        require __DIR__ . '/../../views/' . $view . '.php';
    }
}
```

Register in `public/index.php`:
```php
$router->get('/your-path', 'YourController@index', ['App\Core\AuthMiddleware']);
```

---

## Environment Variables

Available via `Config::get()`:

```php
use App\Core\Config;

$host = Config::get('DB_HOST');
$env = Config::get('APP_ENV');
$debug = Config::get('APP_DEBUG');
$default = Config::get('NONEXISTENT', 'default_value');
```

Environment variables available:
- `DB_HOST` - Database host
- `DB_PORT` - Database port (default 3306)
- `DB_NAME` - Database name
- `DB_USER` - Database user
- `DB_PASS` - Database password
- `APP_ENV` - Environment (production/development)
- `APP_DEBUG` - Debug mode (true/false)
- `APP_URL` - Application URL
- `ADMIN_EMAIL` - Admin email
- `SESSION_TIMEOUT` - Session timeout in seconds

---

## Error Handling

### Database Errors

All database operations throw `PDOException` on error.

```php
try {
    $result = CaseStudy::create($data);
} catch (Exception $e) {
    error_log('Database error: ' . $e->getMessage());
    // Handle error gracefully
}
```

### HTTP Status Codes

- `200` - OK
- `201` - Created
- `400` - Bad Request
- `403` - Forbidden (CSRF, Auth)
- `404` - Not Found
- `405` - Method Not Allowed
- `422` - Unprocessable Entity (Validation)
- `500` - Internal Server Error

---

## Best Practices

1. **Always validate input** - Server-side validation is mandatory
2. **Always escape output** - Use `htmlspecialchars()` for display
3. **Use prepared statements** - All DB queries are parameterized
4. **Check authentication** - Use `Auth::requireAuth()` on protected routes
5. **Handle errors gracefully** - Never expose errors to users
6. **Log everything** - Important events and errors
7. **Use HTTPS** - All communications encrypted
8. **Backup regularly** - Weekly database and file backups

---

## Extending the System

### Adding a New CMS Section

1. Create model in `app/Models/YourModel.php`
2. Create controller in `app/Controllers/YourController.php`
3. Add routes in `public/index.php`
4. Create views in `views/admin/your-section/`
5. Update admin sidebar in navigation template

### Database Migration

To add new fields:

1. Backup current database
2. Modify `database/schema.sql`
3. Run schema update via SSH or phpMyAdmin
4. Update model to include new fields

---

For more information, see README.md and source code comments.
