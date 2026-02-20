<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SPP App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans text-slate-800">
<div class="min-h-screen md:flex">
    <x-layout.sidebar />
    <div class="flex-1 md:ml-64">
        <x-layout.topbar />
        <main class="p-4 md:p-6">
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
