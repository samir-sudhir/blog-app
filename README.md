# **Laravel Blog Backend**

This project is a complete backend solution for a blog application, built with **Laravel**. It includes functionalities for uploading posts, managing images, and adding comments using **polymorphic relationships**. The project also supports **nested comments** (commenting on comments).

---

## **Features**

1. **Post Management**
   - Create, Read, Update, and Delete (CRUD) posts.
   - Each post can have associated images and comments.

2. **Image Management**
   - Upload images.
   - Images can also have comments.

3. **Comment Management**
   - Comment on posts, images, or even other comments.
   - Supports nested comments using a parent-child relationship.

4. **Polymorphic Relationships**
   - **`morphTo`** and **`morphMany`** relationships implemented:
     - Comments can belong to multiple models (`Post`, `Image`, and other `Comment` objects).

5. **API Endpoints**
   - Endpoints for creating, updating, deleting, and retrieving comments.
   - Count total comments for a given resource.

---

## **Technologies Used**

- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Tools**: Composer, Artisan CLI
- **Dependencies**: Laravel's core packages

---

## **Database Schema**

- **`posts` Table**
  - `id` (Primary Key)
  - `title` (String)
  - `body` (Text)
  - `timestamps`

- **`images` Table**
  - `id` (Primary Key)
  - `url` (Path to the uploaded image)
  - `timestamps`

- **`comments` Table**
  - `id` (Primary Key)
  - `body` (Text)
  - `commentable_id` & `commentable_type` (Polymorphic keys)
  - `parent_id` (For nested comments, nullable)
  - `timestamps`

---

## **Installation**

Follow these steps to set up the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/your-username/laravel-blog-backend.git
cd laravel-blog-backend
```

### 2. Install dependencies
Use Composer to install required dependencies:
```bash
composer install
```

### 3. Set up environment
Copy the `.env.example` file and configure the database connection:
```bash
cp .env.example .env
php artisan key:generate
```
Update the `.env` file:
```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run migrations
Run the database migrations to create necessary tables:
```bash
php artisan migrate
```

### 5. Run the server
Start the local development server:
```bash
php artisan serve
```
Access the project at `http://127.0.0.1:8000`.

---

## **API Endpoints**

Here’s a list of the main API endpoints:

### **Posts**
| Method   | Endpoint           | Description            |
|----------|--------------------|------------------------|
| `GET`    | `/api/posts`       | List all posts         |
| `POST`   | `/api/posts`       | Create a new post      |
| `PUT`    | `/api/posts/{id}`  | Update a post          |
| `DELETE` | `/api/posts/{id}`  | Delete a post          |

### **Comments**
| Method   | Endpoint                                                       | Description                          |
|----------|----------------------------------------------------------------|--------------------------------------|
| `POST`   | `/api/comments/{commentableType}/{commentableId}`              | Create a comment                     |
| `GET`    | `/api/comments/{commentableType}/{commentableId}`              | List all comments for a resource     |
| `PUT`    | `/api/comments/{id}`                                           | Update a specific comment            |
| `DELETE` | `/api/comments/{id}`                                           | Delete a comment                     |
| `GET`    | `/api/comments/count/{commentableType}/{commentableId}`        | Count comments for a specific entity |

---

## **Code Overview**

### Polymorphic Relationships
- **Posts and Images**:  
  Each can have multiple comments using the `morphMany` relationship.  
- **Comments**:  
  Use a `morphTo` relationship to belong to `Post`, `Image`, or another `Comment` for nesting.

#### Example: Comment Model
```php
public function commentable()
{
    return $this->morphTo();
}

public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id');
}
```

---

## **How to Test**

You can test the API using tools like **Postman** or **cURL**.

### Example: Create a Comment
**Request:**
```http
POST /api/comments/post/1
Content-Type: application/json

{
    "body": "This is a comment."
}
```

**Response:**
```json
{
    "id": 1,
    "body": "This is a comment.",
    "commentable_id": 1,
    "commentable_type": "App\\Models\\Post",
    "created_at": "2024-06-17 10:00:00",
    "updated_at": "2024-06-17 10:00:00"
}
```

---

## **Future Enhancements**

- Add authentication for user roles (admin, guest, etc.).
- Add pagination for comments and posts.
- Implement file uploads for images with validation.

---

## **License**

This project is open-source and available under the [MIT License](LICENSE).

---

## **Author**

**Samir Ahmad**  
LinkedIn: [samir Ahmad](https://www.linkedin.com/in/samir-ahmad-07255224a/)  
GitHub: [samir-sudhir](https://github.com/samir-sudhir)  
