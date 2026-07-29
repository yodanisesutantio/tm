# Installation

## 1. Install PHP dependencies

Install Laravel dependencies using Composer:

```bash
composer install
```

---

## 2. Configure environment variables

Copy the example environment file:

### macOS / Linux

```bash
cp .env.example .env
```

### Windows PowerShell

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

---

## 3. Setup SQLite database

Create the SQLite database file:

### macOS / Linux

```bash
touch database/database.sqlite
```

### Windows PowerShell

```powershell
New-Item database/database.sqlite -ItemType File
```

Update your `.env` file:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Run database migrations:

```bash
php artisan migrate
```

---

## 4. Install frontend dependencies

Install Node packages:

```bash
npm install
```

---

## 5. Build frontend assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

---

# Running the Application

You need two terminal windows.

## Terminal 1: Laravel server

```bash
php artisan serve
```

The application will be available at:

```
http://127.0.0.1:8000
```

---

## Terminal 2: Vite development server

```bash
npm run dev
```

---

# Database

This project currently uses SQLite.

Database file:

```
database/database.sqlite
```

To reset the database:

```bash
php artisan migrate:fresh
```

To run migrations with sample data:

```bash
php artisan migrate:fresh --seed
```
