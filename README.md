# IT Store eCommerce System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

A full-stack, production-ready eCommerce web application built with **Laravel**. It features a fully functional shopping cart, secure checkout, product management, and an administrative dashboard.

## ✨ Features

- **🛒 Interactive Cart System**: Add, remove, and manage quantities effortlessly.
- **📦 Product Management**: Categories for Mobiles, Laptops, Printers, Networking Gear, and more.
- **💳 Secure Checkout**: Complete checkout flow.
- **📊 Admin Dashboard**: Monitor inventory and sales.
- **🐳 Dockerized**: Fully containerized using Docker for seamless deployment.

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade Templates, Tailwind CSS, Vanilla JS
- **Database**: PostgreSQL (Neon Serverless)
- **Deployment**: Render (Docker Environment)

## 🚀 Deployment (Render)

This project is configured to be deployed natively on [Render](https://render.com/) using Docker.

1. Create a **New Web Service** on Render.
2. Connect your GitHub repository.
3. Render will automatically detect the `Dockerfile` and select the **Docker** environment.
4. Add the following required **Environment Variables** in the Render Dashboard:

```env
APP_NAME="IT Store"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY=
APP_DEBUG=false
APP_URL=https://your-render-url.onrender.com

DB_CONNECTION=pgsql
DB_HOST=your-neon-hostname.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=your_username
DB_PASSWORD=your_password
DB_SSLMODE=require

SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
FILESYSTEM_DISK=public
```

5. Click **Deploy**. The `docker-entrypoint.sh` will automatically run database migrations and cache configurations upon startup.

## 💻 Local Development Setup

To run this project locally:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/geekguru316-svg/it-store.git
   cd it-store
   ```

2. **Install PHP Dependencies:**
   ```bash
   composer install
   ```

3. **Install Node Dependencies & Build Assets:**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   Copy the example environment file and set up your local database:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate
   php artisan db:seed --class=ProductSeeder
   ```

6. **Start the Development Server:**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 👨‍💻 Developer

Developed and maintained by **Arjun Haincadto**.
