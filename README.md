# Blog Management System

A simple blog management system built with Laravel that provides CRUD functionality for articles, the ability to add comments, search functionality, and optional API endpoints.

---

## Features

1. **CRUD for Articles**
   - Create, edit, delete, and view articles.
   - Articles have the following fields:
     - `title` (string)
     - `content` (text)
     - `category_id` (foreign key)
     - `created_at`, `updated_at` (timestamps)

2. **Categories**
   - Manage categories linked to articles.

3. **Comments**
   - Add, edit, and delete comments linked to articles.
   - Comments have the following fields:
     - `content` (text)
     - `post_id` (foreign key)
     - `created_at` (timestamp)

4. **Search Functionality**
   - Search articles by their title.

5. **API Endpoints** (Optional)
   - **Public API:**
     - `GET /api/posts`: Retrieve a list of articles.
     - `GET /api/posts/{id}`: Retrieve details of a specific article.
   - **Protected API:** (Requires Sanctum authentication)
     - `POST /api/posts/{id}/comments`: Add a comment to an article.
     - `POST /api/login`: Login and retrieve an API token.

---

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/tuncadev/laravel-blog-management.git
   cd laravel-blog-management
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   ```

3. **Environment Setup:**
   - Copy the `.env.example` file to `.env`:
   
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database and other configuration details.

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seed Database:**
   ```bash
   php artisan migrate --seed
   ```

6. **Run the Application:**
   ```bash
   php artisan serve
   ```
   Access the application at `http://localhost:8000`.

---

## Usage

### Web Routes

1. **Homepage:** `GET /`
2. **Article Management:**
   - Create/Edit/Delete: Accessible through the admin panel.
   - View: Accessible via `/posts/{id}`.
3. **Category Management:** Accessible through `/categories`.
4. **Comment Management:** Manage comments under specific articles.

### API Endpoints

1. **Public API Endpoints:**
   - `GET /api/posts`: Retrieve all articles.
   - `GET /api/posts/{id}`: Retrieve details of a specific article.

2. **Protected API Endpoints:**
   - `POST /api/login`: Authenticate and get an API token.
   - `POST /api/posts/{id}/comments`: Add a comment to a specific article (requires token).

---

## Testing

Run the following commands to execute the test suite:

```bash
php artisan env:prepare-test --env=testing
php artisan migrate --env=testing
php artisan test

```

---

## Project Structure

### Controllers
- `CategoryController`: Manage categories.
- `PostController`: Manage articles and homepage view.
- `CommentController`: Manage comments.
- `HomeController`: Handle user dashboard.

### Routes
- **Web Routes:** Defined in `routes/web.php`.
- **API Routes:** Defined in `routes/api.php`.

### Test Files
 - tests/Feature/WebRoutesTest.php: Tests all web routes for accessibility and functionality.
 - tests/Feature/ApiRoutesTest.php: Tests all API endpoints for proper responses, including authentication.
 - tests/Unit: Contains unit tests for individual components or isolated logic.

---

## Requirements

- PHP 7.4 - 8.0
- Laravel Framework
- MySQL or compatible database

---

## License
This project is licensed under the MIT License.

---

## Contribution
Contributions are welcome! Please fork this repository and submit a pull request for review.

---

## Author
Created by Ozgur M Tunca @2024.