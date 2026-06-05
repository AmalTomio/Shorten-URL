# Short URL Generator

A web application that converts long URLs into short URLs and redirects users to the original URL.

## Docker Setup (Backend + Database)

### Requirements

* Docker Desktop

### Start Services

```bash
docker compose up --build
```

Backend API:

```text
http://localhost:9000
```

---

## Frontend Setup

### Requirements

* Node.js

### Install Dependencies

```bash
cd frontend

npm install
```

### Start Frontend

```bash
npm run dev
```

Frontend:

```text
http://localhost:3000
```

---

## Manual Backend Setup (Without Docker)

### Requirements

* PHP 8+
* Composer
* MySQL

### Create Database

```sql
CREATE DATABASE shortener;
```

Import:

```text
database/schema.sql
```

### Install Dependencies

```bash
cd backend

composer install
```

Create a `.env` file from `.env.example`.

### Start Backend

```bash
php -S 127.0.0.1:9000 -t public
```

Backend:

```text
http://127.0.0.1:9000
```

---

## Testing

1. Open `http://localhost:3000`
2. Enter a valid URL
3. Click **Shorten URL**
4. Open the generated short URL
5. Verify it redirects to the original URL
