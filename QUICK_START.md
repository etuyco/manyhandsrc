# Quick Start Guide

## Initial Setup (First Time)

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Edit `.env` and set your database credentials.

3. **Setup Database**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Build Assets**:
   ```bash
   npm run dev
   ```

5. **Start Server**:
   ```bash
   php artisan serve
   ```

   Visit: http://localhost:8000

## Daily Development

1. **Start Laravel Server** (Terminal 1):
   ```bash
   php artisan serve
   ```

2. **Watch for Changes** (Terminal 2):
   ```bash
   npm run watch
   ```

## Building for Production

```bash
npm run production
php artisan config:cache
php artisan route:cache
```

## Troubleshooting

### Assets not loading?
- Run `npm run dev` or `npm run production`
- Clear browser cache
- Check `public/css/app.css` and `public/js/app.js` exist

### Vue components not rendering?
- Check browser console for errors
- Verify `npm run dev` completed successfully
- Ensure `#app` element exists in `app.blade.php`

### Database errors?
- Verify `.env` database credentials
- Run `php artisan migrate:fresh` (WARNING: deletes all data)
- Check MySQL is running

### API endpoints not working?
- Check `routes/api.php` is correct
- Verify controllers exist in `app/Http/Controllers/Api/`
- Check Laravel logs: `storage/logs/laravel.log`

