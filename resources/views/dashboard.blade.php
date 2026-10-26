<x-app-layout>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="space-y-5">
        <!-- Header Top Bar & Banner Greeting -->
        <div class="flex items-center justify-between bg-[#e8ded1] p-5 rounded-[22px] shadow-sm">
            <div>
                <h2 class="text-2xl font-black text-[#2c1d11]">
                    Halo, {{ Auth::user()->name }}
                </h2>
                <p class="text-[#7a6b5d] text-sm font-medium">
                    Ready to start your day with managing perfume stocks?
                </p>
            </div>
            <div class="bg-[#fdfbf7] px-4 py-2 rounded-xl text-xs font-bold text-[#2c1d11] border border-[#d3c5b4]">
                👤 {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})
            </div>
        </div>

        <!-- Overview Section (Kartu Statistik Angka) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-[#21150c] text-white p-4 rounded-[20px] shadow-sm">
                <p class="text-xs opacity-80 mb-1">Total Varian</p>
                <p class="text-2xl font-extrabold">{{ $totalVarian ?? 0 }}</p>
            </div>

            <div class="bg-[#6b4436] text-white p-4 rounded-[20px] shadow-sm">
                <p class="text-xs opacity-80 mb-1">Total Stok Botol</p>
                <p class="text-2xl font-extrabold">{{ $totalStok ?? 0 }}</p>
            </div>

            <div class="bg-[#b39982] text-white p-4 rounded-[20px] shadow-sm">
                <p class="text-xs opacity-80 mb-1">Stok Kritis</p>
                <p class="text-2xl font-extrabold">{{ $stokKritis ?? 0 }}</p>
            </div>

            <div class="bg-[#3a2e2b] text-white p-4 rounded-[20px] shadow-sm">
                <p class="text-xs opacity-80 mb-1">Penjualan Hari Ini</p>
                <p class="text-2xl font-extrabold">{{ $totalPenjualanHariIni ?? 0 }}</p>
            </div>
        </div>

        <!-- Visual Section: Grafik Sisa Stok (Dinamis dari DB) + Notifikasi -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <!-- Left: Bar Chart Stok Produk -->
            <div class="lg:col-span-2 bg-white p-5 rounded-[22px] border border-[#d3c5b4] shadow-sm">
                <h3 class="text-sm font-bold text-[#2c1d11] mb-2">📊 Jumlah Sisa Stok Per Produk</h3>
                <div class="relative h-[210px] w-full">
                    <canvas id="productStockChart"></canvas>
                </div>
            </div>

            <!-- Right: Notifikasi Peringatan Stok -->
            <div class="bg-white p-5 rounded-[22px] border border-[#d3c5b4] shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-bold text-red-700 flex items-center gap-1.5">
                            🔔 Notifikasi Stok
                        </h3>
                        <span class="bg-red-100 text-red-700 px-2.5 py-0.5 rounded-full text-[11px] font-bold">
                            {{ $stokKritis ?? 0 }} Produk
                        </span>
                    </div>

                    <p class="text-[11px] text-[#736356] mb-3">
                        Perlu re-stock secepatnya:
                    </p>

                    <div class="space-y-2 max-h-[150px] overflow-y-auto pr-1">
                        @if(isset($produkKritisList) && count($produkKritisList) > 0)
                            @foreach($produkKritisList as $item)
                            <div class="p-2.5 bg-[#fdf8f6] border border-[#f5c6cb] rounded-xl flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-[#2c1d11]">{{ $item->name }}</p>
                                    <p class="text-[10px] text-[#736356]">SKU: {{ $item->sku ?? '-' }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-extrabold text-red-600 block">{{ $item->stock }} Botol</span>
                                    <span class="text-[9px] text-red-500 font-semibold">Min: {{ $item->minimum_stock ?? 5 }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="p-3 bg-[#f5efe6] rounded-xl text-center text-[11px] text-[#736356]">
                                ✅ Stok parfum aman.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-2 pt-2 border-t border-[#ece3d5] text-[10px] text-[#a09081] text-center">
                    Real-time stock monitoring
                </div>
            </div>
        </div>
    </div>

    <!-- Script Init Chart.js (Sinkron dengan Database) -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctxStock = document.getElementById('productStockChart').getContext('2d');
            
            // Mengambil data produk langsung dari database Laravel
            const labels = [
                @foreach($products as $p)
                    "{{ $p->name }}",
                @endforeach
            ];

            const stockData = [
                @foreach($products as $p)
                    {{ $p->stock }},
                @endforeach
            ];

            new Chart(ctxStock, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sisa Stok',
                        data: stockData,
                        backgroundColor: '#6b4436',
                        hoverBackgroundColor: '#21150c',
                        borderRadius: 6,
                        barThickness: 24
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, font: { size: 10 } }
                        },
                        x: {
                            ticks: { font: { size: 10 } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>