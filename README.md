Setup Instructions
1. Clone Repository
git clone <repository-url>
cd short-url-generator
2. Create Database

Create a MySQL database named:

shortener

Import the database schema:

database/schema.sql
3. Run Backend

Navigate to the backend directory:

cd backend

Install Composer dependencies:

composer install

Create a .env file from .env.example.

Start the PHP development server:

php -S 127.0.0.1:9000 -t public

Backend URL:

http://127.0.0.1:9000
4. Run Frontend

Navigate to the frontend directory:

cd frontend

Install dependencies:

npm install

Start the development server:

npm run dev

Frontend URL:

http://localhost:3000
API Endpoints
Create Short URL
POST /api/shorten

Request Body:

{
  "url": "https://www.google.com"
}
Redirect
GET /{shortCode}

Example:

http://127.0.0.1:9000/JXie23

The endpoint redirects to the original URL.

Testing
Open the frontend application.
Enter a valid URL.
Click Shorten URL.
Verify that a short URL is generated.
Click Test Redirect.
Verify that the browser redirects to the original URL.
Author

Amal Othman
