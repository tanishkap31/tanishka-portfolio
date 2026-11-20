# Tanishka Patil: Portfolio with Admin Panel

A personal portfolio website built with **Laravel** and **MySQL**. One project, two sides:

- **Public portfolio:** a one-page site for clients and recruiters (Home, About, Skills, Projects, Experience & Education, Certifications, Contact).
- **Admin panel:** a private, login-protected area where the owner manages all content and reads contact enquiries.

## Features

**Public site**
- Responsive design for phone, tablet and desktop
- Light and dark theme
- Project detail pages and resume download
- Contact form with spam protection, saved to the database

**Admin panel**
- Secure login with rate limiting
- Dashboard: total projects, enquiries, skills and unread messages
- Manage Profile, Skills, Projects, Experience, Education and Certifications
- Contact Enquiries inbox with status (New, Read, Replied, Won, Closed) and private notes
- Resume upload and Website Settings, including password change

## Tech stack

| Area | Tools |
|---|---|
| Back end | PHP 8.2+, Laravel 13 |
| Database | MySQL |
| Front end | Blade, HTML, CSS, JavaScript, Bootstrap 5, Bootstrap Icons |

## Run it locally

Requirements: PHP 8.2+, Composer, MySQL.

```bash
git clone https://github.com/tanishkap31/tanishka-portfolio.git
cd tanishka-portfolio
composer install
copy .env.example .env        # on Mac/Linux: cp .env.example .env
php artisan key:generate
```

Create an empty MySQL database named `tanishka_portfolio`, then set these in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tanishka_portfolio
DB_USERNAME=root
DB_PASSWORD=your-mysql-password

ADMIN_EMAIL=your-email@example.com
ADMIN_PASSWORD=choose-a-strong-password
```

Then run:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

- Website: http://127.0.0.1:8000
- Admin panel: http://127.0.0.1:8000/admin/login

If `ADMIN_PASSWORD` is not set, the seeder creates a temporary password (`ChangeMe@123`). Change it right away in **Website Settings**.

## Project structure

```
routes/web.php                      public and admin routes
app/Http/Controllers/Frontend/      public pages and contact form
app/Http/Controllers/Admin/         one controller per admin section
app/Models/                         Profile, Skill, Project, Experience, Education,
                                    Certification, Enquiry, Resume, Setting
database/migrations/                database tables
database/seeders/                   starter data
resources/views/frontend/           public pages
resources/views/admin/              admin pages
public/assets/                      CSS, JavaScript and vendored Bootstrap
```

## Deployment

Use hosting that runs PHP 8.2+ and MySQL. Set `APP_ENV=production`, `APP_DEBUG=false` and a strong `ADMIN_PASSWORD` in the server's `.env`, point the domain to the `public` folder, then run `composer install --no-dev`, `php artisan migrate --seed --force` and `php artisan storage:link`.

Never commit your `.env` file.

## Author

**Tanishka Patil**: BSc Computer Science, Mumbai. Frontend and Laravel developer.
