
# Laravel CI/CD Test Project

## Purpose
Minimal Laravel project to test:
- Composer install
- .env setup
- APP_KEY generation
- Migrations / SQL import
- Deployment health check

## Endpoints
- `/` → plain text
- `/health` → JSON health check

## CI/CD Expected Steps
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate OR import database/dump/laravel_cicd.sql
5. Deploy
