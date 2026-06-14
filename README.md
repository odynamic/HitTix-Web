# HitTix Web

HitTix Web adalah aplikasi manajemen event dan penjualan tiket konser berbasis web yang memungkinkan Event Organizer (EO) mengelola event serta memudahkan pengguna dalam melihat informasi dan melakukan pemesanan tiket.

## Overview

Aplikasi ini dikembangkan untuk membantu proses pengelolaan event, mulai dari publikasi acara, pengelolaan data event, hingga pemesanan tiket dalam satu platform.

## Features

- Registrasi dan login pengguna
- Registrasi dan login Event Organizer (EO)
- Dashboard Event Organizer
- Manajemen event (CRUD)
- Manajemen venue
- Manajemen artis
- Manajemen kategori event
- Upload gambar event
- Pemesanan tiket
- Landing page event

## Tech Stack

- PHP
- Laravel
- MySQL
- Blade
- Bootstrap
- JavaScript
- HTML
- CSS
- Git
- Laragon

## Screenshots

### Homepage
![Homepage](screenshots/homepage.png)

### Explore Events
![Explore Events](screenshots/jelajah.png)

### Join as Event Organizer
![Join EO](screenshots/gabung-eo.png)

### User Registration
![Register](screenshots/register.png)

### Event Organizer Dashboard
![Dashboard EO](screenshots/dashboard-eo.png)

### Create Event
![Create Event](screenshots/eo-add-event.png)

### Edit Profile
![Edit Profile](screenshots/edit-profile.png)

### About Page
![About](screenshots/about.png)

### Contact Page
![Contact](screenshots/contact.png)

## Installation

```bash
git clone https://github.com/odynamic/HitTix-Web.git

cd HitTix-Web

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan storage:link

php artisan serve
```

## Author

Developed as a Web Programming project using Laravel Framework.
