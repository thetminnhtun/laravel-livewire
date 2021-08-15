# Laravel Livewire SPA With TDD

This is a project that is SPA(single page application) with TDD(Test Driven Development) using [Laravel](https://laravel.com/) and [Livewire](https://laravel-livewire.com).

## Installation

Clone this reposistroy
```
git clone
```

Install the dependencies
```
composer install
```

Setup `.env` file
```
cp .env.example .env
```

Create database
```
php artisan db
create database laravel_livewire
```

Run the migrations to create tables
```
php artisan migrate
```

Run serve
```
php artisan serve
```

View in browser
```
http://localhost:8000/posts
```

## Todo

- [x] Flash message
- [ ] CRUD Testing
- [ ] Image upload
- [ ] Image upload testng