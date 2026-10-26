@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Katalog Produk</h4>
    <button class="btn btn-custom-main" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fa-solid fa-plus me-1"></i> Tambah Parfum
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 rounded-3 mb-4" style="background-color: #d4edda; color: #155724;">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nama Parfum</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td class="fw-bold">{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td><span class="badge rounded-pill bg-light text-dark border">{{ $product->category->name ?? '-' }}</span></td>
                    <td>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $product->stock <= $product->minimum_stock ? 'bg-danger' : 'bg-success' }}">
                            {{ $product->stock }} botol
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data produk parfum.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Tambah Varian Parfum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">SKU Parfum</label>
                        <input type="text" name="sku" class="form-control rounded-3" placeholder="Contoh: PRF-FL-004" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Parfum</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Vanilla Cloud EDP 100ml" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori</label>
                        <select name="category_id" class="form-select rounded-3" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Harga Beli (Rp)</label>
                            <input type="number" name="purchase_price" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Harga Jual (Rp)</label>
                            <input type="number" name="selling_price" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Stok Awal</label>
                            <input type="number" name="stock" class="form-control rounded-3" value="0" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Stok Minimum</label>
                            <input type="number" name="minimum_stock" class="form-control rounded-3" value="5" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-custom-main">Simpan Parfum</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection