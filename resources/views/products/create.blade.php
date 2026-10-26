<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-black text-[#2c1d11]">Tambah Parfum Baru</h1>
            <a href="{{ route('products.index') }}" class="text-xs font-bold text-[#736356] hover:underline">← Kembali</a>
        </div>

        @if($errors->any())
        <div class="p-3 bg-red-100 border border-red-300 text-red-800 rounded-xl text-xs font-bold space-y-1">
            @foreach($errors->all() as $error)
                <p>⚠️ {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('products.store') }}" class="bg-white p-6 rounded-[22px] border border-[#d3c5b4] shadow-sm space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Kode SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}" required placeholder="Contoh: PFM-001" 
                    class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Nama Parfum</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Luxury Rose EDP 100ml" 
                    class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" required placeholder="185000" 
                        class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Stok Awal</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required placeholder="10" 
                        class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#3a2e2b] mb-1">Minimum Stok</label>
                    <input type="number" name="minimum_stock" value="{{ old('minimum_stock', 5) }}" required placeholder="5" 
                        class="w-full px-4 py-2.5 rounded-xl border border-[#d3c5b4] text-xs focus:ring-2 focus:ring-[#8c5a47]">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-[#8c5a47] hover:bg-[#6e4435] text-white font-bold rounded-xl text-xs transition">
                Simpan Produk
            </button>
        </form>
    </div>
</x-app-layout>