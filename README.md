Setup Instructions
1. Database

Create a MySQL database named:

shortener

Import:

database/schema.sql
2. Backend Setup

Navigate to the backend folder:

cd backend

Install dependencies:

composer install

Create a .env file based on .env.example and update the database configuration if necessary.

Start the PHP server:

php -S 127.0.0.1:9000 -t public

Backend URL:

http://127.0.0.1:9000
3. Frontend Setup

Navigate to the frontend folder:

cd frontend

Install dependencies:

npm install

Start the development server:

npm run dev

Frontend URL:

http://localhost:3000
API Endpoint
Shorten URL
POST /api/shorten

Request Body:

{
  "url": "https://www.google.com"
}
Redirect
GET /{shortCode}

Example:

http://127.0.0.1:9000/Ab12Cd

The endpoint redirects to the original URL.

Author

Amal Othman
