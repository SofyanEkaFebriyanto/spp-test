<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem SPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">
    <x-ui.card class="w-full max-w-md p-8">
        <h1 class="text-2xl font-bold text-center text-blue-800">Sistem Pembayaran SPP</h1>
        <p class="mt-1 text-sm text-center text-slate-500">Silakan masuk untuk melanjutkan.</p>

        <form action="{{ route('login.post') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <x-ui.input label="Username" name="name" placeholder="Masukkan nama pengguna" required />
            <x-ui.select label="Role" name="role" :options="['admin' => 'Admin', 'petugas' => 'Petugas']" required />
            <x-ui.input label="Password" name="password" type="password" placeholder="••••••••" />
            <x-ui.button type="submit" class="w-full">Masuk</x-ui.button>
        </form>
    </x-ui.card>
</body>
</html>
