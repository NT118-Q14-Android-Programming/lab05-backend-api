# Lab05 Backend API

This backend is used for Lab 5 Android Retrofit login.

## Structure
- `api/db.php` — database connection
- `api/login.php` — login handler
- `sql/init.sql` — creates database & sample users

## How to Run
1. Install XAMPP
2. Copy folder to: `C:/xampp/htdocs/lab05-backend-api`
3. Import SQL:
   - Open phpMyAdmin → Import `init.sql`
4. Start Apache + MySQL
5. Test API in Postman:
   - POST `http://localhost/lab05-backend-api/api/login.php`
