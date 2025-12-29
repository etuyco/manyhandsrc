<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Many Hands Resource Centre - Community Support & Food Security</title>
    <meta name="description" content="Many Hands envisions a diverse and healthy community. A place where individuals and families all belong, have the opportunity to contribute, and access essential resources.">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Accessibility: Skip to main content -->
    <style>
        .skip-to-main {
            position: absolute;
            left: -9999px;
            z-index: 999;
        }
        .skip-to-main:focus {
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <a href="#main-content" class="skip-to-main">Skip to main content</a>
    <div id="app">
        <!-- Vue app will render here -->
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

