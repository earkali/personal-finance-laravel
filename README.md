# Personal Finance Tracker

A lightweight web application built with Laravel to help users monitor their daily financial activities. This project was developed as part of the Computer Engineering curriculum.

## Core Features
* **User Authentication:** Secure login and registration using Laravel Breeze.
* **Category Management:** Create and organize custom categories for different types of spending or income.
* **Transaction Tracking:** Log expenses and income with descriptions, dates, and amounts.
* **Financial Overview:** A dashboard featuring a real-time balance summary and category-based expense analysis.

## Tech Stack
* **Framework:** Laravel 11
* **Frontend:** Tailwind CSS & Blade Templates
* **Database:** MySQL / SQLite

## Getting Started

1. **Clone the repository:**
   `git clone https://github.com/earkali/personal-finance-laravel.git`

2. **Install dependencies:**
   `composer install && npm install && npm run build`

3. **Environment Setup:**
   `cp .env.example .env` (Make sure to configure your database settings in .env)

4. **Initialize Database:**
   `php artisan key:generate`
   `php artisan migrate`

5. **Run Application:**
   `php artisan serve`
