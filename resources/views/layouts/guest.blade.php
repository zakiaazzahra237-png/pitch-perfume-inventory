<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pitch.Perfume - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #e2d9cd; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-[#f5efe6] p-8 rounded-3xl shadow-xl border border-[#d3c5b4]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#3a2e2b] flex items-center justify-center gap-2">
                <span>🍾</span> Pitch.Perfume
            </h1>
            <p class="text-sm text-[#736356] mt-2">Masuk ke sistem manajemen inventaris</p>
        </div>
        
        {{ $slot }}
    </div>
</body>
</html>