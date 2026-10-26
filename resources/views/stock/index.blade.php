@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Manajemen Stok Masuk & Keluar</h4>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 rounded-3 mb-4" style="background-color: #d4edda; color: #155724;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger border-0 rounded-3 mb-4" style="background-color: #f8d7da; color: #721c24;">
        {{ session('error') }}
    </div>
@endif

<div class="row g-4 mb-4">
    <!-- Form Transaksi Stok -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h6 class="fw-bold mb-3">Catat Mutasi Stok</h6>
            <form action="{{ route('stock.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Pilih Parfum</label>
                    <select name="product_id" class="form-select rounded-3" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}">{{ $prod->name }} (Stok: {{ $prod->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Tipe Transaksi</label>
                    <select name="type" class="form-select rounded-3" required>
                        <option value="IN">Stok Masuk (+)</option>
                        <option value="OUT">Stok Keluar (-)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Jumlah Botol</label>
                    <input type="number" name="quantity" class="form-control rounded-3" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Catatan / Keterangan</label>
                    <textarea name="notes" class="form-control rounded-3" rows="2" placeholder="Contoh: Restock dari supplier"></textarea>
                </div>
                <button type="submit" class="btn btn-custom-main w-100">Simpan Mutasi</button>
            </form>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-3">
            <h6 class="fw-bold p-2 mb-0">Riwayat Mutasi Stok</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Parfum</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($movements as $m)
                        <tr>
                            <td class="small">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold">{{ $m->product->name ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $m->type === 'IN' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $m->type === 'IN' ? 'MASUK' : 'KELUAR' }}
                                </span>
                            </td>
                            <td>{{ $m->quantity }} botol</td>
                            <td class="small text-muted">{{ $m->notes ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat mutasi stok.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection