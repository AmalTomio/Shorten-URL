# Short URL Generator

## Setup

### 1. Clone Repository

```bash
git clone <repository-url>
cd short-url-generator
```

---

### 2. Database Setup

Create a MySQL database:

```sql
CREATE DATABASE shortener;
```

Import:

```text
database/schema.sql
```

---

### 3. Backend Setup

```bash
cd backend

composer install
```

Create a `.env` file from `.env.example`.

Start the backend:

```bash
php -S 127.0.0.1:9000 -t public
```

Backend URL:

```text
http://127.0.0.1:9000
```

---

### 4. Frontend Setup

```bash
cd frontend

npm install

npm run dev
```

Frontend URL:

```text
http://localhost:3000
```

---

## Test

1. Open `http://localhost:3000`
2. Enter a valid URL
3. Click **Shorten URL**
4. Open the generated short URL
5. Verify it redirects to the original URL
