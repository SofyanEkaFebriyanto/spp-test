@php $user = session('user', ['name' => 'Guest', 'role' => 'petugas']); @endphp
<header class="h-16 bg-white border-b border-slate-200 px-4 md:px-6 flex items-center justify-between">
    <h2 class="font-semibold text-slate-700">SMK Negeri Contoh</h2>
    <div class="flex items-center gap-3">
        <div class="text-right">
            <p class="text-sm font-medium">{{ $user['name'] }}</p>
            <x-ui.badge :variant="$user['role']">{{ strtoupper($user['role']) }}</x-ui.badge>
        </div>
        <form action="{{ route('logout') }}" method="POST">@csrf <x-ui.button variant="secondary" type="submit">Logout</x-ui.button></form>
    </div>
</header>
