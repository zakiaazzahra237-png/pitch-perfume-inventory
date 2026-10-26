<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-[#2c1d11]">Katalog Produk</h1>
                <p class="text-xs text-[#7a6b5d]">Kelola inventaris stok dan varian parfum Pitch.Perfume</p>
            </div>
            @can('admin-only')
            <a href="{{ route('products.create') }}" class="px-5 py-2.5 bg-[#8c5a47] hover:bg-[#6e4435] text-white text-xs font-bold rounded-xl transition shadow-sm">
                + Tambah Parfum
            </a>
            @endcan
        </div>

        <!-- Alert Notification -->
        @if(session('success'))
        <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="bg-white p-4 rounded-[22px] border border-[#d3c5b4] shadow-sm">
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama parfum atau SKU..." 
                    class="w-full px-4 py-2 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                <button type="submit" class="px-5 py-2 bg-[#21150c] hover:bg-[#3a2e2b] text-white text-xs font-bold rounded-xl transition">
                    Cari
                </button>
            </form>
        </div>

        <!-- Product Table -->
        <div class="bg-white rounded-[22px] border border-[#d3c5b4] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f5efe6] text-[#736356] text-xs font-bold">
                            <th class="py-3.5 px-4">SKU</th>
                            <th class="py-3.5 px-4">Nama Parfum</th>
                            <th class="py-3.5 px-4">Harga (Rp)</th>
                            <th class="py-3.5 px-4">Stok</th>
                            <th class="py-3.5 px-4">Min. Stok</th>
                            @can('admin-only')
                            <th class="py-3.5 px-4 text-center">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="text-[#3a2e2b] text-xs font-medium divide-y divide-[#f5efe6]">
                        @forelse($products as $product)
                        <tr class="hover:bg-[#fdfbf7] transition">
                            <td class="py-3 px-4 font-bold text-[#2c1d11]">{{ $product->sku ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <!-- Format harga yang sudah dipastikan mengambil nilai price secara akurat -->
                            <td class="py-3 px-4 font-semibold text-[#2c1d11]">
                                Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 font-bold {{ $product->stock <= ($product->minimum_stock ?? 5) ? 'text-red-600' : 'text-[#8c5a47]' }}">
                                {{ $product->stock }} Botol
                            </td>
                            <td class="py-3 px-4">{{ $product->minimum_stock ?? 5 }} Botol</td>
                            @can('admin-only')
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="px-3 py-1 bg-[#b39982] hover:bg-[#8c5a47] text-white text-[11px] font-bold rounded-lg transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-[11px] font-bold rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endcan
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-[#736356] text-xs">
                                Belum ada data produk parfum.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="p-4 border-t border-[#f5efe6]">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>