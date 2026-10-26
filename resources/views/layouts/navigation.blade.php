<div class="space-y-2">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#e8ded1] text-[#2c1d11] shadow-sm' : 'text-[#7a6b5d] hover:bg-[#f5efe6]' }}">
        <span>📊</span>
        <span>Dashboard</span>
    </a>

    <!-- Katalog Produk (Admin Only) -->
    @can('admin-only')
    <a href="{{ route('products.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-[#e8ded1] text-[#2c1d11] shadow-sm' : 'text-[#7a6b5d] hover:bg-[#f5efe6]' }}">
        <span>📦</span>
        <span>Katalog Produk</span>
    </a>
    @endcan

    <!-- Mutasi Stok -->
    <a href="{{ route('stock.index') }}" 
       class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition-all duration-200 {{ request()->routeIs('stock.*') ? 'bg-[#e8ded1] text-[#2c1d11] shadow-sm' : 'text-[#7a6b5d] hover:bg-[#f5efe6]' }}">
        <span>🔄</span>
        <span>Mutasi Stok</span>
    </a>
</div>