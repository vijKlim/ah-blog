# Blog Test: PHP, MySQL, Smarty

Simple blog application implemented using pure PHP without frameworks.

## Features

- MVC architecture
- Dependency Injection
- Repository + Service layers
- DTO hydration
- Smarty templates
- SCSS styling
- MySQL database
- Docker environment
- Categories and articles
- Pagination
- Sorting by date and views
- Related articles
- Seed functionality

## Stack

- PHP 8.3
- MySQL 8
- Smarty
- SCSS
- Docker
- FakerPHP
- PHP-DI

## Installation

```bash
git clone https://github.com/vijKlim/ah-blog.git
```

Using Make:
```bash
cd ah-blog
make init
```
Or:
```bash
cd ah-blog
mkdir -p var/cache/smarty
chmod -R 777 var/cache
cp .env.example .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php bin/seed.php
```

## Run blog

Using Make:
```bash
cd ah-blog
make start
```
Or:
```bash
cd ah-blog
docker compose up -d --build
```

Open application:
```bash
http://localhost:8080
```

## For edit styles:

Install frontend dependencies:

```bash
npm install
```

Build styles:
```bash
npm run scss:build
```