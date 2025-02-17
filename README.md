# 📰 News Fetcher

## 🚀 Project Overview

**News Fetcher** is a Laravel-based application that fetches news articles from multiple providers (NewsAPI, The
Guardian, and The New York Times) and provides structured APIs for public and authenticated users. The project follows
clean code principles and design patterns for maintainability and scalability.

---

## 🏗️ Tech Stack

| Technology                                                                                                   | Description              |
|--------------------------------------------------------------------------------------------------------------|--------------------------|
| ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)     | Backend Framework        |
| ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)           | Database                 |
| ![Redis](https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white)           | Caching & Queues         |
| ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)        | Containerization         |
| ![Supervisor](https://img.shields.io/badge/Supervisor-4CAF50?style=for-the-badge&logo=linux&logoColor=white) | Queue Workers Management |

---

## ⚙️ Project Setup

### 1️⃣ Clone the Repository

```sh
git clone https://github.com/elsayed85/news-fetcher.git
cd news-fetcher
```

### 2️⃣ Setup Environment

```sh
cp .env.example .env
```

### 3️⃣ Start Required Services (MySQL, Redis, PHPMyAdmin)

```sh
docker compose -f docker-compose-services.yml up -d
```

### 4️⃣ Start the Application

```sh
docker compose up -d
```

### 5️⃣ Enter the Container

```sh
docker exec -it news-fetcher bash
```

### 6️⃣ Install Dependencies & Migrate Database

```sh
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 7️⃣ Fix Storage Permissions (if needed)

```sh
chmod -R 777 storage
```

---

## 📌 Features

### ✅ Fetching News (Scheduled Jobs & Queues)

- Each provider has a dedicated **command** that runs on a schedule to fetch news.
- Commands dispatch **provider jobs** to a **Redis queue** for processing.
- **Supervisor** manages queue workers to handle jobs efficiently.

### ✅ Job Processing

- Fetches data from provider APIs using a **Request Builder** to structure API calls.
- Uses **Adapters & DTOs** to transform API responses into a standardized format.
- **Caches categories, sources, and authors** to reduce database queries.
- Saves transformed data into the database efficiently.

### ✅ RESTful API Endpoints

#### 🔓 Public APIs:

- **Articles:** List & Show
- **Categories:** List
- **Sources:** List
- **Authors:** List

#### 🔐 Authenticated User APIs:

- **Articles:** List filtered by user preferences (**Categories, Sources, Authors**)

📌 **Full API Documentation:** [Postman Docs](https://documenter.getpostman.com/view/30884782/2sAYXFiHMc)

---

## Design Patterns Used 🏗️

- **Service Layer**: Business logic is encapsulated in service classes.
- **Repository Pattern**: Data access is abstracted using repositories.
- **Adapter Pattern**: Each news provider has an adapter to normalize its response format.
- **Builder Pattern**: Request parameters are dynamically constructed.
- **DTOs (Data Transfer Objects)**: Ensures data consistency across layers.
- **Factory Pattern**: Used for object instantiation and dependency injection.
- **Filter Pattern**: Query filtering is handled dynamically for various models.

---

## Queue Management (Supervisor) ⚡

Supervisor is used to manage the queue workers efficiently. Each provider has its own queue configuration:

```ini
[program:guardian]
process_name = %(program_name)s
command = php82 /var/www/html/artisan queue:work --queue=guardian,newsApi,nyt --sleep=3 --tries=3
autostart = true
autorestart = true
stderr_logfile = /var/log/supervisor/worker.log
stdout_logfile = /var/log/supervisor/worker.log
numprocs = 1
priority = 999
startsecs = 0
stopwaitsecs = 3600
```

```ini
[program:newsApi]
process_name = %(program_name)s
command = php82 /var/www/html/artisan queue:work --queue=newsApi,guardian,nyt --sleep=3 --tries=3
autostart = true
autorestart = true
stderr_logfile = /var/log/supervisor/worker.log
stdout_logfile = /var/log/supervisor/worker.log
numprocs = 1
priority = 999
startsecs = 0
stopwaitsecs = 3600
```

```ini
[program:nyt]
process_name = %(program_name)s
command = php82 /var/www/html/artisan queue:work --queue=nyt,newsApi,guardian --sleep=3 --tries=3
autostart = true
autorestart = true
stderr_logfile = /var/log/supervisor/worker.log
stdout_logfile = /var/log/supervisor/worker.log
numprocs = 1
priority = 999
startsecs = 0
stopwaitsecs = 3600
```

---

## Project Structure 📂

```
app
├── Adapters
│   ├── Providers
│   └── Transformers
├── Builders
├── Console
│   └── Commands
│       └── Providers
│           ├── Guardian
│           ├── NewsApi
│           └── Nyt
├── Contracts
│   ├── Adapter
│   ├── Filters
│   ├── Repositories
│   └── Transformers
├── Dtos
├── Enums
├── Exceptions
│   └── News
├── Factories
├── Filters
│   └── Content
├── Http
│   ├── Controllers
│   │   └── News
│   ├── Middleware
│   ├── Requests
│   │   └── News
│   │       └── Content
│   └── Resources
│       └── News
├── Jobs
│   ├── Guardian
│   ├── NewsApi
│   └── Nyt
├── Models
│   └── User
├── Providers
├── Repositories
├── Services
│   ├── Content
│   └── Providers
└── Traits
```

---
