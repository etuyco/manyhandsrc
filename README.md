# Many Hands Resource Centre - Website

A modern Laravel + Vue.js website for Many Hands Resource Centre, a non-profit organization providing community support, food security programs, and social connection services.

## Features

- **Modern UI/UX**: Built with Bootstrap 5 and Vue.js for a responsive, accessible design
- **Program Management**: Display and manage community programs
- **Event Calendar**: Show upcoming events and recurring activities
- **Volunteer Application**: Online volunteer application form
- **Donation System**: Accept donations with form validation
- **Contact Information**: Easy-to-find contact details and hours
- **Fully Responsive**: Works seamlessly on desktop, tablet, and mobile devices
- **Accessibility**: WCAG-compliant design with proper ARIA labels and keyboard navigation

## Technology Stack

- **Backend**: Laravel 8
- **Frontend**: Vue.js 2.6, Bootstrap 5
- **Database**: MySQL
- **Build Tool**: Laravel Mix

## Installation

### Prerequisites

- PHP >= 7.3
- Composer
- Node.js >= 12.x and npm
- MySQL >= 5.7

### Setup Steps

1. **Clone the repository** (if applicable) or navigate to the project directory:
   ```bash
   cd many-hands-rc
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node dependencies**:
   ```bash
   npm install
   ```

4. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**:
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=many_hands_rc
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Seed Initial Data** (optional):
   ```bash
   php artisan db:seed
   ```

8. **Build Assets**:
   ```bash
   npm run dev
   ```
   Or for production:
   ```bash
   npm run prod
   ```

9. **Start Development Server**:
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

## Development

### Watch for Changes

During development, you can watch for file changes and automatically recompile:

```bash
npm run watch
```

Or with hot module replacement:

```bash
npm run hot
```

### Compile Assets

- Development: `npm run dev`
- Production: `npm run production` or `npm run prod`
- Watch: `npm run watch`

## Project Structure

```
many-hands-rc/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/
│   │       │   ├── ProgramController.php
│   │       │   ├── EventController.php
│   │       │   ├── DonationController.php
│   │       │   ├── VolunteerController.php
│   │       │   └── PageController.php
│   │       └── HomeController.php
│   └── Models/
│       ├── Program.php
│       ├── Event.php
│       ├── Donation.php
│       ├── Volunteer.php
│       └── Page.php
├── database/
│   └── migrations/
│       ├── create_programs_table.php
│       ├── create_events_table.php
│       ├── create_donations_table.php
│       ├── create_volunteers_table.php
│       └── create_pages_table.php
├── resources/
│   ├── js/
│   │   ├── components/
│   │   │   ├── App.vue
│   │   │   ├── Navigation.vue
│   │   │   ├── Footer.vue
│   │   │   ├── Home.vue
│   │   │   ├── ProgramsSection.vue
│   │   │   ├── EventsSection.vue
│   │   │   ├── VolunteerSection.vue
│   │   │   ├── DonateSection.vue
│   │   │   └── ContactSection.vue
│   │   └── app.js
│   ├── sass/
│   │   └── app.scss
│   └── views/
│       └── app.blade.php
└── routes/
    ├── web.php
    └── api.php
```

## API Endpoints

### Public Endpoints

- `GET /api/programs` - Get all active programs
- `GET /api/programs/{id}` - Get a specific program
- `GET /api/events` - Get all active events
- `GET /api/events/{id}` - Get a specific event
- `GET /api/pages` - Get all published pages
- `GET /api/pages/{slug}` - Get a page by slug
- `POST /api/donations` - Submit a donation
- `POST /api/volunteers` - Submit a volunteer application

## Database Schema

### Programs
- Programs offered by the organization (Food Currency, Community Kitchen, BAG Program, etc.)

### Events
- Scheduled events and recurring activities

### Donations
- Donation records with payment information

### Volunteers
- Volunteer applications and information

### Pages
- Static content pages

## Customization

### Colors

The color scheme can be customized in `resources/sass/app.scss`:

```scss
:root {
    --primary-color: #2c5f8d;
    --secondary-color: #4a9b8e;
    --accent-color: #f4a261;
    // ...
}
```

### Content

- Programs, events, and pages can be managed through the database
- For initial setup, use seeders or add data directly through migrations

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `npm run production` to compile assets
3. Run `php artisan config:cache` and `php artisan route:cache`
4. Ensure proper file permissions on `storage/` and `bootstrap/cache/`
5. Configure your web server (Apache/Nginx) to point to the `public/` directory

## License

This project is proprietary software for Many Hands Resource Centre.

## Support

For questions or support, contact: programs@manyhandsrc.com
