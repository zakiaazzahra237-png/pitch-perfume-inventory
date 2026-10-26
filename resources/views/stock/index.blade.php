<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black text-[#2c1d11]">Mutasi Stok Parfum</h1>
                <p class="text-xs text-[#7a6b5d]">Catat dan pantau transaksi Stok Masuk & Stok Keluar (Penjualan)</p>
            </div>
            <div class="bg-[#e8ded1] px-3 py-1.5 rounded-xl text-xs font-bold text-[#2c1d11]">
                Petugas: {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
            </div>
        </div>

        <!-- Alert Success / Error -->
        @if(session('success'))
        <div class="p-3 bg-green-100 border border-green-300 text-green-800 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="p-3 bg-red-100 border border-red-300 text-red-800 rounded-xl text-xs font-bold space-y-1">
            @foreach($errors->all() as $error)
                <p>⚠️ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <!-- Form Input Mutasi Stok -->
        <div class="bg-white p-6 rounded-[22px] border border-[#d3c5b4] shadow-sm">
            <h3 class="text-sm font-bold text-[#2c1d11] mb-4">➕ Form Input Transaksi Stok</h3>
            
            <form method="POST" action="{{ route('stock.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Pilih Produk -->
                    <div>
                        <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Pilih Produk Parfum</label>
                        <select name="product_id" required class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                            <option value="">-- Pilih Parfum --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }} (Sisa Stok: {{ $p->stock }} Botol)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jenis Mutasi -->
                    <div>
                        <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Jenis Transaksi</label>
                        <select name="type" required class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                            <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>🟢 Stok Masuk (Stock-In)</option>
                            <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>🔴 Stok Keluar (Stock-Out / Penjualan)</option>
                        </select>
                    </div>

                    <!-- Jumlah Botol -->
                    <div>
                        <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Jumlah (Botol)</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" required 
                            class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]" placeholder="1">
                    </div>
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Catatan / Keterangan (Opsional)</label>
                    <input type="text" name="notes" value="{{ old('notes') }}" 
                        class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]" placeholder="Contoh: Penjualan toko fisik / Restock supplier">
                </div>

                <button type="submit" class="w-full py-3 bg-[#8c5a47] hover:bg-[#6e4435] text-white font-bold rounded-xl text-xs transition">
                    Simpan Transaksi Mutasi Stok
                </button>
            </form>
        </div>

        <!-- Ringkasan Sisa Stok Saat Ini -->
        <div class="bg-white p-6 rounded-[22px] border border-[#d3c5b4] shadow-sm">
            <h3 class="text-sm font-bold text-[#2c1d11] mb-3">📦 Monitoring Sisa Stok Real-Time</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f5efe6] text-[#736356] text-xs">
                            <th class="py-2.5 px-4">SKU</th>
                            <th class="py-2.5 px-4">Nama Parfum</th>
                            <th class="py-2.5 px-4">Harga Unit</th>
                            <th class="py-2.5 px-4">Sisa Stok</th>
                            <th class="py-2.5 px-4">Batas Min. Stok</th>
                            <th class="py-2.5 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#3a2e2b] text-xs font-medium">
                        @forelse($products as $product)
                        <tr class="border-b border-[#f5efe6] hover:bg-[#fdfbf7]">
                            <td class="py-2.5 px-4 font-bold">{{ $product->sku ?? '-' }}</td>
                            <td class="py-2.5 px-4">{{ $product->name }}</td>
                            <td class="py-2.5 px-4">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
                            <td class="py-2.5 px-4 font-extrabold text-sm {{ $product->stock <= ($product->minimum_stock ?? 5) ? 'text-red-600' : 'text-[#8c5a47]' }}">
                                {{ $product->stock }} Botol
                            </td>
                            <td class="py-2.5 px-4">{{ $product->minimum_stock ?? 5 }} Botol</td>
                            <td class="py-2.5 px-4">
                                @if($product->stock <= ($product->minimum_stock ?? 5))
                                    <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-[10px] font-bold">⚠️ Stok Kritis</span>
                                @else
                                    <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-[10px] font-bold">✅ Aman</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-[#736356] text-xs">Belum ada data produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>