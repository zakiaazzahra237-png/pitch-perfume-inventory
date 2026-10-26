<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pitch.Perfume</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #e2d9cd; }
    </style>
</head>
<body class="p-6">
    <div class="max-w-7xl mx-auto bg-[#fdfbf7] rounded-[32px] shadow-2xl overflow-hidden min-h-[90vh] flex">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-[#fdfbf7] p-6 border-r border-[#ece3d5] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-10 text-2xl font-black text-[#3a2e2b]">
                    <span>🍾</span> Pitch.Perfume
                </div>
                
                <nav class="space-y-2">
                    <!-- Dashboard (Admin & Staff) -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-[#e2d9cd] text-[#3a2e2b] font-bold">
                        <span>📊</span> Dashboard
                    </a>

                    <!-- Katalog Produk (Khusus Admin) -->
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[#736356] hover:bg-[#f5efe6] font-semibold transition">
                        <span>📦</span> Katalog Produk
                    </a>
                    @endif

                    <!-- Mutasi Stok / Transaksi (Admin & Staff) -->
                    <a href="{{ route('stock.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-[#736356] hover:bg-[#f5efe6] font-semibold transition">
                        <span>🔄</span> Mutasi Stok
                    </a>
                </nav>
            </div>

            <!-- Profile & Logout Footer -->
            <div class="pt-6 border-t border-[#ece3d5]">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-[#a09081]">Logged in as ({{ ucfirst(Auth::user()->role) }})</p>
                        <p class="text-sm font-bold text-[#3a2e2b]">{{ Auth::user()->name }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-[#8c5a47] hover:bg-[#f5efe6] rounded-xl font-bold text-sm" title="Logout">
                            🚪
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-10 bg-[#fdfbf7] overflow-y-auto">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>
</body>
</html>