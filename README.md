# Getting started

## Used Technologies

-   Laravel
-   Livewire
-   Alpinejs
-   Tailwindcss

## Installation

Please check the official laravel installation guide for server requirements before you start.
Alternative installation is possible without local dependencies relying on [Docker](#docker).

#### Clone the repository

```bash
git clone git@github.com:gothinkster/laravel-realworld-example-app.git
```

#### Switch to the repo folder

```bash
cd laravel-realworld-example-app
```

#### Composer Install

```bash
composer install
```

#### Copy the example env file

```bash
cp .env.example .env
```

#### Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

## Database seeding

```bash
php artisan db:seed
```

Request headers

| **Key**  | **Value**         |
| -------- | ----------------- |
| Email    | admin@square1.com |
| Password | password          |
| Role     | 1                 |

**_Note_** : Don't forget to put integration blog post URL to import data and also to create from admin panel AdminAuthor User

-   `.env`
    -   BLOG_POST_URL= https://sq1-api-test.herokuapp.com/posts

---

## How the project is structured?

-   We Have 3 users types

    -   Admin
    -   Author
    -   AdminAuthor

-   We Used PostPolicy and UserPolicy to manage the auth user and guest roles.

---

## Project Features & Scenarios

-   We Have 2 main modules [User Module] - [Post Module]

    -   [Guest] users

        -   can view only published posts - from welcome page `/`
        -   can show specific post - after click on read more `/posts/{id}`

    -   [Admin] users

        -   can view users - from users page `/users`
        -   can create user - from user create page `/users/create`
        -   can edit user - from user edit page `/users/{id}/edit`
        -   can delete user by [Bulk] action button - from users page `/users/{id}/edit`

        -   can view only published posts - from welcome page `/`
        -   can view his posts - from posts page `/posts`
        -   can create post - from posts page `/posts/create`
        -   can show specific post if it's published or if this post is his own and not published - after click on read more `/posts/{id}`

    -   [Author] users

        -   can view only published posts - from welcome page `/`
        -   can view his posts - from posts page `/posts`
        -   can show specific post if it's published or if this post is his own and not published - after click on read more `/posts/{id}`

    -   [AdminAuthor] users
        -   this user must created by [Admin]
        -   this user is only for imported blog posts

---

## Importing Posts

```php
php artisan square1:import:posts
```

### Optional Requirements

-   [AdminAuthor] user should be exists and it will attach the imported posts to him.

-   add in `.env` BLOG_POST_URL= https://sq1-api-test.herokuapp.com/posts
